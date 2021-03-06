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
			'teachers_idTeacher	' => $_POST['teachers_idTeacher'],
			'cover'=>$_POST['cover']
		);

		$this->db->insert('classes',$data);
			
	}
  

	function update(){
		$data= array(
			'class_title' => $_POST['class_title'],
			'class_description' => $_POST['class_description'],
			'subjects_idSubject' => $_POST['subjects_idSubject'],
			'class_code' => $_POST['class_code'],
			'teachers_idTeacher	' => $_POST['teachers_idTeacher'],
			'cover'=>$_POST['cover']
		);

		$this->db->where('idClass',$_POST['idClass']);
		$this->db->update('classes',$data);
	}

	function delete(){
		$this->db->where('idClass',$_POST['idClass']);
		$this->db->update('classes',array(
			'isActive_Class' => 0
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
		$this->db->where('isActive_Class',1);
		$Q = $this->db->get('classes');
		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}

	function getAllClassDetails(){
		$data = array();
		$this->db->select('GROUP_CONCAT(a.activity_title) as activity_title,c.idClass,
		c.class_title,c.class_description,t.first_name,t.last_name,c.class_code,c.isActive_Class');
		
		$this->db->from('teachers t');
		$this->db->join('classes c', 'c.teachers_idTeacher = t.idTeacher');
		$this->db->join('activities a', 'a.classes_idClass = c.idClass');
		$this->db->group_by('c.idClass');
		
		$Q = $this->db->get();
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
		$Q = $this->db->get_where('classes',array(
			'teachers_idTeacher'=>$this->session->userdata('idTeacher'),
			'isActive_Class' => 1
		));

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
		$this->db->where('c.isActive_Class',1);
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

	function getClassmates($id){
		$data = array();
		$this->db->select('u.idUser, u.first_name, u.last_name, u.username');
		$this->db->from('classes c');
		$this->db->join('class_user cu','c.idClass = cu.classes_idClass');
		$this->db->join('users u', 'u.idUser = cu.users_idUser');
		$this->db->where('c.idClass',$id);
		$this->db->where('u.idUser !=',$this->session->userdata('idUser'));
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
		$this->db->where('a.isActive_Activity',1);
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
	
	function getTotalTeacherClassName(){
		$data = array();
		$this->db->select('c.class_title');
		$this->db->from('classes c');
		$this->db->join('teachers t','t.idTeacher = c.teachers_idTeacher');
		$this->db->where('c.teachers_idTeacher',$this->session->userdata('idTeacher'));
		$this->db->where('c.isActive_Class',1);
		$Q = $this->db->get();
		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function getTotalUserClass(){
		$data = null;
		$this->db->from('classes c');
		$this->db->join('class_user cu','cu.classes_idClass = c.idClass');
		$this->db->join('users u','cu.users_idUser = u.idUser');
		$this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		$this->db->where('cu.confirmed',1);
		$this->db->where('c.isActive_Class',1);
		$data = $this->db->count_all_results();
		
		return $data;
	}

	function getTotalUserClassName(){
		$data = array();
		$this->db->select('c.class_title');
		$this->db->from('classes c');
		$this->db->join('class_user cu','cu.classes_idClass = c.idClass');
		$this->db->join('users u','cu.users_idUser = u.idUser');
		$this->db->where('cu.users_idUser',$this->session->userdata('idUser'));
		$this->db->where('cu.confirmed',1);
		$this->db->where('c.isActive_Class',1);
		$Q = $this->db->get();
		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
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

	function getClassAverageScores($id){
		$data = array();
		$this->db->select('ABS(AVG(au.score)/a.total_items*100) as avgScore,a.activity_title,au.activity_submitted');
		$this->db->from('classes c');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->join('activity_user au','au.activities_idActivity = a.idActivity');
		$this->db->group_by('a.idActivity');
		$this->db->where('a.classes_idClass',$id);
		$this->db->order_by('a.activity_timestamp','ASC');
		$Q = $this->db->get();

		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function getTopStudents($id){
		$data = array();
		$this->db->select('(AVG(au.score)/a.total_items)*100 as avgScore,AVG(a.total_items) as total_items,u.first_name,au.activity_submitted');
		$this->db->from('classes c');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->join('activity_user au','au.activities_idActivity = a.idActivity');
		$this->db->join('users u','au.users_idUser = u.idUser');
		$this->db->group_by('au.users_idUser');
		$this->db->where('a.classes_idClass',$id);
		$this->db->order_by('avgScore','DESC');
		$Q = $this->db->get();

		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function isRequested(){
		$Q = $this->db->get_where('class_user',array(
			'users_idUser' => $this->session->userdata('idUser'),
			'classes_idClass' => $_POST['idClass']
		));
		if($Q->num_rows()>0){
			return TRUE;
		} else return FALSE;
	}

	function activate(){
		$this->db->where('idClass',$_POST['id']);
		$this->db->update('classes',array('isActive_Class'=>1));
	}

	function deactivate(){
		$this->db->where('idClass',$_POST['id']);
		$this->db->update('classes',array('isActive_Class'=>0));
	}
	
	function getFileCounts(){
		$data = array();
		$this->db->select('c.class_title,COUNT(au.files_idFile) as files');
		$this->db->from('classes c');
		$this->db->join('activities a','a.classes_idClass = c.idClass');
		$this->db->join('activity_user au','au.activities_idActivity = a.idActivity');
		$this->db->group_by('c.idClass');
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
