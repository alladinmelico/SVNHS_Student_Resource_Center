<?php 
class MFile extends CI_Model{
    public function __construct(){
		  parent::__construct();
		  
  }

  function create(){
	$data= array(
		'description' => $_POST['description'],
		'title' => $_POST['title']
	);

	$config['upload_path'] = './files/';
	$config['allowed_types'] = 'pdf|doc|docx';
	$config['max_size'] = '20000';
	$config['remove_spaces'] = false;
	$config['overwrite'] = false;
	$config['max_width'] = '0';
	$config['max_height'] = '0';

	$this->load->library('upload',$config);


	if(!$this->upload->do_upload('file')){
		$errors = array('error' => $this->upload->display_errors());
		foreach($errors as $error){
			echo "<p>".$error."</p>";
		}
	} else{

		$file = $this->upload->data();
		if($file['file_name']){
			$data['source'] = "files/".$file['file_name'];
		}

		$this->db->insert('files',$data);
	}
  }

  function update(){
	$data= array(
		'description' => $_POST['description']
	);

	if(isset($_FILES['file']['name']) && !empty($_FILES['file']['tmp_name'])){
		$config['upload_path'] = './files/';
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['max_size'] = '20000';
		$config['remove_spaces'] = false;
		$config['overwrite'] = false;
		$config['max_width'] = '0';
		$config['max_height'] = '0';

		$this->load->library('upload',$config);


		if(!$this->upload->do_upload('file')){
			$errors = array('error' => $this->upload->display_errors());
			foreach($errors as $error){
				echo "<p>".$error."</p>";
			}
		} else{
			$file = $this->upload->data();
			if($file['file_name']){
				$data['source'] = "files/".$file['file_name'];
			}
		}
	} else{
		$data['source'] = $_POST['oldFile'];
	}

	$this->db->where('idFile',$_POST['idFile']);
	$this->db->update('files',$data);
  }

  function delete(){
	  $this->db->delete('files',array(
		  'idFile' => $_POST['idFile']
	  ));
  }

  function user_file(){
	  $data = array(
		  'student_id' => $this->session->userdata('idUser'),
		  'file_id' => $this->db->insert_id()
	  );
	  $this->db->insert('file_student',$data);
  }

  function getFile($id){
	$data = array();
	$actor = array('idFile' => $id);
	$Q = $this->db->get_where('files',$actor,1);

	if($Q->num_rows() > 0){
		$data = $Q -> row_array();
	}

	$Q->free_result();
	return $data;
  }

  function getAllUserFiles(){
	$data = array();
	$this->db->select('*');
	$this->db->from('files f');
	$this->db->join('file_student fs','f.idFile = fs.file_id');
	$Q = $this->db->get();

	if ($Q->num_rows() > 0){
		foreach($Q->result_array() as $row){
			$data[] = $row;
		}
	}

	$Q->free_result();
	return $data;
  }

  function getUserFile($id){
	$data = array();
	$this->db->select('*');
	$this->db->from('files f');
	$this->db->join('file_student fs','f.idFile = fs.file_id');
	$this->db->where('fs.student_id',$this->session->userdata('idUser'));
	$this->db->where('fs.file_id',$id);
	$Q = $this->db->get();

	if ($Q->num_rows() > 0){
		$data = $Q -> row_array();
	}

	$Q->free_result();
	return $data;
  }
}
?>
