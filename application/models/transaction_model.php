<?php
class transaction_model extends CI_Model {
    function get_all() {
        $query = $this->db->get('transaction');
        return $query->result('Transaction');
    }

    function get_by_receiver_id($receiver_id) {
        $query = $this->db->get_where('transaction', array('receiver_id'=>$receiver_id));
        return $query->result('Transaction');
    }
    
    function get_by_giver_id($giver_id) {
        $query = $this->db->get_where('transaction', array('giver_id'=>$giver_id));
        return $query->result('Transaction');
    }

    function get_by_giver_receiver_id($giver_id, $receiver_id) {
        $query = $this->db->get_where('transaction', array('giver_id'=>$giver_id, 'receiver_id'=>$receiver_id));
        return $query->result('Transaction');
    }

    function get_period() {
        $quert = $this->db->get('turnover');
        return $query->result('Turnover');
    }

    function insert($giver, $quantity, $receiver, $period) {
        $this->db->trans_start();
        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d");
        $time = date("h:i:s A");
        $this->db->insert("transaction", array('giver_id' => $giver->id,
                                                'giver_first' => $giver->first,
                                                'giver_last' => $giver->last,
                                                'giver_photo_url' => $giver->photo_url,
                                                'quantity' => $quantity,
                                                'receiver_id' => $receiver->id,    
                                                'receiver_first' => $receiver->first,
                                                'receiver_last' => $receiver->last,
                                                'receiver_photo_url' => $receiver->photo_url,
                                                'date' => $date,
                                                'time' => $time,
                                                'period' => $period
                                        ));
        $insert_id = $this->db->insert_id();
        echo $insert_id;
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        else {
            return $insert_id;
        }
    }

    function delete_all() {
        return $this->db->empty_table("transaction");
    } 
}
?>