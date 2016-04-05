<?php
class user_model extends CI_Model {
    function getAll() {
        $query = $this->db->get('EFA_user');
        return $query->result('User');
    }
    
    function get_by_id($id) {
        $query = $this->db->get_where('EFA_user', array('id'=>$id));
        return $query->row(0, 'User');
    }

    function get_photo_url_by_id($id) {
        $query = $this->db->get_where('EFA_user', array('id'=>$id));
        if ($query != null) {
            return $query->row(0, 'User')->photo_url;
        }
        else {
            return false;
        }
    }

    function get_by_email($email) {
        $query = $this->db->get_where('EFA_user', array('email'=>$email));
        if ($query != null) {
            return $query->row(0, 'User');
        }
        else {
            return null;
        }
    }
    
    function get_except_me($id) {
        $query = $this->db->get_where('EFA_user', array('id !=' => $id));
        return $query->result('User');
    }

    function deleteAll() {
        return $this->db->delete('EFA_user');
    }

    function delete($id) {
        return $this->db->delete("EFA_user", array('id'=>$id));
    }

    // Atomic write operation
    function insert($user) {
        $this->db->trans_start();
        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d");
        $time = date("h:i:s A");
	

        $this->db->insert("EFA_user",array('first_name' => $user['firstName'],
                                            'last_name' => $user['lastName'],
                                            'password' => $user['password'],
                                            'email' => $user['email'],
                                            'coins_gave' => 0,
                                            'coins_received' => 0,
                                            'photo_url' => '/efa/img/profile.png' 
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

    function check_coins_left($employee, $quantity) {
        $this->db->where('id', $employee->id);
        $coins_left = $employee->coins_left - $quantity;
        if ($coins_left >= 0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    function update_giver($employee, $quantity) {
        $this->db->where('id', $employee->id);
        $coins_left = $employee->coins_left - $quantity;
        $coins_given = $employee->coins_given + $quantity;
        $this->db->update("EFA_user", array('coins_left' => $coins_left, 'coins_given' => $coins_given));
    }

    function update_receiver($employee, $quantity) {
        $this->db->where('id', $employee->id);
        $coins_left = $employee->coins_left + $quantity;
        $coins_received = $employee->coins_received + $quantity;
        $this->db->update("EFA_user", array('coins_left' => $coins_left, 'coins_received' => $coins_received));
    }  

    function reset_coin() {
        $employee = $this->employee_model->getAll();
        $this->db->from('EFA_user');
        $query = $this->db->get();
        $count = $query->num_rows(); 
        $coins_left = 10;
        $coins_received = 0;
        $coins_given = 0;
        for ($i=0; $i<$count; $i++) {
            $this->db->where('id', $employee[$i]->{'id'});
            $this->db->update("EFA_user", array('coins_left' => $coins_left, 'coins_received' => $coins_received,
                'coins_given' => $coins_given));
        }
    }

    function update_photo($id, $photo_url) {
        $this->db->where('id', $id);
        return $this->db->update("EFA_user", array('photo_url' => $photo_url));
    }
}
?>
