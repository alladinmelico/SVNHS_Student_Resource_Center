<?php
class MUser extends CI_Model{
    public function __construct(){
		  parent::__construct();
		  
		  if(!isset($_SESSION)){
            session_start();
		}
  }

  function getAllUsers(){
	  $data = array();
	  $this->db->where('isAdmin');
	  $Q = $this->db->get('users');
	  if($Q->num_rows() >0){
		  foreach($Q->result_array() as $row){
			  $data[] = $row;
		  }
	  }

	  $Q->free_result();
	  return $data;
  }

  function verify(){
	if($_POST['role']=='student'){
		$this->db->where('username',$_POST['username']);
		$this->db->where('password',hash('md5',$_POST['password']));
		$this->db->limit(1);
		$Q = $this->db->get('Users');
	} elseif($_POST['role']=='teacher'){
		$this->db->where('username',$_POST['username']);
		$this->db->where('password',hash('md5',$_POST['password']));
		$this->db->limit(1);
		$Q = $this->db->get('Teachers');
	}
	
	if ($Q->num_rows() > 0){
		$row = $Q->row_array();
		$this->session->set_userdata('username',$row['username']);
		$this->session->set_userdata('first_name',$row['first_name']);
		$this->session->set_userdata('last_name',$row['last_name']);
		$this->session->set_userdata('email',$row['email']);

		if(isset($row['idTeacher'])){
			$this->session->set_userdata('idTeacher',$row['idTeacher']);
			redirect('teacher');
			
		} elseif(isset($row['idUser'])){
			$this->session->set_userdata('idUser',$row['idUser']);
			print_r($row);
			if($row['isAdmin']==1){
				$this->session->set_userdata('isAdmin',TRUE);
				redirect('admin/dashboard');
			} else {
				redirect('user');
			}
		}
	}else{
		redirect('login');
	}
  }

  function verifyEmailAddress($code){
	  $this->db->where('user_verification_code',$code);
	  $this->db->update('users',array('isActive_User'=>1));
	  return $this->db->affected_rows();
  }

  function create($code){
	  $data = array(
		  'email'=>$_POST['email'],
		  'first_name'=>$_POST['first_name'],
		  'last_name'=>$_POST['last_name'],
		  'username'=>$_POST['username'],
		  'password'=>hash('md5',$_POST['password']),
		  'user_verification_code' => $code
	  );

	if ($_POST['role']=='student'){
		$this->db->insert('users',$data);
	} elseif($_POST['role']=='teacher'){
		$this->db->insert('teachers',$data);
	}

  }

  function addClass(){
	  $data = array(
		  'users_idUser' => $this->session->userdata('idUser'),
		  'classes_idClass' => $_POST['idClass']
	  );

	  $this->db->insert('class_user', $data);
	  
  }

  function usernameCheck($str){
	  
	  $Q = $this->db->get_where('users',array('username'=>$str));
	  $Q2 = $this->db->get_where('teachers',array('username'=>$str));
	  if ($Q->num_rows() > 0 || $Q2->num_rows() > 0){
		  return TRUE;
	  } else return FALSE;
  }

  function passwordCheck(){
	$Q = $this->db->get_where('users',array('username'=>$_POST['username'],'password'=> hash('md5',$_POST['password'])));
	$Q2 = $this->db->get_where('teachers',array('username'=>$_POST['username'],'password'=> hash('md5',$_POST['password'])));
	if ($Q->num_rows() > 0 || $Q2->num_rows() > 0){
		return TRUE;
	} else return FALSE;
  }

  function emailCheck($str){
		$Q = $this->db->get_where('users',array('email'=>$str));
		$Q2 = $this->db->get_where('teachers',array('email'=>$str));

		if ($Q->num_rows() >0 || $Q2->num_rows() > 0){
			return TRUE;
		} else return FALSE;
	}

	function sendVerificationEmail($email,$verificationText){
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

		$this->email->set_newline("\r\n");
		$this->email->to($email);
		$this->email->from('sresourceinformation@gmail.com');
		$this->email->subject('Email Verification');
		$this->email->message('<h1>Dear User,</h1><br><h3>Please click on below URL or paste into your browser to verify your Email Address</h3> <br> http://svnhs-is.edu/guest/verify/'.$verificationText."<br><br>Thanks<br>Admin");

		if($this->email->send()){
			$this->session->set_flashdata('emailSend',TRUE);
			$this->load->view('errors/cli/verify_sent');
		} else{
			show_error($this->email->print_debugger());
		}
	}

	function getAllUsersUnverified(){
		$data = array();

		$Q = $this->db->get_where('users',array('isActive_User'=>0));
		if($Q->num_rows() >0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}
  
		$Q->free_result();
		return $data;
	}

	function activate(){
		$this->db->where('idUser',$_POST['id']);
		$this->db->update('users',array('isActive_User'=>1));
	}

	function deactivate(){
		$this->db->where('idUser',$_POST['id']);
		$this->db->update('users',array('isActive_User'=>0));
	}

}
?>
