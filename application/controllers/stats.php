<?php
class Stats extends CI_Controller {
    function __construct() {
	    // Call the Controller constructor
	    parent::__construct();
	    session_start();
	    $this->load->database();
    }

    function get_top_kudo_receiver() {
    	$this->load->model('kudo_model');
    	$kudo = $this->kudo_model->get_all();

    	$temp = array();
    	foreach($kudo as $key => $value) {
    		$temp[$value->receiver_id][$key] = $value;
    	}

    	$top_receiver = array();
    	foreach($temp as $key => $value) {
    		$top_receiver[$key] = sizeof($value);
    	}

    	arsort($top_receiver);

    	foreach($top_receiver as $key => $value) {
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

    function get_top_kudo_giver() {
    	$this->load->model('kudo_model');
    	$kudo = $this->kudo_model->get_all();

    	$temp = array();
    	foreach($kudo as $key => $value) {
    		$temp[$value->giver_id][$key] = $value;
    	}

    	$top_giver = array();
    	foreach($temp as $key => $value) {
    		$top_giver[$key] = sizeof($value);
    	}

    	arsort($top_giver);

    	foreach($top_giver as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    }

    function get_top_coin_receiver() {
    	$this->load->model('kudo_model');
    	$kudo = $this->kudo_model->get_all();
    	$this->load->model('transaction_model');
    	$coin = $this->transaction_model->get_all();
    	
    	$temp1 = array();
    	foreach($kudo as $key => $value) {
    		$temp1[$value->receiver_id][$key] = $value;
    	}
    	$temp2 = array();
    	foreach($coin as $key => $value) {
    		$temp2[$value->receiver_id][$key] = $value;
    	}

    	$top_receiver1 = array();
    	foreach($temp1 as $key => $value) {
    		$quantity = 0;
    		foreach($value as $k => $v) {
    			$quantity += $v->quantity;
    		}
    		$top_receiver1[$key] = $quantity;
    	}
    	$top_receiver2 = array();
    	foreach($temp2 as $key => $value) {
    		$quantity = 0;
    		foreach($value as $k => $v) {
    			$quantity += $v->quantity;
    		}
    		$top_receiver2[$key] = $quantity;
    	}

    	foreach($top_receiver1 as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    	echo "<hr>";
    	foreach($top_receiver2 as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    	echo "<hr>";

    	$top_receiver3 = $top_receiver1;
		foreach($top_receiver2 as $k => $v) {
		    if (array_key_exists($k, $top_receiver3)) {
		       $top_receiver3[$k] += $v;
		    }
		    else {
		       $top_receiver3[$k] = $v; 
		    }
		}

		arsort($top_receiver3);

		foreach($top_receiver3 as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    }	

    function get_top_coin_giver() {
    	$this->load->model('kudo_model');
    	$kudo = $this->kudo_model->get_all();
    	$this->load->model('transaction_model');
    	$coin = $this->transaction_model->get_all();
    	
    	$temp1 = array();
    	foreach($kudo as $key => $value) {
    		$temp1[$value->giver_id][$key] = $value;
    	}
    	$temp2 = array();
    	foreach($coin as $key => $value) {
    		$temp2[$value->giver_id][$key] = $value;
    	}

    	$top_giver1 = array();
    	foreach($temp1 as $key => $value) {
    		$quantity = 0;
    		foreach($value as $k => $v) {
    			$quantity += $v->quantity;
    		}
    		$top_giver1[$key] = $quantity;
    	}
    	$top_giver2 = array();
    	foreach($temp2 as $key => $value) {
    		$quantity = 0;
    		foreach($value as $k => $v) {
    			$quantity += $v->quantity;
    		}
    		$top_giver2[$key] = $quantity;
    	}

    	foreach($top_giver1 as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    	echo "<hr>";
    	foreach($top_giver2 as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    	echo "<hr>";

    	$top_giver3 = $top_giver1;
		foreach($top_giver2 as $k => $v) {
		    if (array_key_exists($k, $top_giver3)) {
		       $top_giver3[$k] += $v;
		    }
		    else {
		       $top_giver3[$k] = $v; 
		    }
		}

		arsort($top_giver3);

		foreach($top_giver3 as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    }

    function get_top_like_receiver() {
    	$this->load->model('likes_model');
    	$like = $this->likes_model->get_all();

    	$temp = array();
    	foreach($like as $key => $value) {
    		$temp[$value->receiver_id][$key] = $value;
    	}

    	$top_receiver = array();
    	foreach($temp as $key => $value) {
    		$top_receiver[$key] = sizeof($value);
    	}

    	arsort($top_receiver);

    	foreach($top_receiver as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    }

    function get_top_like_giver() {
    	$this->load->model('likes_model');
    	$like = $this->likes_model->get_all();

    	$temp = array();
    	foreach($like as $key => $value) {
    		$temp[$value->giver_id][$key] = $value;
    	}

    	$top_giver = array();
    	foreach($temp as $key => $value) {
    		$top_giver[$key] = sizeof($value);
    	}

    	arsort($top_giver);

    	foreach($top_giver as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    }

    function get_top_comment_receiver() {
    	$this->load->model('comment_model');
    	$comment = $this->comment_model->get_all();

    	$temp = array();
    	foreach($comment as $key => $value) {
    		$temp[$value->receiver_id][$key] = $value;
    	}

    	$top_receiver = array();
    	foreach($temp as $key => $value) {
    		$top_receiver[$key] = sizeof($value);
    	}

    	arsort($top_receiver);

    	foreach($top_receiver as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    }

    function get_top_comment_giver() {
    	$this->load->model('comment_model');
    	$comment = $this->comment_model->get_all();

    	$temp = array();
    	foreach($comment as $key => $value) {
    		$temp[$value->giver_id][$key] = $value;
    	}

    	$top_giver = array();
    	foreach($temp as $key => $value) {
    		$top_giver[$key] = sizeof($value);
    	}

    	arsort($top_giver);

    	foreach($top_giver as $key => $value) {
    		echo "key: $key value: $value";
    		echo "<p>";
    	}
    }

    function get_top_hash_receiver() {
    	$this->load->model('kudo_model');
    	$this->load->model('hash_model');
    	$hash = $this->hash_model->get_all();

    	$kudo = array();
    	foreach ($hash as $key => $value) {
    		$kudo[$value->hash] = $this->kudo_model->get_by_hash($value->hash);
    		$temp[$value->hash] = array();
    		foreach($kudo[$value->hash] as $k => $v) {
	    		$temp[$value->hash][$v->receiver_id][$k] = $v;
	    	}
    	}
    	
    	/*
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
		*/

    	foreach($hash as $k => $v) {
	    	$top_receiver[$v->hash] = array();
	    	foreach($temp[$v->hash] as $key => $value) {
	    		$top_receiver[$v->hash][$key] = sizeof($value);
	    	}
	    	arsort($top_receiver[$v->hash]);
	    }

	    foreach($hash as $k => $v) {
	    	foreach($top_receiver[$v->hash] as $key => $value) {
	    		echo "hash: $v->hash receiver_id: $key quantity: $value";
	    		echo "<p>";
	    	}
	    }
    }

    function get_top_hash_giver() {
    	$this->load->model('kudo_model');
    	$this->load->model('hash_model');
    	$hash = $this->hash_model->get_all();

    	$kudo = array();
    	foreach ($hash as $key => $value) {
    		$kudo[$value->hash] = $this->kudo_model->get_by_hash($value->hash);
    		$temp[$value->hash] = array();
    		foreach($kudo[$value->hash] as $k => $v) {
	    		$temp[$value->hash][$v->giver_id][$k] = $v;
	    	}
    	}
    	
    	foreach($hash as $k => $v) {
	    	$top_giver[$v->hash] = array();
	    	foreach($temp[$v->hash] as $key => $value) {
	    		$top_giver[$v->hash][$key] = sizeof($value);
	    	}
	    	arsort($top_giver[$v->hash]);
	    }

	    foreach($hash as $k => $v) {
	    	foreach($top_giver[$v->hash] as $key => $value) {
	    		echo "hash: $v->hash giver_id: $key quantity: $value";
	    		echo "<p>";
	    	}
	    }
    }

}
?>