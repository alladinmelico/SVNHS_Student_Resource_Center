<?php
class Teacher extends CI_Controller{
    public function __construct(){
        parent::__construct();
		require_once ('vendor\autoload.php');

		if(!isset($_SESSION)){
            session_start();
        }
	}

	function index(){
		$data['title'] = "Teacher Resource Center";
		$data['contents'] = 'teacher/index';
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	
}
?>
