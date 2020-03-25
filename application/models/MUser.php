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

  function create(){
	  $data = array(
		  'email'=>$_POST['email'],
		  'first_name'=>$_POST['first_name'],
		  'last_name'=>$_POST['last_name'],
		  'username'=>$_POST['username'],
		  'password'=>hash('md5',$_POST['password'])
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

}
?>
