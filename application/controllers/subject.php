<?php
class Subject extends CI_Controller{
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
		$data['title'] = "Subjects";
		$data['contents'] = 'subject/index';
		$data['subjects'] = $this->MSubject->getAllTeacherSubjects();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function show($id){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			redirect('subject');
		} else{
			$data['title'] = "subject";
			$data['contents'] = 'subject/show';
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function create(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->Msubject->create();
			redirect('subject');
		} else{
			$data['title'] = "Create subject";
			$data['contents'] = 'subject/create';
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function update($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->Msubject->update();
			redirect('file');
		} else {
			$data['title'] = "Update";
			$data['contents'] = 'subject/edit';
			$data['subject'] = $this->MSubject->getSubject($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function delete(){

	}
}
?>
