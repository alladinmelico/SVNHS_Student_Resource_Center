<?php
class Search extends CI_Controller{
    public function __construct(){
        parent::__construct();
		
		if(!isset($_SESSION)){
			session_start();
		}
		require_once ('vendor\autoload.php');
	}

	function index(){
		if($this->input->server('REQUEST_METHOD') =='GET'){
			if($_GET['term'] != ''){
				if($this->session->has_userdata('idUser') || $this->session->has_userdata('idUser')){
					$this->MUser->saveSearch();
				}
	
				$data['title'] = "Search";
				$data['contents'] = 'search_view';
				$data['searched'] = $this->MFile->search();
				$this->load->vars($data);
				$this->load->view('layout/template');
			} 
		}
	}

	function file($id){
		$data['title'] = "Search";
		$data['contents'] = 'files/show';
		$data['file'] = $this->MFile->getSearchedFile($id);
		$data['isBookMarked'] = $this->MBookmark->isBookMarked($id);
 		$this->load->vars($data);
		$this->load->view('layout/template');
	}
}
?>
