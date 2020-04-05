<?php
class Subject extends CI_Controller{
    public function __construct(){
        parent::__construct();
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$this->session->has_userdata('isAdmin')){
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
			if(!$this->MSubject->checkTitle()){
				$this->MSubject->create();
			}
			redirect('admin/dashboard');
		} 
	}

	function update($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MSubject->update();
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
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MSubject->delete();
			redirect('admin/dashboard');
		}
	}
}
?>
