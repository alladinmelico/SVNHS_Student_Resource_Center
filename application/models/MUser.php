<?php
class MUser extends CI_Model{
    public function __construct(){
		  parent::__construct();
		  
		  if(!isset($_SESSION)){
            session_start();
		}
  }


  function verify(){
	if($_POST['role']=='student'){
		$this->db->select('idUser,username,first_name,last_name');
		$this->db->where('username',$_POST['username']);
		$this->db->where('password',hash('md5',$_POST['password']));
		$this->db->limit(1);
		$Q = $this->db->get('Users');
	} elseif($_POST['role']=='teacher'){
		$this->db->select('idTeacher,username,first_name,last_name');
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
			if($row['isAdmin']==1){
				$_SESSION['isAdmin'] = true;
				redirect('admin');
			} else {
				redirect('teacher');
			}
		} elseif(isset($row['idUser'])){
			$this->session->set_userdata('idUser',$row['idUser']);
			if($row['isAdmin']==1){
				$_SESSION['isAdmin'] = true;
				redirect('admin');
			} else {
				redirect('user');
			}
		}
	}else{
		redirect('login');
	}
  }

  function verifyEmailAddress($code){
	  $this->db->where('user_verification_code','59d19e15a3f258105e01b3358b4aea9c42d7410ab783ed5e5c591e3ef7a2a255');
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
		$this->email->set_mailtype("text");
		$this->email->set_newline("\r\n");

		$this->email->set_newline("\r\n");
		$this->email->to($email);
		$this->email->from('sresourceinformation@gmail.com');
		$this->email->subject('Email Verification');
		$this->email->message('Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\nhttp://svnhs-is.edu/guest/verify/'.$verificationText."\n"."\n\nThanks\nAdmin");

		if($this->email->send()){
			$this->session->set_flashdata('emailSend',TRUE);
			redirect('guest/verificationSent');
		} else{
			show_error($this->email->print_debugger());
		}
	}

}
?>
