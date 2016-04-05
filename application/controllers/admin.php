<?php
class Admin extends CI_Controller {
    function __construct() {
  	    parent::__construct();
        session_start();
        $this->load->database();
        // Configure settings for uploading images
        /*
        $config['upload_path'] = realpath(APPPATH . '../images/product');
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);	    	
        */
    }

    function check_admin() {
        if (!isset($_SESSION["id"]) || !isset($_SESSION["email"]) || !isset($_SESSION["admin"])) {
            redirect('user/index', 'refresh');
        }
    }

    function logout() {
        $this->check_admin();
        $_SESSION = array();
        // sends as Set-Cookie to invalidate the session cookie
        if (isset($_COOKIE[session_name()])) { 
            $params = session_get_cookie_params();
            setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
        }
        session_destroy();
        modules::run('user/index','refresh');
    }

    /*
    function activity() {
        $this->check_admin();
        $this->load->view('src.php');
        $this->load->view('admin_menu.php');
        $this->load->view('admin_header.php');
        $this->load->view('admin_footer.php');
        $this->load->view('admin_activity.php');
    }
    */

    function manage() {
        $this->check_admin();
        $this->load->view('src.php');
        $this->load->view('admin/menu.php');
        $this->load->view('admin/header.php');
        $this->load->view('admin/footer.php');
        $this->load->view('admin/manage.php');
    }

    /*
    function delete_user() {

    }

    function delete_all_user() {

    }

    function suspend() {

    }

    function activate() {

    }

    function add_hash() {

    }

    function delete_hash() {

    }

    function add_coin() {

    }

    function delete_coin() {

    }

    function change_daily_coin() {

    }

    function change_weekly_coin() {

    }

    function invite() {

    }

    function turnover() {

    }

    function reset() {

    }
    */
}
?>
