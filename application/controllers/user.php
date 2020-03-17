<?php
class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
		require_once ('vendor\autoload.php');
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
		$this->session->unset_userdata('idUser');
		$this->session->unset_userdata('idTeacher');
		$this->session->unset_userdata('username');
		unset($_SESSION['idAdmin']);
		redirect('login');
	}

	function classes(){
		$data['title'] = "Classes";
		$data['contents'] = 'user/user_class';
		$data['classes'] = $this->MClass->getAllUserClasses();
		$data['allClass'] = $this->MClass->getAllClass();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function showUserClass($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			redirect('class');
		} else{
			$data['title'] = "Class";
			$data['contents'] = 'user/show_class';
			$data['class'] = $this->MClass->getCLass($id);
			$data['users'] = $this->MClass->getClassUsers($id);
			$data['activities'] = $this->MClass->getClassActivities($id);
			$data['subject'] = $this->MClass->getClassSubject($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function addClass(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			if($this->MClass->getCode($_POST['idClass'])['class_code'] != $_POST['class_code']){
				echo $this->MClass->getCode($_POST['idClass']);
				echo "<script>alert('Wrong Code ')</script>";
			} else{
				$this->MUser->addClass();
				redirect('user/classes');
			}
		} 
	}

	function activity($id){
		$data['title'] = "Student Activity";
		$data['contents'] = 'user/user_activity';
		$data['file'] = $this->MFile->getUserFile($id);
		$data['activity'] = $this->MActivity->getActivity($id);
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function todo(){

	}
}
?>
