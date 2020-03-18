<?php
class MTeacher extends CI_Model{
    public function __construct(){
		  parent::__construct();
		  if(!isset($_SESSION)){
            session_start();
		}
	}
	
	function confirm(){
		$this->db->where('users_idUser',$_POST['idUser']);
		$this->db->update('class_user',array('confirmed'=>1));
	}

	function getRequest(){
		$data = array();
		$this->db->select('u.first_name,u.last_name,c.class_title,u.idUser');
		$this->db->from('classes c');
		$this->db->join('class_user cu','c.idClass = cu.classes_idClass');
		$this->db->join('users u','u.idUser = cu.users_idUser');
		$this->db->join('teachers t','t.idTeacher = c.teachers_idTeacher');
		$this->db->where('t.idTeacher',$this->session->userdata('idTeacher'));
		$this->db->where('cu.confirmed',0);
		$Q = $this->db->get();

		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		} 

		$Q->free_result();
		return $data;
	}
}
?>
