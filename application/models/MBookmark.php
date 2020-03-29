<?php 
class MBookmark extends CI_Model{
    public function __construct(){
		  parent::__construct();
	  }

	function create(){
		$data = array(
			'users_idUser'=>$this->session->userdata('idUser'),
			'files_idFile'=>$_POST['idFile']
		);

		$this->db->insert('bookmarks',$data);
	}
	
	function delete(){
		$this->db->delete('bookmarks',array(
			'users_idUser'=>$this->session->userdata('idUser'),
			'files_idFile'=>$_POST['idFile']
		));
	}
	
	function getAllUserBookmarks(){
		$data = array();

		$this->db->from('files f');
		$this->db->join('bookmarks b','f.idFile = b.files_idFile');
		$this->db->join('users u','u.idUser = b.users_idUser');
		$this->db->where('f.isPublic',1);
		$this->db->where('b.users_idUser',$this->session->userdata('idUser'));
		$Q = $this->db->get();

		if($Q->num_rows() > 0){
			foreach($Q -> result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}
	function isBookMarked($id){
		$Q = $this->db->get_where('bookmarks',array(
			'users_idUser'=>$this->session->userdata('idUser'),
			'files_idFile'=>$id
		));

		if($Q->num_rows() > 0){
			return TRUE;
		} else return FALSE;
	}

}

?>
