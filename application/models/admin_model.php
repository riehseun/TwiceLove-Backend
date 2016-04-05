<?php
class admin_model extends CI_Model {
    function get_by_email($email) {	
        $query = $this->db->get_where('EFA_admin', array('email'=>$email)); 
	if ($query->num_rows() > 0) {
            return $query->row(0, 'Admin');
        }
        else {
            return null;
        }
	/*
	$this->db->select('*');
	$this->db->from('EFA_admin');
	$this->db->where('email', $email);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		$row = $query->row();
		Admin admin = new Admin($row->admin_id, $row
	}
	else {
		return null;
	}
	*/
    }
}
?>
