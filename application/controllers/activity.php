<?php
class Activity extends CI_Controller{
    public function __construct(){
        parent::__construct();
		require_once ('vendor\autoload.php');

		if(!isset($_SESSION)){
            session_start();
        }
	}
	
	function index(){
		$data['title'] = "Activities";
		$data['contents'] = 'activity/index';
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function show($id){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			redirect('activity');
		} else{
			$data['title'] = "activity";
			$data['contents'] = 'activity/show';
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
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function update($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MActivity->update();
			redirect('file');
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
}
?>
