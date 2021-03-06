<?php 
class MSubject extends CI_Model{
    public function __construct(){
		  parent::__construct();
  	}

  function create(){
	$data= array(
		'subject_name' => strtolower($_POST['subject_name'])
	);

	$this->db->insert('subjects',$data);
		
	}
  

  function update(){
	$data= array(
		'subject_name' => $_POST['subject_name']
	);

	$this->db->where('idSubject',$_POST['idSubject']);
	$this->db->update('subjects',$data);
  }

  function delete(){
	  $this->db->delete('subjects',array(
		  'idSubject' => $_POST['idSubject']
	  ));
  }

  function getSubject($id){
	$data = array();
	$Q = $this->db->get_where('subjects',array('idSubject' => $id),1);

	if($Q->num_rows() > 0){
		$data = $Q -> row_array();
	}

	$Q->free_result();
	return $data;
  }

  function checkTitle(){
	$this->db->like('subject_name',strtolower($_POST['subject_title']),'none');
	// $this->db->like('subject_name',strtolower($_POST['subject_title']),'after');
	$Q = $this->db->get('subjects',1);
	if($Q->num_rows() > 0){
		return TRUE;
	} else return FALSE;
  }

  function getAllSubjects(){
	$data = array();
	$this->db->order_by('subject_name','ASC');
	$Q = $this->db->get('subjects');

	if ($Q->num_rows() > 0){
		foreach($Q->result_array() as $row){
			$data[] = $row;
		}
	}

	$Q->free_result();
	return $data;
	}

	function activate(){
		$this->db->where('idSubject',$_POST['id']);
		$this->db->update('subjects',array('isActive_Subject'=>1));
	}

	function deactivate(){
		$this->db->where('idSubject',$_POST['id']);
		$this->db->update('subjects',array('isActive_Subject'=>0));
	}
}
?>
