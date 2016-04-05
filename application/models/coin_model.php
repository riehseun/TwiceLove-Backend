<?php
class coin_model extends CI_Model {
    function get_all() {
        $query = $this->db->get('coin');
        return $query->result('Coin');
    }
    
    function deleteAll() {
        return $this->db->delete('coin');
    }

    function delete($value) {
        return $this->db->delete("coin", array('value'=>$value));
    }

    // Atomic write operation
    function insert($coin) {
        $this->db->trans_start();
        $this->db->insert("coin", array('value' => $coin));
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