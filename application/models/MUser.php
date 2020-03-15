<?php
class MUser extends CI_Model{
    public function __construct(){
		  parent::__construct();
		  if(!isset($_SESSION)){
            session_start();
		}
  }


  function verify(){
	$this->db->select('idUser,username,isAdmin');
	$this->db->where('username',$_POST['username']);
	$this->db->where('password',hash('md5',$_POST['password']));
	$this->db->limit(1);
	$Q = $this->db->get('Users');
	if ($Q->num_rows() > 0){
		$row = $Q->row_array();
		
		$newData = array(
			'idUser' => $row['idUser'],
			'username' => $row['username']
		);

		$this->session->set_userdata($newData);

		if($row['isAdmin']==1){
			$_SESSION['isAdmin'] = true;
			redirect('/');
		} else {
			(redirect('user/'));
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
}
?>
