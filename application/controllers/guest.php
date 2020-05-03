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

	function sample($id=0){
		$file = array();
		$handle = fopen("diabetes.csv", "r");
		for ($i = 0; $row = fgetcsv($handle ); ++$i) {
			$selected = array();
			$selected['age'] = $row[7];
			$selected['plasma_glucose']=$row[1];
			$file[] = $selected;
		}
		fclose($handle);
		array_shift($file);

		$file = array();
		$handle = fopen("diabetes.csv", "r");
		for ($i = 0; $row = fgetcsv($handle ); ++$i) {
			$file[] = $row;
		}
		fclose($handle);
		print_r($file);

		// usort($file, function($a, $b) {
		// 	return strtotime($a['date'])  - strtotime($b['date']);
		// });

		usort($file, function($a, $b) {
			return ($a['age'])  - ($b['age']);
		});

		array_unique(array_column($file,'age'));

		$data = array(
			array('sentiment'=>1,'score'=>39),
			array('sentiment'=>2,'score'=>44),
			array('sentiment'=>3,'score'=>40),
			array('sentiment'=>4,'score'=>45),
			array('sentiment'=>5,'score'=>38),
			array('sentiment'=>6,'score'=>43),
			array('sentiment'=>7,'score'=>39)
		);

		$toForcast = array(57,66,88);
		
		$this->load->library('Analytics');
		$data['reg'] = $this->analytics->regression($file,'age','plasma_glucose');

		// $data['expo'] = ($this->analytics->exponential_smoothing($file,'date','close',0.2));
		$data['alpha'] = 0.2;
		$data['contents'] = 'regression';
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function scrape(){
		$mainSite = "https://commons.deped.gov.ph";
		$categories = array(
			'humss' => 'b7788512-f928-47e9-9a29-8f887b9a54b4',

		);
		$this->load->library('simple_html_dom');
		$cURL = curl_init('https://commons.deped.gov.ph/categories/'.$categories['humss']);
		curl_setopt($cURL, CURLOPT_RETURNTRANSFER, TRUE);
		$page = curl_exec($cURL);

		if(curl_errno($cURL)){
			echo "<script>alert('Scrapper Erro: ".curl_error($cURL)."')</script>";
			exit;
		}

		// echo $page;

		$this->simple_html_dom->load($page);

		$titles = array();
		$links = array();
		$cards = array();
		foreach($this->simple_html_dom->find('h4') as $title){
			$text = $title->innertext;
			
			$titles[] = trim(explode("<",$text)[0]);
		}

		foreach($this->simple_html_dom->find('a[href^=/documents]') as $link){
			$links[] = $mainSite.$link->href;
		}

		print_r($titles);
		print_r($links);
	}
	
}

?>
