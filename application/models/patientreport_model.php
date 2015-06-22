<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of document_model
 *
 * @Hardik Raval
 */
class Patientreport_model extends CI_Model {

    public $table = "tbl_reports";

    function __construct() {
        $this->load->model('user_model', 'userModel');
        parent::__construct();
    }

    function get($where = array(), $short = array(), $offset = 0, $RPP = 0) {
       // $select = " IFNULL((select count(*) from tbl_download_report where tbl_download_report.document_id = a.id ),0) as total_download ";
        $str_query = "select r1.*,concat(pt.first_name,\" \",pt.last_name) as patientname from " . $this->table . " as r1 left join tbl_patients as pt on pt.id =r1.patient_id  where 1=1";
        
        if (!empty($where) && is_array($where)) {
            foreach ($where as $field => $data) {
                if (is_array($data) && !empty($data['value']) && !empty($data['type'])) {
                    if ($data['type'] == 'like') {
                        $str_query .= " AND a." . $field . " " . $data['type'] . " '" . $data['value'] . "%'";
                    } else {

                        $str_query .= " AND a." . $field . " " . $data['type'] . " '" . $data['value'] . "'";
                    }
                }
            }
        }
        $makequery = $this->db->query($str_query);
        $datas[0] = $makequery->num_rows();
        $makequery = $this->db->query($str_query . " limit $offset, $RPP ");
        $datas[1] = $makequery->result();
//        echo $this->db->last_query();
        return $datas;
    }

    public function save($input) {
        $data = array(
            'title' => $input['title'],
            'doc_path' => $input['doc_path'],
            'group_permission' => json_encode($input['group_permission']),
            'user_permission' => json_encode($input['user_permission']),
            'status' => (isset($input['status'])) ? "1" : "0",
            'created_at' => @mdate('%Y-%m-%d %H:%i:%s', now()),
            'updated_at' => @mdate('%Y-%m-%d %H:%i:%s', now()),
        );
        $this->db->insert($this->table, $data);
        $documentId = $this->db->insert_id();
        return $documentId;
    }

    public function update($input) {
        $data = array(
            'title' => $input['title'],
            'group_permission' => json_encode($input['group_permission']),
            'user_permission' => json_encode($input['user_permission']),
            'status' => (isset($input['status'])) ? "1" : "0",
        );
        if (isset($input['doc_path'])) {
            $data['doc_path'] = $input['doc_path'];
            $datas = $this->findById($this->input->post('id'));
            $upload_path = $this->config->item('base_path') . 'uploads/documents/';
            $filename = $upload_path . $datas->doc_path;
            @unlink($filename);
        }
        $this->db->where("id", $this->input->post('id'));
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $data = $this->findById($id);
        $upload_path = $this->config->item('base_path') . 'uploads/documents/';
        $filename = $upload_path . $data->doc_path;
        @unlink($filename);
        $this->db->where("id", $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function findById($id) {
        $output = array();
        $str_query = "select r1.*,concat(pt.first_name,\" \",pt.last_name) as patientname,pt.address,pt.contact_no from " . $this->table . " as r1 left join tbl_patients as pt on pt.id =r1.patient_id  where 1=1";
        $makequery = $this->db->query($str_query);
        // $query = $this->db->get_where($this->table, array('id' => $id));
        $result = $makequery->result();
        if (count($result) > 0) {
            $output = $result[0];
        }
        return $output;
    }

    public function getDocumentByUser($id, $where = array(), $offset = 0, $RPP = 0) {

        $user = $this->userModel->findById($id);
        
        if (!empty($user)) {
            $str_query = 'select * from ' . $this->table . ' where 1=1 and patient_id= '.$id.' ';
           // echo $str_query;die;
            foreach ($where as $key => $value) {
                $str_query .= " AND " . $key . " " . $value;
            }
            $makequery = $this->db->query($str_query);
            $datas[0] = $makequery->num_rows();
            $makequery = $this->db->query($str_query . " limit $offset, $RPP ");
            $datas[1] = $makequery->result();
            return $datas;
        }
        return array();
    }
    public function downloadpdf($report)
    {
        $pdfHTML='';
        if(!empty($report))
        {    
        
             $pdfHTML.='<table class="page_header">
		 <tr>
                <td style="width: 100%; text-align: center">
                   REGIONAL PHATHOLOGY LABORATRY
                </td>
            </tr>
			 <tr>
                <td style="width: 100%; text-align: center">
                   38 The Warren, Carshalton Beeches, Surrey SM5 4EH
                </td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: center">
                   <h1>Reports</h1>
                </td>
            </tr>
        </table>';
            
            $pdfHTML.='<table>
                        <tr><td>
                        <div>
                            <div id="myTabContent" class="tab-content">
                                <div id="home_first" style="width: 50%;float: left;"> 
                                    <label>Patient Name: </label>
                                    <span>'.ucfirst($report->patientname).'</span>

                                </div> 
                                <div class="tab-pane active in" id="home_second" style="width: 50%;float: left;"> 
                                    <label>Case #: </label>
                                    <span>'.$report->id.'</span>
                                </div>
                                <div id="home_first" style="width: 50%;float: left;"> 
                                    <label>Doctor ref ID: </label>
                                    <span>'.$report->doctor_id.'</span>

                                </div> 
                                <div class="tab-pane active in" id="home_second" style="width: 50%;float: left;"> 
                                    <label>Address: </label>
                                    <span>'.$report->address.'</span>
                                </div>

                            </div>

                        </div>

                        <div style="border:2px solid #ddd;float: left; width: 100%">
                            <center><h3>'.strtoupper($report->title).'</h3></center>   
                            <div id="home_first" class="panel-body"> 
                                <label>Diagnosis: </label>
                                <span>'.ucfirst($report->diagnosis).'</span>
                            </div> 
                        </div>
                        <div style="border:2px solid #ddd;float: left; width: 100%">
                            <div id="home_first" class="panel-body"> 
                                <label>'.ucfirst($report->extitle).'</label>
                                <span>'.ucfirst($report->exdetail).'</span>
                            </div>
                        </div>
                        <div class="panel-body right-span">
                            <span>'.$report->created_at.'</span>
                        </div></td></tr></table>';
        }
        return $pdfHTML;
    }        
    
}
