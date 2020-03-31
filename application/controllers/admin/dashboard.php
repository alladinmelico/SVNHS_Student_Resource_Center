<?php
class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$this->session->has_userdata('isAdmin')){
			redirect('access_denied');
		}
	}

	function index(){
		$data['title'] = "Admin";
		$data['contents'] = 'admin/dashboard';
		$data['users'] = $this->MUser->getAllUsers();
		$data['teachers'] = $this->MTeacher->getAllTeachers();
		$data['classes'] = $this->MClass->getAllClassDetails();
		$data['activities'] = $this->MActivity->getAllActivitiesDetails();
		$data['files'] = $this->MFile->getAllFilesDetails();
		$data['fileNum'] = $this->MFile->getAllFilesUploadToday();
		$data['classNum'] = $this->MClass->getFileCounts();
		$data['unverified'] = $this->MUser->getAllUsersUnverified();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function activate(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			print_r($_POST);
			if($_POST['action']=='user'){
				$this->MUser->activate();
			}
			if($_POST['action']=='teacher'){
				$this->MTeacher->activate();
			}
			if($_POST['action']=='activity'){
				$this->MActivity->activate();
			}
			if($_POST['action']=='class'){
				$this->MClass->activate();
			}
			if($_POST['action']=='file'){
				$this->MFile->activate();
			}
			redirect('admin/dashboard');
		}
	}

	function deactivate(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			print_r($_POST);
			if($_POST['action']=='user'){
				$this->MUser->deactivate();
			}
			if($_POST['action']=='teacher'){
				$this->MTeacher->deactivate();
			}
			if($_POST['action']=='activity'){
				$this->MActivity->deactivate();
			}
			if($_POST['action']=='class'){
				$this->MClass->deactivate();
			}
			if($_POST['action']=='file'){
				$this->MFile->deactivate();
			}
			redirect('admin/dashboard');
		}
	}

}
?>
