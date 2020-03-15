<?php
class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION)){
            session_start();
		}
		$this->load->library('session');
	}
	
	function index(){
		$data['title'] = "Student Resource";
		$data['contents'] = 'user/index';

		$this->load->vars($data);
		$this->load->view('layout/template');
	}

    function login(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MUser->verify();
		} else{
			$data['title'] = "Login";
			$this->load->vars($data);
			$this->load->view('Login');
		}
	}
	

    function register(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MUser->create();
			redirect('login');
		} else{
			$data['title'] = "Register";
			$this->load->vars($data);
			$this->load->view('register');
		}
	}
	
	function logout(){
		session_write_close();
		unset($_SESSION['idAdmin']);
		redirect('login');
	}
}
?>
