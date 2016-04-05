<?php
class turnover_model extends CI_Model {
	function get_all() {
        $query = $this->db->get('turnover');
        return $query->result('Turnover');
    }

    function increment_period() {
    	$query = $this->db->get('turnover')->row();
        $period = $query->period + 1;
        $this->db->update("turnover", array('period'=>$period));
        return $period;
    }

    function decrement_period() {
        $query = $this->db->get('turnover')->row();
        $period = $query->period - 1;
        $this->db->update("turnover", array('period'=>$period));
        return $period;
    }

    function insert($period, $daily_coin) {
        $this->db->trans_start();
        $this->db->insert("turnover", array('period' => $period, 'daily_coin' => $daily_coin));
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        else {
            return $insert_id;
        }
    }

    function delete_all() {
        return $this->db->empty_table("turnover");
    } 
}
?>