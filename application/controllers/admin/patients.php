<?php

class Patients extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('patient_model', "patientModel");
        $this->load->library('pagination');
    }

    function add() {

        $this->form_validation->set_rules(array(
            array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
            array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|is_unique[tbl_patients.email]'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|matches[conf_password]'),
            array('field' => 'conf_password', 'label' => 'Conform Password', 'rules' => 'trim|required'),
            array('field' => 'contact_no', 'label' => 'Contact No', 'rules' => 'trim|numeric'),
            array('field' => 'organization', 'label' => 'Organization', 'rules' => 'trim')
        ));
        if ($this->form_validation->run() === TRUE) {
            //save patient
            $this->patientModel->save();
            redirect('/admin/patients', 'refresh');
        }

     
        $this->load->view("admin/patients/add_patient", $data);
    }

    public function index() {
        //List Region and set paging
        $per_page = $this->config->item("per_page");
        if ($this->uri->segment(4) === FALSE) {
            $offset = 0;
        } else {
            $offset = $this->uri->segment(4);
        }

        $data = array();
        $pages = '';
        $data = $this->patientModel->get(null, null, $offset, $per_page);
        $base_url = base_url() . 'admin/patients/index';
        //get pagination link
        $pages = crete_pagination($base_url, $data[0], $per_page, 4);
        $body_data = array("datas" => $data[1], "pages" => $pages);
        $this->load->view("admin/patients/index", $body_data);
    }

    /**
     * 
     */
    public function edit($id) {
        $data = [];
        $data['patient'] = $this->patientModel->findById($id);
        
        $this->form_validation->set_rules(array(
            array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
            array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|callback_unique[' . $id . ']'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|matches[conf_password]'),
            array('field' => 'conf_password', 'label' => 'Conform Password', 'rules' => 'trim'),
            array('field' => 'contact_no', 'label' => 'Contact No', 'rules' => 'trim|numeric')
        ));
        if ($this->form_validation->run() === TRUE) {
            //save patient
             $this->patientModel->update();
            redirect('/admin/patients', 'refresh');
        }
       // $data['groups'] = $this->groupModel->groupList();
        $this->load->view('admin/patients/edit_patient', $data);
    }

    public function delete($id) {
        if (!empty($id)) {
            $this->patientModel->delete($id);
        }
        redirect('/admin/patients');
    }

    /**
     * Callback function of unique name
     * @param string $email 
     * @param int $id 
     * @return boolean 
     */
    function unique($email, $id = null) {
        return $this->patientModel->is_unique_email($email, $id);
    }

}

?>