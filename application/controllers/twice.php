<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

class Twice extends CI_Controller {
    	function __construct() {
	    	parent::__construct();
	    	if(!isset($_SESSION)) {
			session_start();
		}
	    	$this->load->database();        
    	}    
	
	function index() {
		echo "Hi";
	}

	function vote($id) {
		
	}

	function sendRank() {

	}	

	function get_activity() {
		$this->load->model('twice_model');
        	$kudos = $this->twice_model->get_all();	
		echo json_encode($kudos);	
	}
}
?>
