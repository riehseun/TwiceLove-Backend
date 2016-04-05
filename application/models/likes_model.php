<?php
class likes_model extends CI_Model {
    function get_all() {
        $query = $this->db->get('likes');
        return $query->result('Like'); // mystery
    }

    function get_by_receiver_id($receiver_id) {
        $query = $this->db->get_where('likes', array('receiver_id'=>$receiver_id));
        return $query->result('Like'); // mystery
    }
    
    function get_by_giver_id($giver_id) {
        $query = $this->db->get_where('likes', array('giver_id'=>$giver_id));
        return $query->result('Like'); // mystery
    }

    function get_by_giver_receiver_id($giver_id, $receiver_id) {
        $query = $this->db->get_where('likes', array('giver_id'=>$giver_id, 'receiver_id'=>$receiver_id));
        return $query->result('Like');
    }

    function get_period() {
        $quert = $this->db->get('turnover');
        return $query->result('Turnover');
    }

    function insert($kudo_id, $giver_id, $receiver_id, $period) {
        $this->db->trans_start();
        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d");
        $time = date("h:i:s A");
        $this->db->insert("likes",array('kudo_id' => $kudo_id,
                                        'giver_id' => $giver_id,
                                        'receiver_id' => $receiver_id,
                                        'date' => $date,
                                        'time' => $time,
                                        'period' => $period
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

    function delete($kudo_id, $giver_id, $receiver_id) { 
        return $this->db->delete("likes", array('kudo_id'=>$kudo_id, 'giver_id'=>$giver_id, 'receiver_id'=>$receiver_id));
    }

    function check_likes($kudo_id, $giver_id, $receiver_id) {
        $query = $this->db->get_where('likes', array('kudo_id'=>$kudo_id, 'giver_id'=>$giver_id, 'receiver_id'=>$receiver_id));
        if ($query->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>