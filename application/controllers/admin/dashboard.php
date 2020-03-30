<?php
class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$this->session->has_userdata('isAdmin')){
			redirect('access_denied');
		}
	}

	function index(){
		$data['title'] = "Admin";
		$data['contents'] = 'admin/dashboard';
		$data['users'] = $this->MUser->getAllUsers();
		$data['teachers'] = $this->MTeacher->getAllTeachers();
		$data['classes'] = $this->MClass->getAllClass();
		$data['activities'] = $this->MActivity->getAllActivities();
		$data['unverified'] = $this->MUser->getAllUsersUnverified();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function activate(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			print_r($_POST);
			if($_POST['action']=='user'){
				$this->MUser->activate();
				redirect('admin/dashboard');
			}
		}
	}

	function deactivate(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			print_r($_POST);
			if($_POST['action']=='user'){
				$this->MUser->deactivate();
				redirect('admin/dashboard');
			}
		}
	}

}
?>
