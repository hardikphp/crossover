<?php

class Reports extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('report_model', "reportModel");
        $this->load->model('patient_model', "patientModel");
        $this->load->library('pagination');
    }

    function add() {

        $this->form_validation->set_rules(array(
            array('field' => 'title', 'label' => 'Test title', 'rules' => 'trim|required'),
            array('field' => 'desc', 'label' => 'Test description', 'rules' => 'trim|required'),
            array('field' => 'diagnosis', 'label' => 'Diagnosis', 'rules' => 'trim|required'),
            array('field' => 'extitle', 'label' => 'Examination title', 'rules' => 'trim|required'),
            array('field' => 'exdetail', 'label' => 'Examination detail', 'rules' => 'trim|required')
        ));
        if ($this->form_validation->run() === TRUE) {
            //save report
            $this->reportModel->save();
            redirect('/admin/reports', 'refresh');
        }
         $data['patients'] = $this->patientModel->patientList();
     
        $this->load->view("admin/reports/add_report", $data);
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
        $data = $this->reportModel->get(null, null, $offset, $per_page);
        //echo '<pre>';
        //print_r($data);
        //die;
        $base_url = base_url() . 'admin/reports/index';
        //get pagination link
        $pages = crete_pagination($base_url, $data[0], $per_page, 4);
        $body_data = array("datas" => $data[1], "pages" => $pages);
        $this->load->view("admin/reports/index", $body_data);
    }

    /**
     * 
     */
    public function edit($id) {
        $data = [];
        $data['report'] = $this->reportModel->findById($id);
       
        $this->form_validation->set_rules(array(
            array('field' => 'title', 'label' => 'Test title', 'rules' => 'trim|required'),
            array('field' => 'desc', 'label' => 'Test description', 'rules' => 'trim|required'),
            array('field' => 'diagnosis', 'label' => 'Diagnosis', 'rules' => 'trim|required'),
            array('field' => 'extitle', 'label' => 'Examination title', 'rules' => 'trim|required'),
            array('field' => 'exdetail', 'label' => 'Examination detail', 'rules' => 'trim|required')
        ));
        
        $data['patients'] = $this->patientModel->patientList();
       
        if ($this->form_validation->run() === TRUE) {
            //save report
          
            $this->reportModel->update();
            redirect('/admin/reports', 'refresh');
        }
       // $data['groups'] = $this->groupModel->groupList();
        $this->load->view('admin/reports/edit_report', $data);
    }

    public function delete($id) {
        if (!empty($id)) {
            $this->reportModel->delete($id);
        }
        redirect('/admin/reports');
    }

}

?>