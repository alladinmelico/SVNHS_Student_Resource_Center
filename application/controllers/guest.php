<?php
class Guest extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION)){
			session_start();
		}
		
		$this->load->library('session');
	}

	function index(){
		if($this->session->has_userdata('isAdmin')){
			redirect('admin/dashboard');
		} elseif($this->session->has_userdata('idUser')){
			redirect('user');
		} elseif($this->session->has_userdata('idTeacher')){
			redirect('teacher');
		}
		$data['title'] = "Home";
		$data['contents'] = 'index';
		$data['files'] = $this->MFile->getAllFiles();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	
    function login(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->load->library('form_validation');

			$this->form_validation->set_rules('password', 'password', array(
				'trim','required','callback_password_check'),array('password_check'=>'Username or Password is incorrect, please try again.'));

			if ($this->form_validation->run() == FALSE)
			{
				$data['title'] = "Log in";
				$this->load->vars($data);
				$this->load->view('login');
			} else{
				$this->MUser->verify();
			}
		} else{
			$data['title'] = "Login";
			$this->load->vars($data);
			$this->load->view('Login');
		}
	}
	

    function register(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', array(
				'trim','required','max_length[12]','alpha','callback_username_check'));

			$this->form_validation->set_rules('password', 'Password', array(
				'trim','required','min_length[8]',
					array('password_callable',function($password){
						if(!preg_match("#[0-9]+#",$password)) {
							$this->form_validation->set_message('password_callable', 'Your Password Must Contain At Least 1 Number');
							return FALSE;
						}
						elseif(!preg_match("#[A-Z]+#",$password)) {
							$this->form_validation->set_message('password_callable', 'Your Password Must Contain At Least 1 Capital Letter');
							return FALSE;
						}
						elseif(!preg_match("#[a-z]+#",$password)) {
							$this->form_validation->set_message('password_callable', 'Your Password Must Contain At Least 1 Lowercase Letter');
							return FALSE;
						}
						elseif(!preg_match("#[\W]+#",$password)) {
							$this->form_validation->set_message('password_callable', 'Your Password Must Contain At Least 1 Special Character');
							return FALSE;
						} else return TRUE;
				})));

			$this->form_validation->set_rules('passconf', 'Password Confirmation',  array(
				'trim','required','matches[password]'),array('matches'=>'Passwords did not matched'));

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');

			if ($this->form_validation->run() == FALSE)
			{
				$data['title'] = "Sign Up";
				$this->load->vars($data);
				$this->load->view('register');
			}
			else
			{
				$verificationCode = bin2hex(random_bytes(32));
				echo $verificationCode;
				$this->MUser->create($verificationCode);
				$this->MUser->sendVerificationEmail($_POST['email'],$verificationCode);
				// redirect('login');
			}
		} else{
			$data['title'] = "Sign Up";
			$this->load->vars($data);
			$this->load->view('register');
		}
	}

	function verify($code=NULL){
		if($this->MUser->verifyEmailAddress($code) > 0){
			$this->load->view('errors/cli/verify_success');
		} else{
			$this->load->view('errors/cli/verify_fail');
		}

	}

	function username_check($str){
		if($this->MUser->usernameCheck($str)){
            return FALSE;
		} else return TRUE;
	}

	function password_check(){
		if($this->MUser->passwordCheck()){
			$this->form_validation->set_message('password_check', 'username or password is incorrect, please try again.');
            return TRUE;
		} else return FALSE;
	}

	function email_check($str){
		if(!$this->MUser->emailCheck($str)){
			$this->form_validation->set_message('email_check', 'E-mail '.$str.' has already been used, please try again.');
            return TRUE;
		} else return FALSE;
	}

	function access_denied(){
		$this->output->set_status_header('403');
		$this->load->view('errors/cli/error_403');
	}
	
}

?>
