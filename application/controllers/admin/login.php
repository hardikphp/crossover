<?php 
class Login extends CI_Controller {


function index()
	{
		//print_r($_POST); die;
		if($this->session->userdata('is_logged_in')){
			redirect('admin/home');
        }else{
        	$this->load->view('admin/login');	
        }
	}
 	 /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	
	function validate_credentials()
	{	
		$this->load->model('UsersAdminModel');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->UsersAdminModel->validate($user_name, $password);
		
		if($is_valid)
		{
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			//echo 'done';
			redirect('admin/home');
		}
		else // incorrect username or password
		{
			$data['message_error'] = "Incorrect Username and Password !";;
			$this->load->view('admin/login', $data);	
		}
	}	

  

    /**
    * Create new user and store it in the database
    * @return void
    */	
	
	
}
?>