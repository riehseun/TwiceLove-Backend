<?php
class User_stats extends CI_Controller {
    function __construct() {
        // Call the Controller constructor
        parent::__construct();
        session_start();
        $this->load->database();
    }

    function get_kudo_received() {
        $id = $_SESSION["id"];
        $other_id = 2;
        $this->load->model('kudo_model');
        $kudo = $this->kudo_model->get_by_giver_receiver_id($other_id, $id);

        echo json_encode($kudo);
    }

    function get_kudo_given() {
        $id = $_SESSION["id"];
        $other_id = 2;
        $this->load->model('kudo_model');
        $kudo = $this->kudo_model->get_by_giver_receiver_id($id, $other_id);

        echo json_encode($kudo);
    }

    function get_coin_received() {
        $id = $_SESSION["id"];
        $other_id = 2;
        $this->load->model('transaction_model');
        $coin = $this->transaction_model->get_by_giver_receiver_id($other_id, $id);
        
        echo json_encode($coin);
    }   

    function get_coin_given() {
        $id = $_SESSION["id"];
        $other_id = 2;
        $this->load->model('transaction_model');
        $coin = $this->transaction_model->get_by_giver_receiver_id($id, $other_id);
        
        echo json_encode($coin);
    }

    function get_like_received() {
        $id = $_SESSION["id"];
        $other_id = 2;
        $this->load->model('likes_model');
        $like = $this->likes_model->get_by_giver_receiver_id($other_id, $id);
        
        echo json_encode($like);
    }   

    function get_like_given() {
        $id = $_SESSION["id"];
        $other_id = 2;
        $this->load->model('likes_model');
        $like = $this->likes_model->get_by_giver_receiver_id($id, $other_id);
        
        echo json_encode($like);
    }

    function get_comment_received() {
        $id = $_SESSION["id"];
        $other_id = 2;
        $this->load->model('comment_model');
        $comment = $this->comment_model->get_by_giver_receiver_id($other_id, $id);
        
        echo json_encode($comment);
    }   

    function get_comment_given() {
        $id = $_SESSION["id"];
        $other_id = 2;
        $this->load->model('comment_model');
        $comment = $this->comment_model->get_by_giver_receiver_id($id, $other_id);
        
        echo json_encode($comment);
    }

}
?>