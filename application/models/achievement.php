<?php
class Achievement extends CI_Model {
	
	public $achievement_id;
	public $achievement_name;
	public $user_id;
	public $date;
	public $is_deleted;

	/*
	private $achievement_id;
	private $achievement_name;
	private $user_id;
	private $date;
	private $is_deleted;
	
	public function get_achievement_id() {
		return $this->achievement_id;
	}

	public function set_achievement_id($achievement_id) {
		$this->achievement_id = $achievement_id;
	}

	public function get_achievement_name() {
		return $this->achievement_name;
	}

	public function set_achievement_name($achievement_name) {
		$this->achievement_name = $achievement_name;
	}

	public function get_user_id() {
		return $this->user_id;
	}

	public function set_user_id($user_id) {
		$this->user_id = $user_id;
	}

	public function get_date() {
		return $this->date;
	}

	public function set_date($date) {
		$this->date = $date;
	}

	public function get_is_deleted() {
		return $this->is_deleted;
	}

	public function set_is_deleted($is_deleted) {
		$this->is_deleted = $is_deleted;
	}
	*/
}
?>
