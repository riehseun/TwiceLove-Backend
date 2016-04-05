<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

class User extends CI_Controller {
    	function __construct() {
	    	parent::__construct();
	    	if(!isset($_SESSION)) {
			session_start();
		}
	    	$this->load->database();        
    	}
    
    	function check_login() {    
		if (!isset($_SESSION["user_id"])) {
	        	redirect('user/index', 'refresh');
	    	}
		else if (!isset($_SESSION["user_id"])) {
			
		}  
    	}

    	function index() {
    		if(isset($_SESSION["user_id"])) {
    			$this->activity();
    		}
    		else {
    			$this->load->view('src.php');
	    		$this->load->view('user/header.php');
	    		$this->load->view('user/index.php');
    		}
    	}
    
    	function register() {
		$this->load->library('form_validation');
	    	$this->form_validation->set_rules('firstName','FirstName','required|min_length[1]|max_length[16]');
	    	$this->form_validation->set_rules('lastName', 'LastName', 'required|min_length[1]|max_length[16]');
	    	//$this->form_validation->set_rules('email','Email','required|is_unique[user.email]|min_length[1]|max_length[64]');
	    	$this->form_validation->set_rules('email','Email','required|min_length[1]|max_length[64]');
		$this->form_validation->set_rules('password','Password','required|min_length[1]|max_length[16]');
	    	//$this->form_validation->set_rules('passwordconf','Password Confirmation','required|matches[password]');
	    	if ($this->form_validation->run() == true) {
	    		$this->load->model('user_model');
            		//$this->load->model('admin_model');
            		//$period = $this->turnover_model->get_period();
            		//$daily_coin = $this->turnover_model->get_daily_coin();
	        	$user_id = $this->user_model->insert($_POST);
	        	if ($user_id != null) {
		        	$_SESSION["user_id"] = $user_id;
		        	$_SESSION["email"] = $_POST["email"];
		        	$_SESSION["password"] = $_POST["password"];
		        	$_SESSION["first_name"] = $_POST["firstName"];
		        	$_SESSION["last_name"] = $_POST["lastName"];
		       		//redirect('user/activity','refresh');
				$success = array("error"=>false, "uid"=>$user_id, "user"=>array("firstName"=>$_POST["firstName"], "lastName"=>$_POST["lastName"], "email"=>$_POST["email"], "created_at"=>"who knows", "updated_at"=>"who knows"));
				echo json_encode($success); 
	       	 	}
	        	else {
		        	//$data['message'] = $this->db->_error_number();
		        	//$this->load->view('src.php');
		        	//$this->load->view('user/index.php');
				$err_msg = array("tag"=>"register", "success"=>false, "error"=>true, "error_msg"=>"Error creating user");	
				echo json_encode($err_msg);
	        	}
	    	}
	    	else {
	        	//$data['message'] = 'Invalide input';
	        	//$this->load->view('src.php');
	        	//$this->load->view('user/index.php');
			//$err_msg = array("tag"=>"login", "success"=>false, "error"=>true, "error_msg"=>"Form validation fail");
			$err_msg = array("tag"=>"register", "success"=>false, "error"=>true, "error_msg"=>"params"." ".$_POST["firstName"]." ".$_POST["lastName"]." ".$_POST["email"]." ".$_POST["password"]);
			//$err_msg = array("tag"=>"login", "success"=>false, "error"=>true, "error_msg"=>$_POST["email"]);
			echo json_encode($err_msg);
	    	}
    	}	

    
    	function login() {
	    	$this->load->library('form_validation');
	    	$this->form_validation->set_rules('email','Email','required|min_length[1]|max_length[64]');
	    	$this->form_validation->set_rules('password','Password','required|min_length[1]|max_length[16]');
	    	if ($this->form_validation->run() == true) {
	    		$this->load->model('admin_model');
	    		$admin = $this->admin_model->get_by_email($_POST["email"]);
	    		if ($admin !== null && strcmp($admin->password, $_POST["password"]) == 0) {
	    			$_SESSION["admin_id"] = $admin->admin_id;
		        	$_SESSION["email"] = $admin->email;
		        	$_SESSION["password"] = $admin->password;
		        	$_SESSION["admin"] = "admin";
		        	//redirect('user/admin_activity', 'refresh');
				$success = array("error"=>false, "uid"=>$admin->admin_id, "user"=>array("firstName"=>"Admin", "lastName"=>"Admin", "email"=>$admin->email, "created_at"=>"who knows", "updated_at"=>"who knows"));
				echo json_encode($success);
	    		}
	    		else {
	    			$this->load->model('user_model');
		        	$user = $this->user_model->get_by_email($_POST["email"]);
		        	if ($user != null && strcmp($user->password, $_POST["password"]) == 0) {
			        	$_SESSION["user_id"] = $user->user_id;
			        	$_SESSION["email"] = $user->email;
			        	$_SESSION["password"] = $user->password;
			        	//redirect('user/activity','refresh');
					$success = array("error"=>false, "uid"=>$user->user_id, "user"=>array("firstName"=>$user->first_name, "lastName"=>$user->last_name, "email"=>$user->email, "created_at"=>"who knows", "updated_at"=>"who knows"));
					echo json_encode($success);
		        	} 
				else {
			        	//echo "<script type='text/javascript'>history.back(alert('Wrong ID or Password'))</script>";
			        	//$this->load->view('src.php');
			        	//$this->load->view('user/header.php');
		        		//$this->load->view('user/index.php');
					$err_msg = array("tag"=>"login", "success"=>false, "error"=>true, "error_msg"=>"Login credentials are incorrect. Please try again!");
					echo json_encode($err_msg);        	
		        	}
	    		}	   
	    	}
	    	else {
	    		//echo "<script type='text/javascript'>history.back(alert('form validation failed'))</script>";
	        	//$this->load->view('src.php');
	        	//$this->load->view('user/header.php');
	        	//$this->load->view('user/index.php');
			$err_msg = array("tag"=>"login", "success"=>false, "error"=>true, "error_msg"=>"Login credentials are incorrect. Please try again!");
			echo json_encode($err_msg);
	    	}
    	}

    	function logout() {
        	$this->check_login();
        	$_SESSION = array();
        	// sends as Set-Cookie to invalidate the session cookie
        	if (isset($_COOKIE[session_name()])) { 
            		$params = session_get_cookie_params();
            		setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
        	}
        	session_destroy();
        	redirect('user/index','refresh');
    	}
	
    function activity() {
    	$this->check_login();
    	$this->load->view('src.php');
    	$this->load->view('user/menu.php');
    	$this->load->view('user/header.php');
    	$this->load->view('user/footer.php');
    	$this->load->view('user/activity.php');
    }

    function employee() {
    	$this->check_login();
	    $this->load->view('src.php');
    	$this->load->view('user/menu.php');
    	$this->load->view('user/header.php');
    	$this->load->view('user/footer.php');
    	$this->load->view('user/employee.php');
    }

    function setting() {
        $this->check_login();
        $this->load->view('src.php');
        $this->load->view('user/menu.php');
        $this->load->view('user/header.php');
        $this->load->view('user/footer.php');
        $this->load->view('user/setting.php');
    }

    function inbox() {
        $this->check_login();
        $this->load->view('src.php');
        $this->load->view('user/menu.php');
        $this->load->view('user/header.php');
        $this->load->view('user/footer.php');
        $this->load->view('user/inbox.php');
    }

    function profile() {
        $this->check_login();
        $this->change_profile_id($_POST["id"]);
        $this->load->view('src.php');
        $this->load->view('user/menu.php');
        $this->load->view('user/header.php');
        $this->load->view('user/footer.php');
        $this->load->view('user/profile.php');
    }

    function change_profile_id($id) {
        $_SESSION["profile_id"] = $id;
    }

    function get_profile_id() {
        echo json_encode($_SESSION["profile_id"]);
    }

    function my_profile() {
        $this->check_login();
        $this->load->view('src.php');
        $this->load->view('user/menu.php');
        $this->load->view('user/header.php');
        $this->load->view('user/footer.php');
        $this->load->view('user/my_profile.php');
    }

    function get_activity() {
        $this->check_login();
        $this->load->model('kudo_model');
        $kudos = $this->kudo_model->get_all();
        
        $this->load->model('employee_model');

        
        $this->load->model('likes_model');
        $likes_array = array();

        for ($i=0; $i<sizeof($kudos); $i++) {
            $giver_photo_url = $this->employee_model->get_photo_url_by_id($kudos[$i]->giver_id);
            $receiver_photo_url = $this->employee_model->get_photo_url_by_id($kudos[$i]->receiver_id);
            if ($this->likes_model->check_likes($kudos[$i]->id, $_SESSION["id"], $kudos[$i]->receiver_id)) {
                array_push($likes_array, $kudos[$i]->id);
            }
        }

        array_push($kudos, $likes_array);

        $this->load->model('coin_model');
        $coins = $this->coin_model->get_all();
        $coin_array = array();
        for ($i=0; $i<sizeof($coins); $i++) {
            array_push($coin_array, $coins[$i]->value);
        }
        array_push($kudos, $coin_array);

        echo json_encode($kudos);
    }

    function get_employee() {
    	$this->check_login();
    	$this->load->model('employee_model');
	    $employees = $this->employee_model->get_except_me($_SESSION['id']);

        $this->load->model('hash_model');
        $hashes = $this->hash_model->get_all();
        $hash_array = array();
        for ($i=0; $i<sizeof($hashes); $i++) {
            array_push($hash_array, $hashes[$i]->{"hash"});
        }
        array_push($employees, $hash_array);

	    $this->load->model('coin_model');
    	$coins = $this->coin_model->get_all();
    	$coin_array = array();
    	for ($i=0; $i<sizeof($coins); $i++) {
    		array_push($coin_array, $coins[$i]->{"value"});
    	}
    	array_push($employees, $coin_array);
        
	    echo json_encode($employees);
    }

    function get_employee_by_id() {
    	$this->check_login();
    	$id = $_POST["id"];
    	$this->load->model('employee_model');
	    $employees = $this->employee_model->get_by_id($id);
	    echo json_encode($employees);
    }

    function get_session_id() {
    	if (isset($_SESSION["id"])) {
    		echo json_encode($_SESSION["id"]);
    	}
    	else {
    		echo json_encode(false);
    	}
    }

    function get_inbox() {
        $this->check_login();

        $this->load->model('kudo_model');
        $kudos = $this->kudo_model->get_by_receiver_id($_SESSION["id"]);

        $this->load->model('transaction_model');
        $coins = $this->transaction_model->get_by_receiver_id($_SESSION["id"]);

        $this->load->model('likes_model');
        $likes = $this->likes_model->get_by_receiver_id($_SESSION["id"]);

        $this->load->model('comment_model');
        $comments = $this->comment_model->get_by_receiver_id($_SESSION["id"]);

        $result = array("kudos" => $kudos, "coins" => $coins, "likes" => $likes, "comments" => $comments);
        echo json_encode($result);        
    }

    function get_profile() {
        $this->check_login();
        $this->load->model('employee_model');
        $employee = $this->employee_model->get_by_id($_POST["id"]);
        echo json_encode($employee);
    } 

    function get_my_profile() {
        $this->check_login();
        $this->load->model('employee_model');
        $employee = $this->employee_model->get_by_id($_SESSION["id"]);
        echo json_encode($employee);
    }

    function give_kudo() {
        $this->check_login();
        $hash = $_POST["hash"];
        $message = $_POST["message"];
        $quantity = $_POST["quantity"];
        $this->load->model('employee_model');
        $giver = $this->employee_model->get_by_id($_SESSION["id"]);
        $receiver = $this->employee_model->get_by_id($_POST["eid"]); 

        $check = $this->employee_model->check_coins_left($giver, $quantity);
        if ($check !== true) {
            echo "not enough coins left";
        }
        else {
            $this->load->model('kudo_model');
            $this->load->model('turnover_model');
            $result = $this->turnover_model->get_all();
            var_dump($result);
            $period = $result[0]->period;
            //$daily_coin = $this->turnover_model->get_daily_coin();
            //echo $period;
            $result = $this->kudo_model->insert($giver, $quantity, $hash, $message, $receiver, $period);
            if ($result !== false) {
                $this->employee_model->update_giver($giver, $quantity);
                $this->employee_model->update_receiver($receiver, $quantity);
                //redirect('user/activity','refresh');
            }
            else {
                echo "insert into kudo failed";
            }
        }        
    }

    function give_coin() {
        $this->check_login();
        $quantity = $_POST["quantity"];
        $this->load->model('employee_model');
        $giver = $this->employee_model->get_by_id($_SESSION["id"]);
        $receiver = $this->employee_model->get_by_id($_POST["eid"]); 
        if ($_SESSION["id"] === $_POST["eid"]) {
            echo "you can't give yourself coins";
            redirect('user/activity','refresh');
        }
        else {
            $check = $this->employee_model->check_coins_left($giver, $quantity);
            if ($check !== true) {
                echo "not enough coins left";
                redirect('user/activity','refresh');
            }
            else {
                $this->load->model('transaction_model');
                $this->load->model('turnover_model');
                $turnover = $this->turnover_model->get_all();
                $period = $turnover[0]->period;
                $result = $this->transaction_model->insert($giver, $quantity, $receiver, $period);
                if ($result !== false) {
                    $this->employee_model->update_giver($giver, $quantity);
                    $this->employee_model->update_receiver($receiver, $quantity);
                    redirect('user/activity','refresh');
                }
                else {
                    echo "insert into transaction failed";
                }
            }  
        }
    }
    
    function give_like() {
        $this->check_login();
        if ($_SESSION["id"] === $_POST["eid"]) {
            echo "You cannot like yourself";
            redirect('user/activity','refresh');
        }

        $this->load->model('employee_model');
        $kudo_id = $_POST["kudo_id"];
        $giver = $this->employee_model->get_by_id($_SESSION["id"]);
        $receiver = $this->employee_model->get_by_id($_POST["eid"]); 

        $this->load->model('likes_model');
        $check = $this->likes_model->check_likes($kudo_id, $giver->id, $receiver->id);
        if ($check !== false) {
            echo "already gave like for that kudo";
            redirect('user/activity','refresh');
        }
        else {
            $this->load->model('turnover_model');
            $turnover = $this->turnover_model->get_all();
            $period = $turnover[0]->period;
            $result = $this->likes_model->insert($kudo_id, $giver->id, $receiver->id, $period);
            if ($result !== false) {
                redirect('user/activity','refresh');
            }
            else {
                echo "insert into like failed";
            }
        }      
    }

    function take_like() {
        $this->check_login();
        $this->load->model('employee_model');
        $kudo_id = $_POST["kudo_id"];
        $giver = $this->employee_model->get_by_id($_SESSION["id"]);
        $receiver = $this->employee_model->get_by_id($_POST["eid"]); 

        $this->load->model('likes_model');
        $check = $this->likes_model->check_likes($kudo_id, $giver->id, $receiver->id);
        if ($check === false) {
            echo "You can not take like back when you did not give any like in the first place";
            redirect('user/activity','refresh');
        }
        else {
            $result = $this->likes_model->delete($kudo_id, $giver->id, $receiver->id);
            if ($result !== false) {
                redirect('user/activity','refresh');
            }
            else {
                echo "delete from like failed";
            }
        }      
    }
    
    function give_comment() {
        $this->check_login();
        if ($_SESSION["id"] === $_POST["eid"]) {
            echo "You cannot commment on yourself";
            redirect('user/profile','refresh');
        }
        else {
            $this->load->model('employee_model');
            $comment = $_POST["comment"];
            $option = $_POST["option"];
            $giver = $this->employee_model->get_by_id($_SESSION["id"]);
            $receiver = $this->employee_model->get_by_id($_POST["eid"]); 
            $this->load->model('comment_model');
            $this->load->model('turnover_model');
            $turnover = $this->turnover_model->get_all();
            $period = $turnover[0]->period;
            $result = $this->comment_model->insert($giver, $comment, $option, $receiver, $period);
            if ($result !== false) {
                redirect('user/profile','refresh');
            }
            else {
                echo "insert into comment failed";
            }
        }
    }

    function get_photo() {
        $this->check_login();
        $this->load->model('employee_model');
        $result = $this->employee_model->get_photo_url_by_id($_SESSION["id"]);
        if ($result === false) {
            echo json_encode("failed");
        }
        else {
            echo json_encode($result);
        }
    }

    function upload_photo() {
        $new_url = "/efa/img/" . basename($_FILES["fileToUpload"]["name"]);
        $directory = "/var/www/html/efa/img/" . basename($_FILES["fileToUpload"]["name"]);
        $image_type = pathinfo($new_url, PATHINFO_EXTENSION);
        if ($image_type != "jpg" && $image_type != "png" && $image_type != "jpeg") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $directory) === false) {
                echo "photo upload failed";
            }
            else {  
                $this->load->model('employee_model');
                $result = $this->employee_model->update_photo($_SESSION["id"], $new_url);
                if ($result === false) {
                    echo json_encode("photo update failed");
                }
                else {
                    $result = $this->employee_model->get_photo_url_by_id($_SESSION["id"]);
                    if ($result === false) {
                        echo json_encode("photo read failed");
                    }
                    else {
                        //echo json_encode($result);
                        redirect('user/setting','refresh');
                    }
                }
            }
        }
    } 

    /*
    function kudo() {

    }

    function like() {

    }

    function comment() {

    }

    function autoload() {

    }

    function fbconfig() {

    }
    */

    function check_admin() {
        if (!isset($_SESSION["id"]) || !isset($_SESSION["email"]) || !isset($_SESSION["admin"])) {
            redirect('user/index', 'refresh');
        }
    }

    function admin_activity() {
        $this->check_admin();
        $this->load->view('src.php');
        $this->load->view('admin/menu.php');
        $this->load->view('admin/header.php');
        $this->load->view('admin/footer.php');
        $this->load->view('admin/activity.php');
    }

    function manage() {
        $this->check_admin();
        $this->load->view('src.php');
        $this->load->view('admin/menu.php');
        $this->load->view('admin/header.php');
        $this->load->view('admin/footer.php');
        $this->load->view('admin/manage.php');
    }

    function add_coin() {
    	$this->check_admin();
    	$coin = $this->input->post('add_coin');
    	$this->load->model('coin_model');
	    $result = $this->coin_model->insert($coin);
        if ($result != false) {
            redirect('user/manage','refresh');
        }
		else {
            echo "into into add_coin failed";
        }
    }

    function delete_coin() {
    	$this->check_admin();
    	$value = $_POST["delete_coin"];
    	$this->load->model('coin_model');
	    $coins = $this->coin_model->delete($value);
	    redirect('user/manage','refresh');
    }

    function get_coin() {
    	$this->check_login(); 
    	$this->load->model('coin_model');
    	$coins = $this->coin_model->get_all();
    	echo json_encode($coins);
    }

    function add_hash() {
        $this->check_admin();
        $hash = $this->input->post('add_hash');
        $this->load->model('hash_model');
        $result = $this->hash_model->insert($hash);
        if ($result != false) {
            redirect('user/manage','refresh');
        }
        else {
            echo "insert into add_hash failed";
        }
    }

    function delete_hash() {
        $this->check_admin();
        $value = $_POST["delete_hash"];
        $this->load->model('hash_model');
        $this->hash_model->delete($value);
        redirect('user/manage','refresh');
    }

    function get_hash() {
        $this->check_login(); 
        $this->load->model('hash_model');
        $hashes = $this->hash_model->get_all();
        echo json_encode($hashes);
    }

    function reset_coin() {
        $this->check_admin();
        $this->load->model('employee_model');
        if($this->employee_model->reset_coin() === false) {
            echo json_encode("reset failed");
        }
        else {
            echo json_encode("reset succeeded");
        }
    }

    function delete_kudo() {
        $this->check_admin();
        $this->load->model('kudo_model');
        $this->load->model('transaction_model');
        if ($this->kudo_model->delete_all() === false || $this->transaction_model->delete_all() === false) {
            echo json_encode("delete failed");
        }
        else {
            echo json_encode("delete succeeded");
        }
    }

    function delete_comment() {
        $this->check_admin();
        $this->load->model('comment_model');
        if($this->comment_model->delete_all() === false) {
            echo json_encode("delete failed");
        }
        else {
            echo json_encode("delete succeeded");
        }
    }

    function initialize() {
        $this->check_admin();
        $this->load->model('turnover_model');
        $period = $_POST["period"];
        $daily_coin = $_POST["daily_coin"];
        $this->turnover_model->delete_all();
        if($this->turnover_model->insert($period, $daily_coin) === false) {
            echo json_encode("initiaize failed");
        }
        else {
            echo json_encode("initiaize succeeded");
            redirect('admin/manage', 'refresh');
        }
    }

    function get_turnover() {
        $this->check_admin();
        $this->load->model('turnover_model');
        $result = $this->turnover_model->get_all();
        echo json_encode($result);
    }

    function change_coin() {
        $this->check_admin();
        $this->load->model('turnover_model');
        $coin = $_POST["coin"];
        if($this->turnover_model->update($coin) === false) {
            echo json_encode("change failed");
        }
        else {
            echo json_encode("change succeeded");
        }
    }

    function increment_period() {
        $this->check_admin();
        $this->load->model('turnover_model');
        $result = $this->turnover_model->increment_period();
        echo json_encode($result);
    }

    function decrement_period() {
        $this->check_admin();
        $this->load->model('turnover_model');
        $result = $this->turnover_model->decrement_period();
        echo json_encode($result);
    }
}
?>
