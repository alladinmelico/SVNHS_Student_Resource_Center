<?php
class Teacher extends CI_Controller{
    public function __construct(){
        parent::__construct();
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$this->session->has_userdata('idTeacher')){
			redirect('login');
		}
		require_once ('vendor\autoload.php');
	}

	function index(){
		$data['title'] = "Teacher Resource Center";
		$data['contents'] = 'teacher/index';
		$data['requests'] = $this->MTeacher->getRequest();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function confirmUser(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MTeacher->confirm();
			redirect('teacher');
		}
		
	}

	function logout(){
		$this->session->unset_userdata('idUser');
		$this->session->unset_userdata('idTeacher');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');
		unset($_SESSION['idAdmin']);
		redirect('');
	}

	function check($id=0,$user=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MActivity->updateScore();
			redirect('activity/unchecked');
		}
		$data['title'] = "Check Activity";
		$data['contents'] = 'activity/check';
		$data['file'] = $this->MFile->getUserFile($id,$user);
		$data['activity'] = $this->MActivity->getActivity($id);
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function hasStudent($id){
		$Q = $this->db->get_where('class_user',array('classes_idClass'=>$id));
		if($Q->num_rows() > 0){
			return TRUE;
		} else return FALSE;
	}

	
}
?>
