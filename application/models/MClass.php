<?php 
class MClass extends CI_Model{
    public function __construct(){
		  parent::__construct();
  	}

	function create(){
		$data= array(
			'class_title' => $_POST['class_title'],
			'class_description' => $_POST['class_description'],
			'subjects_idSubject' => $_POST['subjects_idSubject'],
			'class_code' => $_POST['class_code'],
			'teachers_idTeacher	' => $_POST['teachers_idTeacher']
		);

		$this->db->insert('classes',$data);
			
	}
  

	function update(){
		$data= array(
			'class_name' => $_POST['class_name']
		);

		$this->db->where('idClass',$_POST['idClass']);
		$this->db->update('classes',$data);
	}

	function delete(){
		$this->db->delete('classes',array(
			'idClass' => $_POST['idClass']
		));
	}

  	function getClass($id){
		$data = array();
		$Q = $this->db->get_where('classes',array('idClass' => $id),1);

		if($Q->num_rows() > 0){
			$data = $Q -> row_array();
		}

		$Q->free_result();
		return $data;
	  }
	  
	function getAllClass(){
		$data = array();
		$Q = $this->db->get('classes');
		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}

  	function getAllTeacherClasses(){
		$data = array();
		$Q = $this->db->get_where('classes',array('teachers_idTeacher'=>$this->session->userdata('idTeacher')));

		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}

	function getAllUserClasses(){
		$data = array();
		$this->db->from('classes c');
		$this->db->join('class_user cu','c.idClass = cu.classes_idClass');
		$this->db->join('users u','u.idUser = cu.users_idUser');
		$this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		$this->db->where('cu.confirmed',1);
		$Q = $this->db->get();
	
		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function getClassUsers($id){
		$data = array();
		$this->db->select('u.idUser, u.first_name, u.last_name, u.username');
		$this->db->from('classes c');
		$this->db->join('class_user cu','c.idClass = cu.classes_idClass');
		$this->db->join('users u', 'u.idUser = cu.users_idUser');
		$this->db->where('c.teachers_idTeacher',$this->session->userdata('idTeacher'));
		$this->db->where('c.idClass',$id);
		$Q = $this->db->get();

		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function getClassActivities($id){
		$data = array();

		$this->db->select('a.activity_title,a.activity_description,a.activity_timestamp,a.idActivity');
		$this->db->from('classes c');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->where('c.idClass',$id);
		$Q = $this->db->get();

		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}


	function getClassSubject($id){
		$data = array();

		$this->db->select('s.subject_name');
		$this->db->from('classes c');
		$this->db->join('subjects s','s.idSubject = c.subjects_idSubject');
		$this->db->where('c.idClass',$id);
		$Q = $this->db->get();

		if($Q->num_rows() > 0){
			$data = $Q->row_array();
		} 

		$Q->free_result();
		return $data;
	}

	function getTotalTeacherClass(){
		$data = null;
		$this->db->where('teachers_idTeacher',$this->session->userdata('idTeacher'));
		$this->db->from('classes');
		$data = $this->db->count_all_results();
		
		return $data;
	}

	function getTotalUserClass(){
		$data = null;
		$this->db->from('classes c');
		$this->db->join('class_user cu','cu.classes_idClass = c.idClass');
		$this->db->join('users u','cu.users_idUser = u.idUser');
		$this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		$this->db->where('cu.confirmed',1);
		$data = $this->db->count_all_results();
		
		return $data;
	}

	function getCode($id){
		$data = array();
		$this->db->select('class_code');
		$Q =  $this->db->get_where('classes',array('idClass'=>$id));

		if($Q->num_rows() > 0){
			$data = $Q->row_array();
		} 

		$Q->free_result();
		return $data;
	}

	
}
?>
