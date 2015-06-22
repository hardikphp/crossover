<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report_model
 *
 * @author Hardik Raval
 */
class report_model extends CI_Model {

    public $table = "tbl_reports";

    function __construct() {
        parent::__construct();
    }

    /**
     * Save report in tbl_reports table;
     * @return int Return inserted report id
     */
    function save() {

        $is_active = ($this->input->post('is_active')) ? $this->input->post('is_active') : 1;

        $input = array(
            'patient_id' => $this->input->post('id'),
            'doctor_id' => $this->input->post('doctor_id'),
            'title' => $this->input->post('title'),
            'desc' =>  $this->input->post('desc'),
            'diagnosis' => $this->input->post('diagnosis'),
            'extitle' => $this->input->post('extitle'),
            'exdetail' => $this->input->post('exdetail'),
            'is_active' => $is_active,
            'created_at' => @mdate('%Y-%m-%d %H:%i:%s', now())
        );
        $this->db->insert($this->table, $input);
        $reportId = $this->db->insert_id();
        //send mail

        return $reportId;
    }

    public function update() {
        $input = array(
           'patient_id' => $this->input->post('patient_id'),
            'doctor_id' => $this->input->post('doctor_id'),
            'title' => $this->input->post('title'),
            'desc' =>  $this->input->post('desc'),
            'diagnosis' => $this->input->post('diagnosis'),
            'extitle' => $this->input->post('extitle'),
            'exdetail' => $this->input->post('exdetail'),
            'is_active' => $this->input->post('is_active'),
        );
        
        $this->db->where("id", $this->input->post('id'));
        $this->db->update($this->table, $input);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where("id", $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    function get($where = array(), $short = array(), $offset = 0, $RPP = 0) {
        $str_query = "select r1.*,concat(pt.first_name,\" \",pt.last_name) as patientname from " . $this->table . " as r1 left join tbl_patients as pt on pt.id =r1.patient_id  where 1=1";

        if (!empty($where) && is_array($where)) {
            foreach ($where as $field => $data) {
                if (is_array($data) && !empty($data['value']) && !empty($data['type'])) {
                    if ($data['type'] == 'like') {
                        $str_query .= " AND tbl_reports." . $field . " " . $data['type'] . " '" . $data['value'] . "%'";
                    } else {

                        $str_query .= " AND tbl_reports." . $field . " " . $data['type'] . " '" . $data['value'] . "'";
                    }
                }
            }
        }
        $makequery = $this->db->query($str_query);
        $datas[0] = $makequery->num_rows();
        $makequery = $this->db->query($str_query . " limit $offset, $RPP ");
        $datas[1] = $makequery->result();

        return $datas;
    }

    function findById($id) {
        $output = array();
       $str_query = "select r1.*,concat(pt.first_name,\" \",pt.last_name) as patientname from " . $this->table . " as r1 left join tbl_patients as pt on pt.id =r1.patient_id  where r1.id=".$id."";
       $query = $this->db->query($str_query); 
       $result = $query->result();
        if (count($result) > 0) {
            $output = $result[0];
        }
        
        return $output;
    }

    function reportList() {
        $lists = array();
        $query = $this->db->get_where($this->table, array('is_active' => 1, 'is_delete' => 0));
        foreach ($query->result() as $row) {
            $lists[$row->id] = $row->first_name . " " . $row->last_name;
        }
        return $lists;
    }

    function getReportsByIds($id = array()) {
        if (!empty($id)) {
            $this->db->where_in('id', $id);
            $query = $this->db->get($this->table);
            return $query->result();
        }
        return array();
    }

    

}
