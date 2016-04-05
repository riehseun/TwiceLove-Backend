<?php
class hash_model extends CI_Model {
    function get_all() {
        $query = $this->db->get('hash');
        return $query->result('Hash');
    }
    
    function deleteAll() {
        return $this->db->delete('hash');
    }

    function delete($value) {
        return $this->db->delete("hash", array('hash'=>$value));
    }

    // Atomic write operation
    function insert($hash) {
        $this->db->trans_start();
        $this->db->insert("hash", array('hash' => $hash)); // 'hash' has to match attribute in the database
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