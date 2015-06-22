<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reports 
 *
 * @Hardik Raval
 */
class Reports extends User_Auth_Controller {

    var $user;

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'userModel');
        $this->load->model('patientreport_model', 'patientModel');
        $this->load->helper('download');
        $this->user = get_userdata("userarea");
    }

    public function index() {
        $data = array();
        $pages = '';
        $search = array();

        $per_page = $this->config->item("per_page");
        if ($this->uri->segment(3) === FALSE) {
            $offset = 0;
        } else {
            $offset = $this->uri->segment(3);
        }
        if ($this->input->get('title', FALSE)) {
            $search['title like '] = "'" . $this->input->get('title') . "%'";
        }

        $data = $this->patientModel->getDocumentByUser($this->user['id'], $search, $offset, $per_page);
       
        $base_url = base_url() . 'reports/index';
        //get pagination link
        $pages = crete_pagination($base_url, $data[0], $per_page, 3);
        $body_data = array("documents" => $data[1], "pages" => $pages);

       
        $this->load->view('my_report', $body_data);
    }
    public function view($id) {
        
        $data = $this->patientModel->findById($id);
      // echo '<pre>';
      // print_r($data);
        $base_url = base_url() . 'reports/view';
        $body_data = array("report" => $data);

        $this->load->view('my_report_view', $body_data);
    }
    public function download($id) {
        $this->load->library('Pdf');
        $document = $this->patientModel->findById($id);
        $pdfname = str_replace(" ","_",$document->patientname.'_'.$document->patient_id.'_'.now().'.pdf');
        $myhtml = $this->patientModel->downloadpdf($document);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Add a page
        $pdf->AddPage();
       
        $pdf->writeHTML($myhtml, true, false, true, false, '');
        $pdf->Output($pdfname, 'I');
        //download report as pdf
       
    }

}
