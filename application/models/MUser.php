<?php
class MUser extends CI_Model{
    public function __construct(){
          parent::__construct();
  }


  function verify(){
	$this->db->select('idUser,username,roles_id');
	$this->db->where('username',$_POST['username']);
	$this->db->where('password',hash('md5',$_POST['password']));
	$this->db->limit(1);
	$Q = $this->db->get('User');
	if ($Q->num_rows() > 0){
		$row = $Q->row_array();
		
		$newData = array(
			'idUser' => $row['idUser'],
			'username' => $row['username']
		);

		$this->session->set_userdata($newData);

		if($row['roles_id']==1){
			$this->session->set_userdata('isAdmin',true);
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
		  'password'=>hash('md5',$_POST['password']),
		  'roles_id'=>$_POST['roles_id']
	  );

	  $this->db->insert('user',$data);
  }

  function getAllRoles(){
	$data = array();
	$Q = $this->db->get('Roles');

	if ($Q->num_rows() > 0){
		foreach($Q->result_array() as $row){
			$data[] = $row;
		}
	}

	$Q->free_result();
	return $data;
  }
}
?>
