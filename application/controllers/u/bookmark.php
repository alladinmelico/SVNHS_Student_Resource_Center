<?php

class Bookmark extends CI_Controller{
    public function __construct(){
        parent::__construct();
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$this->session->has_userdata('idUser')){
			redirect('access_denied');
		}
		require_once ('vendor\autoload.php');
	}
	
	function index(){
		$data['title'] = "bookmarks";
		$data['contents'] = 'user/bookmark';
		$data['bookmarks'] = $this->MBookmark->getAllUserBookmarks();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function create(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MBookmark->create();
			redirect($_POST['redirect']);
		}
	}

	function delete(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MBookmark->delete();
			redirect($_POST['redirect']);
		}
	}
}
?>
