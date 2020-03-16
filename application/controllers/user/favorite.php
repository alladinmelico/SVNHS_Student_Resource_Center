<?php
class Favorite extends CI_Controller{
    public function __construct(){
        parent::__construct();
		require_once ('vendor\autoload.php');

		if(!isset($_SESSION)){
            session_start();
        }
	}
	
	function index(){
		$data['title'] = "Favorites";
		$data['contents'] = 'favorite/index';
		$data['favorites'] = $this->Mfavorite->getAllTeacherFavorites();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function show($id){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			redirect('favorite');
		} else{
			$data['title'] = "favorite";
			$data['contents'] = 'favorite/show';
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function create(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MFavorite->create();
			redirect('favorite');
		} else{
			$data['title'] = "Create favorite";
			$data['contents'] = 'favorite/create';
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function update($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MFavorite->update();
			redirect('file');
		} else {
			$data['title'] = "Update";
			$data['contents'] = 'favorite/edit';
			$data['favorite'] = $this->MFavorite->getFavorite($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function delete(){

	}
}
?>
