<?php
class My_stats extends CI_Controller {
    function __construct() {
	    // Call the Controller constructor
	    parent::__construct();
	    session_start();
	    $this->load->database();
    }

    function get_kudo_receiver() {
        $id = $_SESSION["id"];
        $this->load->model('kudo_model');
        $kudo = $this->kudo_model->get_by_giver_id($id);

        $temp = array();
        foreach($kudo as $key => $value) {
            $temp[$value->receiver_id][$key] = $value;
        }

        $receiver = array();
        foreach($temp as $key => $value) {
            $receiver[$key] = sizeof($value);
        }

        arsort($receiver);

        foreach($receiver as $key => $value) {
            echo "key: $key value: $value";
            echo "<p>";
        }

        /*
        foreach($temp as $key => $value) {
            echo "key: $key";
            echo "<p>"; 
            foreach ($value as $k => $v) {
                echo "$k: $v->receiver_id";
                echo "<p>"; 
            }
            echo "<hr>";
        }
        */
    }

    function get_kudo_giver() {
        $id = $_SESSION["id"];
        $this->load->model('kudo_model');
        $kudo = $this->kudo_model->get_by_receiver_id($id);

        $temp = array();
        foreach($kudo as $key => $value) {
            $temp[$value->giver_id][$key] = $value;
        }

        $giver = array();
        foreach($temp as $key => $value) {
            $giver[$key] = sizeof($value);
        }

        arsort($giver); 

        foreach($giver as $key => $value) {
            echo "key: $key value: $value";
            echo "<p>";
        }
    }

    function get_coin_receiver() {
        $id = $_SESSION["id"];
        $this->load->model('kudo_model');
        $kudo = $this->kudo_model->get_by_giver_id($id);
        $this->load->model('transaction_model');
        $coin = $this->transaction_model->get_by_giver_id($id);
        
        $temp1 = array();
        foreach($kudo as $key => $value) {
            $temp1[$value->receiver_id][$key] = $value;
        }
        $temp2 = array();
        foreach($coin as $key => $value) {
            $temp2[$value->receiver_id][$key] = $value;
        }

        $receiver1 = array();
        foreach($temp1 as $key => $value) {
            $quantity = 0;
            foreach($value as $k => $v) {
                $quantity += $v->quantity;
            }
            $receiver1[$key] = $quantity;
        }
        $receiver2 = array();
        foreach($temp2 as $key => $value) {
            $quantity = 0;
            foreach($value as $k => $v) {
                $quantity += $v->quantity;
            }
            $receiver2[$key] = $quantity;
        }

        foreach($receiver1 as $key => $value) {
            echo "gave to: $key coins: $value";
            echo "<p>";
        }
        echo "<hr>";
        foreach($receiver2 as $key => $value) {
            echo "gave to: $key coins: $value";
            echo "<p>";
        }
        echo "<hr>";

        $receiver3 = $receiver1;
        foreach($receiver2 as $k => $v) {
            if (array_key_exists($k, $receiver3)) {
               $receiver3[$k] += $v;
            }
            else {
               $receiver3[$k] = $v; 
            }
        }

        arsort($receiver3);

        foreach($receiver3 as $key => $value) {
            echo "gave to: $key coins: $value";
            echo "<p>";
        }
    }   

    function get_coin_giver() {
        $id = $_SESSION["id"];
        $this->load->model('kudo_model');
        $kudo = $this->kudo_model->get_by_receiver_id($id);
        $this->load->model('transaction_model');
        $coin = $this->transaction_model->get_by_receiver_id($id);
        
        $temp1 = array();
        foreach($kudo as $key => $value) {
            $temp1[$value->giver_id][$key] = $value;
        }
        $temp2 = array();
        foreach($coin as $key => $value) {
            $temp2[$value->giver_id][$key] = $value;
        }

        $giver1 = array();
        foreach($temp1 as $key => $value) {
            $quantity = 0;
            foreach($value as $k => $v) {
                $quantity += $v->quantity;
            }
            $giver1[$key] = $quantity;
        }
        $giver2 = array();
        foreach($temp2 as $key => $value) {
            $quantity = 0;
            foreach($value as $k => $v) {
                $quantity += $v->quantity;
            }
            $giver2[$key] = $quantity;
        }

        foreach($giver1 as $key => $value) {
            echo "received from: $key coins: $value";
            echo "<p>";
        }
        echo "<hr>";
        foreach($giver2 as $key => $value) {
            echo "received from: $key coins: $value";
            echo "<p>";
        }
        echo "<hr>";

        $giver3 = $giver1;
        foreach($giver2 as $k => $v) {
            if (array_key_exists($k, $giver3)) {
               $giver3[$k] += $v;
            }
            else {
               $giver3[$k] = $v; 
            }
        }

        arsort($giver3);

        foreach($giver3 as $key => $value) {
            echo "received from: $key coins: $value";
            echo "<p>";
        }
    }

    function get_like_receiver() {
        $id = $_SESSION["id"];
        $this->load->model('likes_model');
        $like = $this->likes_model->get_by_giver_id($id);

        $temp = array();
        foreach($like as $key => $value) {
            $temp[$value->receiver_id][$key] = $value;
        }

        $receiver = array();
        foreach($temp as $key => $value) {
            $receiver[$key] = sizeof($value);
        }

        arsort($receiver);

        foreach($receiver as $key => $value) {
            echo "key: $key value: $value";
            echo "<p>";
        }
    }

    function get_like_giver() {
        $id = $_SESSION["id"];
        $this->load->model('likes_model');
        $like = $this->likes_model->get_by_receiver_id($id);

        $temp = array();
        foreach($like as $key => $value) {
            $temp[$value->giver_id][$key] = $value;
        }

        $giver = array();
        foreach($temp as $key => $value) {
            $giver[$key] = sizeof($value);
        }

        arsort($giver);

        foreach($giver as $key => $value) {
            echo "key: $key value: $value";
            echo "<p>";
        }
    }

    function get_comment_receiver() {
        $id = $_SESSION["id"];
        $this->load->model('comment_model');
        $comment = $this->comment_model->get_by_giver_id($id);

        $temp = array();
        foreach($comment as $key => $value) {
            $temp[$value->receiver_id][$key] = $value;
        }

        $receiver = array();
        foreach($temp as $key => $value) {
            $receiver[$key] = sizeof($value);
        }

        arsort($receiver);

        foreach($receiver as $key => $value) {
            echo "key: $key value: $value";
            echo "<p>";
        }
    }

    function get_comment_giver() {
        $id = $_SESSION["id"];
        $this->load->model('comment_model');
        $comment = $this->comment_model->get_by_receiver_id($id);

        $temp = array();
        foreach($comment as $key => $value) {
            $temp[$value->giver_id][$key] = $value;
        }

        $giver = array();
        foreach($temp as $key => $value) {
            $giver[$key] = sizeof($value);
        }

        arsort($giver);

        foreach($giver as $key => $value) {
            echo "key: $key value: $value";
            echo "<p>";
        }
    }

    function get_hash_receiver() {
        $this->load->model('kudo_model');
        $this->load->model('hash_model');
        $hash = $this->hash_model->get_all();

        $kudo = array();
        $id = $_SESSION["id"];
        foreach ($hash as $key => $value) {
            $kudo[$value->hash] = $this->kudo_model->get_by_hash_and_receiver_id($value->hash, $id);
            $temp[$value->hash] = array();
            foreach($kudo[$value->hash] as $k => $v) {
                $temp[$value->hash][$v->giver_id][$k] = $v;
            }
        }
        
        foreach($hash as $kk => $vv) {
            foreach($temp[$vv->hash] as $key => $value) {
                echo "giver_id: $key";
                echo "<p>"; 
                foreach ($value as $k => $v) {
                    echo "key for each hash: $k receiver_id: $v->receiver_id hash: $v->hash";
                    echo "<p>"; 
                }
                echo "<hr>";
            }
        }

        foreach($hash as $k => $v) {
            $receiver[$v->hash] = array();
            foreach($temp[$v->hash] as $key => $value) {
                $receiver[$v->hash][$key] = sizeof($value);
            }
            arsort($receiver[$v->hash]);
        }

        foreach($hash as $k => $v) {
            foreach($receiver[$v->hash] as $key => $value) {
                echo "hash: $v->hash receiver_id: $key quantity: $value";
                echo "<p>";
            }
        }
    }

    function get_hash_giver() {
        $this->load->model('kudo_model');
        $this->load->model('hash_model');
        $hash = $this->hash_model->get_all();

        $kudo = array();
        $id = $_SESSION["id"];
        foreach ($hash as $key => $value) {
            $kudo[$value->hash] = $this->kudo_model->get_by_hash_and_giver_id($value->hash, $id);
            $temp[$value->hash] = array();
            foreach($kudo[$value->hash] as $k => $v) {
                $temp[$value->hash][$v->receiver_id][$k] = $v;
            }
        }
        
        foreach($hash as $k => $v) {
            $giver[$v->hash] = array();
            foreach($temp[$v->hash] as $key => $value) {
                $giver[$v->hash][$key] = sizeof($value);
            }
            arsort($giver[$v->hash]);
        }

        foreach($hash as $k => $v) {
            foreach($giver[$v->hash] as $key => $value) {
                echo "hash: $v->hash giver_id: $key quantity: $value";
                echo "<p>";
            }
        }
    }

}
?>