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
		'total_items' => $_POST['total_items'],
		'activity_DueDate' =>$_POST['activity_DueDate']
	);

	$this->db->insert('activities',$data);
		
	}
  

  function update(){
	$data= array(
		'activity_description' => $_POST['activity_description'],
		'activity_title' => $_POST['activity_title'],
		'classes_idClass' => $_POST['classes_idClass'],
		'total_items' => $_POST['total_items'],
		'activity_DueDate' =>$_POST['activity_DueDate']
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
		$this->db->join('teachers t','t.idTeacher = c.teachers_idTeacher');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->where('t.idTeacher',$this->session->userdata('idTeacher'));
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

	function getActivityDueDate($id){
		$this->db->select("DATE_FORMAT(activity_DueDate,'%Y-%m-%d') as due,TIME(activity_DueDate) as dueTime");
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
		$this->db->join('files f','f.idFile = au.files_idFile');
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
			'activities_idActivity' => $_POST['activities_idActivity'],
			'files_idFile'=> $this->db->insert_id()
		);


		$this->db->insert('activity_user', $data);
		
	}

	function getTotalUserToDo(){
		$this->db->from('class_user cu');
		$this->db->join('classes c','cu.classes_idClass = c.idClass');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->join('activity_user au','a.idActivity = au.activities_idActivity','left');
		$this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		$this->db->where('cu.confirmed',1);
		$this->db->where('au.activities_idActivity');
		$data = $this->db->count_all_results();

		return $data;
	}

	function getTotalTeacherUnchecked(){
		$this->db->from('activities a');
		$this->db->join('activity_user au','a.idActivity = au.activities_idActivity');
		$this->db->join('users u','u.idUser = au.users_idUser');
		$this->db->join('classes c','c.idClass = a.classes_idClass');
		$this->db->join('teachers t','t.idTeacher = c.teachers_idTeacher');
		$this->db->where('t.idTeacher',$this->session->userdata('idTeacher'));
		$this->db->where('au.score');
		$data = $this->db->count_all_results();

		return $data;
	}

	function getTeacherUnchecked(){
		$data = array();
		$this->db->select('c.class_title,u.idUser,a.activity_title,a.idActivity,DATE(f.file_timestamp) as dateSubmitted,
		u.last_name,u.first_name,DATEDIFF(a.activity_DueDate,f.file_timestamp) AS dayRemaining,
		HOUR(TIMEDIFF(a.activity_DueDate,f.file_timestamp)) AS timeRemaining, DATE(a.activity_DueDate) as dateDue');
		$this->db->from('activities a');
		$this->db->join('activity_user au','a.idActivity = au.activities_idActivity');
		$this->db->join('users u','u.idUser = au.users_idUser');
		$this->db->join('classes c','c.idClass = a.classes_idClass');
		$this->db->join('teachers t','t.idTeacher = c.teachers_idTeacher');
		$this->db->join('files f','f.idFile = au.files_idFile');
		$this->db->where('t.idTeacher',$this->session->userdata('idTeacher'));
		$this->db->where('au.score');
		$Q = $this->db->get();

		if ($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function getUserToDo(){
		$data = array();
		$this->db->from('class_user cu');
		$this->db->join('classes c','cu.classes_idClass = c.idClass');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->join('activity_user au','a.idActivity = au.activities_idActivity','left');
		$this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		$this->db->where('au.activities_idActivity');
		$Q = $this->db->get();

		if ($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function deleteActivityUser(){
		$this->db->where('users_idUser',$this->session->userdata('idUser'));
		$this->db->where('activities_idActivity',$_POST['idActivity']);
		$this->db->delete('activity_user');
	}

	function getStudentPerformances($id){
		$data = array();
		$this->db->select('((au.score/a.total_items) * 100) as percentage,au.activity_submitted');
		$this->db->from('class_user cu');
		$this->db->join('classes c','cu.classes_idClass = c.idClass');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->join('activity_user au','a.idActivity = au.activities_idActivity');
		$this->db->where('au.users_idUser',$this->session->userdata('idUser'));
		$this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		$this->db->where('c.idClass',$id);
		$this->db->where('cu.confirmed',1);
		$Q = $this->db->get();

		if ($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function updateScore(){
		$data = array(
			'score'=>$_POST['score']
		);

		
		$this->db->where('users_idUser', $_POST['users_idUser']);
		$this->db->where('activities_idActivity', $_POST['activities_idActivity']);
		
		$this->db->update('activity_user', $data);
		
	}

	function getTotalItems($id){
		$data = null;
		// $this->db->select('((au.score/a.total_items) * 100) as percentage,au.activity_submitted');
		// $this->db->from('class_user cu');
		// $this->db->join('classes c','cu.classes_idClass = c.idClass');
		// $this->db->join('activities a','a.classes_idClass = c.idClass');
		// $this->db->join('activity_user au','a.idActivity = au.activities_idActivity');
		// $this->db->where('au.users_idUser',$this->session->userdata('idUser'));
		// $this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		// $this->db->where('c.idClass',$id);
		// $this->db->where('cu.confirmed',1);
		// $data = $this->db->count_all_results();
		
		return $data;
	}
}
?>
