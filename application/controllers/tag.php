<?php
class Tag extends CI_Controller{
    public function __construct(){
        parent::__construct();
		require_once ('vendor\autoload.php');

		if(!isset($_SESSION)){
            session_start();
        }
	}
	
	function index(){
		$data['title'] = "Tags";
		$data['contents'] = 'tag/index';
		$data['tags'] = $this->Mtag->getAllTeacherTags();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function show($id){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			redirect('tag');
		} else{
			$data['title'] = "tag";
			$data['contents'] = 'tag/show';
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function create(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MTag->create();
			redirect('tag');
		} else{
			$data['title'] = "Create tag";
			$data['contents'] = 'tag/create';
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function update($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MTag->update();
			redirect('file');
		} else {
			$data['title'] = "Update";
			$data['contents'] = 'tag/edit';
			$data['tag'] = $this->MTag->getTag($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function delete(){

	}
}
?>
