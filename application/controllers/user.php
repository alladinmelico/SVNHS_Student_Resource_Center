<?php
class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION)){
			session_start();
		}
		$this->load->library('session');
		if(!$this->session->has_userdata('idUser')){
			redirect('login');
		}
		require_once ('vendor\autoload.php');
	}
	
	function index(){
		
		$data['title'] = "Student Resource";
		$data['contents'] = 'user/index';
		$data['files'] = $this->MFile->getAllFiles();
		$data['classes'] = $this->MClass->getAllUserClasses();
		$data['allClass'] = $this->MClass->getAllClass();
		$data['performances'] = $this->MActivity->getUserActivitiesPerformance();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}


	function classes(){
		$data['title'] = "Classes";
		$data['contents'] = 'user/user_class';
		$data['classes'] = $this->MClass->getAllUserClasses();
		$data['allClass'] = $this->MClass->getAllClass();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function showUserClass($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			redirect('class');
		} else{
			$data['title'] = "Class";
			$data['contents'] = 'user/show_class';
			$data['class'] = $this->MClass->getCLass($id);
			$data['users'] = $this->MClass->getClassmates($id);
			$data['activities'] = $this->MClass->getClassActivities($id);
			$data['subject'] = $this->MClass->getClassSubject($id);
			$data['performances'] = $this->MActivity->getStudentPerformances($id);
			$data['side_content_1'] = 'user/classmates';
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function addClass(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			if($this->MClass->getCode($_POST['idClass'])['class_code'] != $_POST['class_code']){
				$this->session->set_flashdata('invalidCode',TRUE);
				redirect('user/classes','refresh');
			} else{
				if(!$this->MClass->isRequested()){
					$this->MUser->addClass();
					$this->session->set_flashdata('requested',TRUE);
				} else $this->session->set_flashdata('isRequested',TRUE);

				redirect('user/classes');
			}
		} 
	}

	function activity($id){
		$data['title'] = "Student Activity";
		$data['contents'] = 'user/user_activity';
		$data['file'] = $this->MFile->getUserFile($id);
		$data['activity'] = $this->MActivity->getActivity($id);
		$this->load->vars($data);
		$this->load->view('layout/template');
	}


	function todo(){
		$data['title'] = "Student Activity";
		$data['contents'] = 'user/user_todo';
		$data['todos'] = $this->MActivity->getUserToDo();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function sendEmail(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			//Load email library
			$this->load->library('email');

			//SMTP & mail configuration
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'sresourceinformation@gmail.com',
				'smtp_pass' => 'studentRI2k20',
				'mailtype'  => 'text',
				'charset'   => 'utf-8'
			);
			$this->email->initialize($config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");

			$from = $this->session->userdata('email');
			$to = 'sresourceinformation@gmail.com';
			$subject = $this->input->post('subject');
			$message = $this->input->post('message');

			$this->email->set_newline("\r\n");
			$this->email->to($to);
			$this->email->from($from);
			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send()){
				$this->session->set_flashdata('emailSend',TRUE);
				redirect('user','refresh');
			} else{
				show_error($this->email->print_debugger());
			}
			
		}
	}
	
	function logout(){
		$this->session->unset_userdata('idUser');
		$this->session->unset_userdata('idTeacher');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('first_name');
		$this->session->unset_userdata('last_name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('isAdmin');
		unset($_SESSION['idAdmin']);
		redirect('');
	}
}
?>
