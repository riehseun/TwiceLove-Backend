<?php
class twice_model extends CI_Model {
    	function get_all() {
			
        	$query = $this->db->get('TWICE_kudo');
		if ($query !== false) {
			return $query->result('Twice');
		}
        	else {
			return null;
		}
			
		/*
		$query = $this->db->query("SELECT * from TWICE_kudo");
 		if ($query->num_rows() > 0) {  	
			//return $query->result();
			return null;
		}
		else {
			return null;
		}
		*/
		
   	 }
      
    	function insert($kudo) {
        		
        	$this->db->insert("TWICE_kudo",array('kudo_id' => $kudo['kudo_id'],
                                            'name' => $kudo['name'],
                                            'status' => $kudo['status'],
                                            'image' => $kudo['image'],
                                            'profile_pic' => $kudo['profile_pic'],
                                            'time_stamp' => $kudo['time_stamp'],
                                            'url' => $kudo['url'] 
                                          ));
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return null;
        }
        else {
            return $insert_id;
        }
    }  
}
?>
