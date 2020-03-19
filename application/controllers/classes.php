<?php
class Classes extends CI_Controller{
    public function __construct(){
        parent::__construct();
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$this->session->has_userdata('idTeacher')){
			redirect('access_denied');
		}
		require_once ('vendor\autoload.php');
	}

	function index(){
		$data['title'] = "Classes";
		$data['contents'] = 'class/index';
		$data['classes'] = $this->MClass->getAllTeacherClasses();
		$data['subjects'] = $this->MSubject->getAllSubjects();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function show($id){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			redirect('class');
		} else{
			$data['title'] = "Class";
			$data['contents'] = 'class/show';
			$data['class'] = $this->MClass->getCLass($id);
			$data['users'] = $this->MClass->getClassUsers($id);
			$data['activities'] = $this->MClass->getClassActivities($id);
			$data['subject'] = $this->MClass->getClassSubject($id);
			$data['scores'] = $this->MClass->getClassAverageScores($id);
			$data['topStudents'] = $this->MClass->getTopStudents($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function create(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MClass->create();
			redirect('classes');
		} else{
			$data['title'] = "Create Class";
			$data['contents'] = 'class/create';
			$data['subjects'] = $this->MSubject->getAllSubjects();
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function update($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MClass->update();
			redirect('file');
		} else {
			$data['title'] = "Update";
			$data['contents'] = 'class/edit';
			$data['class'] = $this->MClass->getClass($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function delete(){

	}
}
?>
