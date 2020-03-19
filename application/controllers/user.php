<?php
class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION)){
			session_start();
		}
		$this->load->library('session');
		if(!$this->session->has_userdata('idUser')){
			redirect('access_denied');
		}
		require_once ('vendor\autoload.php');
	}
	
	function index(){
		$data['title'] = "Student Resource";
		$data['contents'] = 'user/index';

		$this->load->vars($data);
		$this->load->view('layout/template');
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
			$data['users'] = $this->MClass->getClassmates($id);
			$data['activities'] = $this->MClass->getClassActivities($id);
			$data['subject'] = $this->MClass->getClassSubject($id);
			$data['performances'] = $this->MActivity->getStudentPerformances($id);
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
		$data['title'] = "Student Activity";
		$data['contents'] = 'user/user_todo';
		$data['todos'] = $this->MActivity->getUserToDo();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}
	
	function logout(){
		$this->session->unset_userdata('idUser');
		$this->session->unset_userdata('idTeacher');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('first_name');
		$this->session->unset_userdata('last_name');
		unset($_SESSION['idAdmin']);
		redirect('login');
	}
}
?>
