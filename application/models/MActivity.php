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

  function getFile($id){
	$data = array();
	$Q = $this->db->get_where('activities',array('idActivity' => $id),1);

	if($Q->num_rows() > 0){
		$data = $Q -> row_array();
	}

	$Q->free_result();
	return $data;
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

	
}
?>
