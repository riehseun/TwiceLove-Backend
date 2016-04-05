<?php
class kudo_comment_model extends CI_Model {
    function getAll() {
        $query = $this->db->get('employee');
        return $query->result('Employee');
    }
    
    function get_by_id($id) {
        $query = $this->db->get_where('employee', array('id'=>$id));
        if ($query->num_rows() > 0) {
            return $query->row(0, 'Employee');
        }
        else {
            return false;
        }
    }

    function get_by_email($email) {
        $query = $this->db->get_where('employee', array('email'=>$email));
        if ($query->num_rows() > 0) {
            return $query->row(0, 'Employee');
        }
        else {
            return false;
        }
    }
    
    function deleteAll() {
        //$this->db->where_not_in('login','admin');
        return $this->db->delete('employee');
    }
    function delete($id) {
        return $this->db->delete("employee", array('id'=>$id));
    }

    // Atomic write operation
    function insert($employee) {
        $this->db->trans_start();
        $this->db->insert("employee",array('first' => $employee['first'],
                                            'last' => $employee['last'],
                                            'password' => $employee['password'],
                                            'email' => $employee['email'],
                                            'coins_left' => 10,
                                            'coins_given' => 0,
                                            'coins_received' => 0,
                                            'last_received' => 0
                                          ));
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        else {
            return $insert_id;
        }
    }  
}
?>