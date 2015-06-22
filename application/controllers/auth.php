<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @Hardik Raval
 */
class Auth extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'userModel');
      //  $this->load->model('group_model', "groupModel");
    }

    public function index() {
        redirect("auth/login");
    }

    /**
     * User Login
     */
    public function login() {
        $userdata = get_userdata("userarea");
        if (!empty($userdata)) {
            redirect("/reports");
        }

        $rules = array(
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required')
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {

            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $result = $this->userModel->checkAuth($email, $password);

            if (count($result) > 0) {
               // echo 'done';die;
                //set session for user
                $usession = array("userarea" => array("id" => $result->id, "email" => $result->email, "permission" => $result->permission, 'group_id' => $result->group_id));
                $this->session->set_userdata($usession);
                //set flash message
                set_flashdata("success", "Successfully Login");
                //redirect home
                redirect('/reports');
            } else {
                set_flashdata("error", "Invalid Credential..");
                redirect("auth/login");
            }
        }

        $this->load->view('auth/login');
    }

    /**
     * User Logout
     */
    public function logout() {

        $userdata = get_userdata("userarea");
        if (!empty($userdata)) {
            //remove userdata
            unset_userdata("userarea");
            set_flashdata("success", "Successfully Logout..");
        }

        redirect("/");
    }

    /**
     * User Sing Up
     */
    public function singup() {
        $userdata = get_userdata("userarea");
        if (!empty($userdata)) {
            redirect('/');
        }


        $this->form_validation->set_rules(array(
            array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
            array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|is_unique[tbl_users.email]'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|matches[conf_password]'),
            array('field' => 'conf_password', 'label' => 'Conform Password', 'rules' => 'trim|required'),
            array('field' => 'contact_no', 'label' => 'Contact No', 'rules' => 'trim|numeric'),
            array('field' => 'organization', 'label' => 'Organization', 'rules' => 'trim'),
        ));
        if ($this->form_validation->run() === TRUE) {
            //save user
            $this->userModel->save();
            set_flashdata("success", "Successfully singup..");
            redirect('/', 'refresh');
        }

        $data['groups'] = $this->groupModel->groupList();

        $this->load->view("auth/singup", $data);
    }

    /**
     * User Password forget
     */
    public function forgotpassword() {
        $userdata = get_userdata("userarea");
        if (!empty($userdata)) {
            redirect("/");
        }

        //Load ForgetpasswordModel 
        $this->load->model('ForgotpasswordModel');

        //Set Form Validatio Rules
        $this->form_validation->set_rules(array(
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email')
        ));

        //check form validation rules
        if ($this->form_validation->run() === TRUE) {
            $email = $this->input->post('email');
            $datas = $this->ForgotpasswordModel->authedicate_email($email);
//            echo "<pre>";
//            print_r($datas);
//            echo "</pre>";
            if (empty($datas)) {
//                addMessageStack("This email id has note been registered.", $type = 'error');
                set_flashdata("error", "This email id has note been registered");
                redirect('auth/forgotpassword', 'refresh');
            } else {
                $this->load->library('encrypt');
                $salt = "Crossover" . $datas->id . get_random_password();
                $token = $this->encrypt->sha1($salt . $this->encrypt->sha1($email));
                $link = site_url() . "auth/resetpassword/?token=$token";
                $password_token = $token;

                //echo now().'~'.mdate('%Y-%m-%d %H:%i:%s',$password_token_expired);
                //echo $link;
                //die;
                //send mail
                $subject = "Crossover Account Recovery";
                $this->load->library('email');
                $to = $datas->email;
                $fromemail = $this->config->item('noreply_from');
                $email_data = array();
                $email_data['name'] = $datas->first_name . ' ' . $datas->last_name;
                $email_data['username'] = $datas->email;
                $email_data['link'] = $link;

                $mesg = $this->load->view('template/newpassword', $email_data, true);
                //echo $fromemail." << >> ".$to." << >> ".$subject;
                //die;
                //echo $mesg;die;
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';

                $this->email->initialize($config);
                $this->email->to($to);
                $this->email->from($fromemail, "Crossover");
                $this->email->subject($subject);
                $this->email->message($mesg);
                $mail = $this->email->send();

                if (!$mail) {
                    // Generate error
                    set_flashdata("error", "System error,Please try again after some time");
                    redirect('auth/forgotpassword', 'refresh');
                    /* echo '<script>
                      parent.$.fancybox.close();
                      parent.location.reload();
                      </script>'; */
                } else {
                    //update userdata with the credentail
                    $this->ForgotpasswordModel->update_password_model($email, $token);
                    //echo $mesg;die;
//                    addMessageStack("We've sent you an email that will allow you to reset your password quickly and easily.", $type = 'success');
                    set_flashdata("success", "We've sent you an email that will allow you to reset your password quickly and easily.");
                    redirect('auth/forgotpassword', 'refresh');
                    /* echo '<script>
                      parent.$.fancybox.close();
                      parent.location.reload();
                      </script>'; */
                }
            }
        }


        $this->load->view('auth/forgotpassword');
    }

    /**
     * User Reset Password
     */
    public function resetpassword() {
        $userdata = get_userdata("userarea");
        if (!empty($userdata)) {
            redirect("/");
        }
        $data = array();
        $this->load->model('ForgotpasswordModel');
        $this->load->library('encrypt');
        $token = $_REQUEST['token'];
        $usersData = $this->ForgotpasswordModel->authedicate_token($token);
        /* echo "<pre>";
          print_r($usersData);
          die; */
        // Setup form validation
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
        $this->form_validation->set_rules(array(
            array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|min_length[8]|max_length[15]|xss_clean|matches[cnew_password]'),
            array('field' => 'cnew_password', 'label' => 'Confirm New Password', 'rules' => 'trim|required|min_length[8]|max_length[15]|xss_clean'),
        ));

        if (!empty($usersData) && $token != "" && $token == $usersData->password_token && now() <= strtotime($usersData->password_token_date)) {
            $data['link'] = site_url() . "auth/resetpassword/?token=$token";
            // Run form validation
            if ($this->form_validation->run() === TRUE) {
                //echo "<pre>";
                //print_r($_POST);
                //die;
                $npassword = $this->input->post('new_password');
                $email = $usersData->email;

                $salt = "Crossover" . $usersData->id . get_random_password();
                $token = $this->encrypt->sha1($salt . $this->encrypt->sha1($email));
                $link = site_url() . "auth/resetpassword/?token=$token";

                $this->ForgotpasswordModel->update_newpassword($email, $npassword, $token);
                //send alert mail 
                $username = $usersData->username;
                //send mail
                $subject = "Crossover Account password changed";
                $this->load->library('email');
                $to = $usersData->email;
                $fromemail = $this->config->item('noreply_from'); //"hardik@milan-group.net";

                $email_data = array();
                $email_data['name'] = $usersData->first_name . ' ' . $usersData->last_name;
                $email_data['username'] = $usersData->email;
                $email_data['email'] = $email;
                $email_data['link'] = $link;
                $mesg = $this->load->view('template/passwordChange', $email_data, true);
                //echo $fromemail." << >> ".$to." << >> ".$subject;
                //echo $mesg;die;
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';

                $this->email->initialize($config);
                $this->email->to($to);
                $this->email->from($fromemail, "Crossover");
                $this->email->subject($subject);
                $this->email->message($mesg);
                $mail = @$this->email->send();
//                addMessageStack("your password has been changed successfully.", $type = 'success');
                set_flashdata("success", "your password has been changed successfully.");
                redirect(site_url(), 'refresh');
            }
        } else {
//            addMessageStack("Link is invalid or has expired.", $type = 'error');
            set_flashdata("error", "Link is invalid or has expired.");
            redirect('auth/forgotpassword', 'refresh');
        }
        // Setup form validation
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
        $this->form_validation->set_rules(array(
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[8]|max_length[15]|xss_clean|callback_password')
        ));

        $this->load->view('auth/reset', $data);
    }

}
