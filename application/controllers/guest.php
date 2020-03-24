<?php
class Guest extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION)){
			session_start();
		}
		
		$this->load->library('session');
	}

	function index(){
		$data['title'] = "Home";
		$data['contents'] = 'index';
		$data['files'] = $this->MFile->getAllFiles();
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

	function access_denied(){
		$this->output->set_status_header('403');
		$this->load->view('errors/cli/error_403');
	}
	
}

?>
