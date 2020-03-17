<?php 
class MActivity extends CI_Model{
    public function __construct(){
		  parent::__construct();
  	}

  function create(){
	$data= array(
		'activity_description' => $_POST['activity_description'],
		'activity_title' => $_POST['activity_title'],
		'classes_idClass' => $_POST['classes_idClass'],
		'total_items' => $_POST['total_items']
	);

	$this->db->insert('activities',$data);
		
	}
  

  function update(){
	$data= array(
		'activity_name' => $_POST['activity_name']
	);

	$this->db->where('idActivity',$_POST['idActivity']);
	$this->db->update('activities',$data);
  }

  function delete(){
	  $this->db->delete('activities',array(
		  'idActivity' => $_POST['idActivity']
	  ));
  }

  function getAllActivities(){
	$data = array();
	$this->db->order_by('activity_name','ASC');
	$Q = $this->db->get('activities');

	if ($Q->num_rows() > 0){
		foreach($Q->result_array() as $row){
			$data[] = $row;
		}
	}

	$Q->free_result();
	return $data;
	}

	function getAllTeacherActivities(){
		$data = array();
		$this->db->from('classes c');
		$this->db->join('activities a','c.idClass = a.classes_idClass');
		$this->db->where('c.teachers_idTeacher',$this->session->userdata('idTeacher'));
		$this->db->order_by('a.activity_title','ASC');
		$Q = $this->db->get();

		if ($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function getTotalTeacherActivities(){
		$data = null;
		$this->db->from('classes c');
		$this->db->join('class_user cu','cu.classes_idClass = c.idClass');
		$this->db->join('users u','cu.users_idUser = u.idUser');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		$data = $this->db->count_all_results();
		
		return $data;
		
	}

	function getTotalUserActivities(){
		$data = null;
		$this->db->from('classes c');
		$this->db->join('activities a','c.idClass = a.classes_idClass');
		$this->db->where('c.teachers_idTeacher',$this->session->userdata('idTeacher'));
		$data = $this->db->count_all_results();
		
		return $data;
		
	}

	function getTeacherActivity($id){
		$data = array();
		$Q = $this->db->get_where('activities',array('idActivity' => $id),1);

		if($Q->num_rows() > 0){
			$data = $Q -> row_array();
		}

		$Q->free_result();
		return $data;
	}

	function getUserActivities($id){
		$data = array();
		$this->db->from('activities a');
		$this->db->join('activity_user au','a.idActivity = au.activities_idActivity');
		$this->db->join('users u','u.idUser = au.users_idUser');
		$this->db->join('files f','f.activities_idActivity = a.idActivity');
		$this->db->where('a.idActivity',$id);
		$this->db->order_by('u.last_name','ASC');
		$Q = $this->db->get();

		if ($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function getUserActivity($id){
		$data = array();
		$this->db->from('activities a');
		$this->db->join('activity_user au','a.idActivity = au.activities_idActivity');
		$this->db->join('users u','u.idUser = au.users_idUser');
		$this->db->where('a.idActivity',$id);
		$this->db->where('u.idUser',$this->session->userdata('idUser'));

		$Q = $this->db->get();

		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}

		$Q->free_result();
		return $data;
	}

	function getActivity($id){
		$data = array();
		$this->db->where('idActivity',$id);
		$Q = $this->db->get('activities');

		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}

		$Q->free_result();
		return $data;
	}

	function addActivityUser(){
		$data = array(
			'users_idUser' => $this->session->userdata('idUser'),
			'activities_idActivity' => $_POST['activities_idActivity']
		);


		$this->db->insert('activity_user', $data);
		
	}
}
?>
