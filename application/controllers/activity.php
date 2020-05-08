<?php
class Activity extends CI_Controller{
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
		$data['title'] = "Activities";
		$data['contents'] = 'activity/index';
		$data['activities'] = $this->MActivity->getAllTeacherActivities();
		$data['classes'] = $this->MClass->getAllTeacherClasses();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function show($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MActivity->delete();
			redirect('activity');
		} else{
			$data['title'] = "Activity";
			$data['contents'] = 'activity/show';
			$data['activity'] = $this->MActivity->getTeacherActivity($id);
			$data['submitted'] = $this->MActivity->getStudentSubmitted($id);
			$data['files'] = $this->MActivity->getUserActivities($id);
			$data['classes'] = $this->MClass->getAllTeacherClasses();
			$data['unchecks'] = $this->MActivity->getTeacherUnchecked();
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function create(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MActivity->create();
			redirect('activity');
		} else{
			$data['title'] = "Create activity";
			$data['contents'] = 'activity/create';
			$data['classes'] = $this->MClass->getAllTeacherClasses();
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function update($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MActivity->update();
			redirect('activity/'.$_POST['idActivity']);
		} else {
			$data['title'] = "Update";
			$data['contents'] = 'activity/edit';
			$data['activity'] = $this->MActivity->getActivity($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function delete(){

	}

	function unchecked(){
		$data['title'] = "Activities";
		$data['contents'] = 'activity/unchecked';
		$data['unchecks'] = $this->MActivity->getTeacherUnchecked();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}
}
?>
