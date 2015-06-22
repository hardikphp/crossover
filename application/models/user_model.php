<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @Hardik Raval
 */
class user_model extends CI_Model {

    public $table = "tbl_patients";

    function __construct() {
        parent::__construct();
    }

    /**
     * Save user in tbl_users table;
     * @return int Return inserted user id
     */
    function save() {

       // $group_id = ($this->input->post('group_id')) ? $this->input->post('group_id') : 1;
        $is_active = ($this->input->post('is_active')) ? $this->input->post('is_active') : 1;

        $input = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => hash("sha256", $this->input->post('password')),
            'contact_no' => $this->input->post('contact_no'),
            'address' => $this->input->post('address'),
            'is_active' => $is_active,
            'created_at' => @mdate('%Y-%m-%d %H:%i:%s', now()),
            'updated_at' => @mdate('%Y-%m-%d %H:%i:%s', now()),
        );
        $this->db->insert($this->table, $input);
        $patientId = $this->db->insert_id();
        //send mail

        return $patientId;
      
      }

    public function update() {
        $input = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'contact_no' => $this->input->post('contact_no'),
            'address' => $this->input->post('address'),
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
        $str_query = "select tbl_patients.* from " . $this->table . " where 1=1";

        if (!empty($where) && is_array($where)) {
            foreach ($where as $field => $data) {
                if (is_array($data) && !empty($data['value']) && !empty($data['type'])) {
                    if ($data['type'] == 'like') {
                        $str_query .= " AND tbl_patients." . $field . " " . $data['type'] . " '" . $data['value'] . "%'";
                    } else {

                        $str_query .= " AND tbl_patients." . $field . " " . $data['type'] . " '" . $data['value'] . "'";
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
        $query = $this->db->get_where($this->table, array('id' => $id));
        $result = $query->result();
        if (count($result) > 0) {
            $output = $result[0];
        }
        return $output;
    }

    function is_unique_email($email, $id = null) {
        $where = array('email' => $email);
        if ($id != null) {
            $where['id !='] = $id;
        }
        $query = $this->db->get_where($this->table, $where);
        $result = $query->result();

        if (count($result) > 0) {
            return FALSE;
        }
        return TRUE;
    }

    function userList() {
        $lists = array();
        $query = $this->db->get_where($this->table, array('is_active' => 1, 'is_delete' => 0));
        foreach ($query->result() as $row) {
            $lists[$row->id] = $row->first_name . " " . $row->last_name;
        }
        return $lists;
    }

    public function checkAuth($email, $password) {
        return $this->db->get_where($this->table, array('email' => $email, "password" => hash_password($password), "is_delete" => 0, "is_active" => 1))->row();
    }

    function getUsersByIds($id = array()) {
        if (!empty($id)) {
            $this->db->where_in('id', $id);
            $query = $this->db->get($this->table);
            return $query->result();
        }
        return array();
    }

    

}
