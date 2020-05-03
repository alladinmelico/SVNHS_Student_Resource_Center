<?php 
class MFile extends CI_Model{
	private $subscription_key;
	private $endpoint;
    public function __construct(){
		  parent::__construct();
		  $this->config->load('api_config');
		  $this->load->helper('file');
		  $this->subscription_key = $this->config->item('azure_subscription_key');
		  $this->endpoint = $this->config->item('azure_endpoint');
	  }

	function search(){
		$data = array();
		
		$this->db->from('files');
		$this->db->group_start();
		$this->db->like('title',$_GET['term']);
		$this->db->or_like('file_description',$_GET['term']);
		$this->db->or_like('key_phrase',$_GET['term']);
		$this->db->group_end();
		$this->db->where('isPublic',1);
		$Q = $this->db->get();

		if ($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
		
	}

	function getAllFiles(){
		$data = array();
		
		$this->db->from('files f');
		$this->db->join('activity_user au', 'f.idFile = au.files_idFile');
		$this->db->join('activities a', 'a.idActivity = au.activities_idActivity');
		$this->db->join('classes c', 'c.idClass = a.classes_idClass');
		$this->db->where('f.isPublic',1);
		$this->db->order_by('f.file_timestamp','DESC');
		$this->db->limit(5);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

	function getAllFilesDetails(){
		$data = array();
		
		$this->db->from('files f');
		$this->db->join('activity_user au', 'f.idFile = au.files_idFile');
		$this->db->join('activities a', 'a.idActivity = au.activities_idActivity');
		$this->db->join('classes c', 'c.idClass = a.classes_idClass');
		$this->db->order_by('f.file_timestamp','DESC');
		$this->db->limit(5);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$data[] = $row;
			}
		}

		$Q->free_result();
		return $data;
	}

 	function create(){
	$data= array(
		'file_description' => $_POST['description'],
		'title' => $_POST['title']
	);

	$config['file_name'] = time().$_FILES["file"]['name'];
	$config['upload_path'] = './files/';
	$config['allowed_types'] = 'pdf|doc|docx';
	$config['max_size'] = '20000';
	$config['remove_spaces'] = true;
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

			$text = $this->getTextFile("files/".$file['file_name']);

			$data['language'] =$this-> DetectLanguage ($this->endpoint, '/text/analytics/v2.1/languages', $this->subscription_key, 
			array (
				'documents' => array (
					array ( 'id' => '1', 'text' => $text )
				)
			));

			$data['sentiment'] = $this->GetSentiment($this->endpoint, '/text/analytics/v2.1/sentiment', $this->subscription_key, 
			array (
				'documents' => array (
					array ( 'id' => '1', 'language' => 'en', 'text' => $text ))
			));

			$data['key_phrase'] = $this->GetKeyPhrases($this->endpoint, '/text/analytics/v2.1/keyPhrases', $this->subscription_key, 
			array (
				'documents' => array (
					array ( 'id' => '1', 'language' => 'en', 'text' => $text )
				)
			));

			$data['entity'] =  $this->GetEntities($this->endpoint, '/text/analytics/v2.1/entities', $this->subscription_key, 
			array (
				'documents' => array (
					array ( 'id' => '1', 'language' => 'en', 'text' => $text),
				)
			));

			$this->db->insert('files',$data);
		}

	}
  }

  function update(){
	$data= array(
		'title' => $_POST['title'],
		'file_description' => $_POST['file_description']
	);

	if(isset($_FILES['file']['name']) && !empty($_FILES['file']['tmp_name'])){
		$config['file_name'] = time().$_FILES["file"]['name'];
		$config['upload_path'] = './files/';
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['max_size'] = '20000';
		$config['remove_spaces'] = true;
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
				$text = $this->getTextFile("files/".$file['file_name']);

				$data['language'] =$this-> DetectLanguage ($this->endpoint, '/text/analytics/v2.1/languages', $this->subscription_key, 
				array (
					'documents' => array (
						array ( 'id' => '1', 'text' => $text )
					)
				));

				$data['sentiment'] = $this->GetSentiment($this->endpoint, '/text/analytics/v2.1/sentiment', $this->subscription_key, 
				array (
					'documents' => array (
						array ( 'id' => '1', 'language' => 'en', 'text' => $text ))
				));

				$data['key_phrase'] = $this->GetKeyPhrases($this->endpoint, '/text/analytics/v2.1/keyPhrases', $this->subscription_key, 
				array (
					'documents' => array (
						array ( 'id' => '1', 'language' => 'en', 'text' => $text )
					)
				));

				$data['entity'] =  $this->GetEntities($this->endpoint, '/text/analytics/v2.1/entities', $this->subscription_key, 
				array (
					'documents' => array (
						array ( 'id' => '1', 'language' => 'en', 'text' => $text),
					)
				));
			}
		}
	} else{
		$data['source'] = $_POST['oldFile'];
	}

	$this->db->where('idFile',$_POST['idFile']);
	$this->db->update('files',$data);
  }

  function delete(){
	  if(unlink($_POST['source'])){
		  $this->db->delete('files',array(
			  'idFile' => $_POST['idFile']
		  ));
	  }
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
	$Q = $this->db->get_where('files',array('idFile' => $id),1);

	if($Q->num_rows() > 0){
		$data = $Q -> row_array();
	}

	$Q->free_result();
	return $data;
  }

  function getAllUserFiles(){
	$data = array();
	$this->db->select('*');
	$this->db->from('users u');
	$this->db->join('activity_user au','u.idUser = au.users_idUser');
	$this->db->join('activities a','a.idActivity = au.activities_idActivity');
	$this->db->join('files f','f.idFile = a.files_idFile');

	$Q = $this->db->get();

	if ($Q->num_rows() > 0){
		foreach($Q->result_array() as $row){
			$data[] = $row;
		}
	}

	$Q->free_result();
	return $data;
	}

  function getUserFile($id,$user=0){
	if($user == 0){
		$user =$this->session->userdata('idUser');
	}
	$data = array();
	$this->db->from('activities a');
	$this->db->join('activity_user au','au.activities_idActivity = a.idActivity');
	$this->db->join('users u','au.users_idUser = u.idUser');
	$this->db->join('files f','f.idFile = au.files_idFile');
	$this->db->where('u.idUser',$user);
	$this->db->where('au.activities_idActivity',$id);
	$Q = $this->db->get();

	if ($Q->num_rows() > 0){
		$data = $Q -> row_array();
	}

	$Q->free_result();
	return $data;
	}
	
	function getSearchedFile($id){
		$data = array();
		$this->db->from('activity_user au');
		$this->db->join('files f','f.idFile = au.files_idFile');
		$this->db->where('au.files_idFile',$id);
		$Q = $this->db->get();

		if ($Q->num_rows() > 0){
			$data = $Q -> row_array();
		}

		$Q->free_result();
		return $data;
	}

  function DetectLanguage ($host, $path, $key, $data) {

	$headers = "Content-type: text/json\r\n" .
		"Ocp-Apim-Subscription-Key: $key\r\n";

	$data = json_encode ($data);

	$options = array (
		'http' => array (
			'header' => $headers,
			'method' => 'POST',
			'content' => $data
		)
	);
	$context  = stream_context_create ($options);
	$result = file_get_contents ($host . $path, false, $context);
	return $result;
	}

	function getTextFile($file){
		$parser = new \Smalot\PdfParser\Parser();
		$pdf    = $parser->parseFile(base_url().$file);
	
		$text = substr($pdf->getText(),0,5100) ;
		$details  = $pdf->getDetails();
		$pdfDetails = array();
		foreach ($details as $property => $value) {
			if (is_array($value)) {
				$value = implode(', ', $value);
			}
			$pdfDetails[$property] = $value;
		}

		return $text;
	}

	function GetSentiment ($host, $path, $key, $data) {
		foreach ($data as &$item) {
			foreach ($item as $ignore => &$value) {
				$value['text'] = utf8_encode($value['text']);
			}
		}

		$data = json_encode ($data);

		$headers = "Content-type: text/json\r\n" .
			"Content-Length: " . strlen($data) . "\r\n" .
			"Ocp-Apim-Subscription-Key: $key\r\n";

		$options = array (
			'http' => array (
				'header' => $headers,
				'method' => 'POST',
				'content' => $data
			)
		);
		$context  = stream_context_create ($options);
		$result = file_get_contents ($host . $path, false, $context);
		return $result;
	}

	function GetKeyPhrases ($host, $path, $key, $data) {

		$headers = "Content-type: text/json\r\n" .
			"Ocp-Apim-Subscription-Key: $key\r\n";

		$data = json_encode ($data);
		$options = array (
			'http' => array (
				'header' => $headers,
				'method' => 'POST',
				'content' => $data
			)
		);
		$context  = stream_context_create ($options);
		$result = file_get_contents ($host . $path, false, $context);
		return $result;
	}

	function GetEntities ($host, $path, $key, $data) {

		$headers = "Content-type: text/json\r\n" .
			// "Content-Length: " . count($data,COUNT_NORMAL) . "\r\n" .
			"Ocp-Apim-Subscription-Key: $key\r\n";
		$data = json_encode ($data);
		$options = array (
			'http' => array (
				'header' => $headers,
				'method' => 'POST',
				'content' => $data
			)
		);
		$context  = stream_context_create ($options);
		$result = file_get_contents ($host . $path, false, $context);
		return $result;
	}
	
	function getFileLanguage($json){
		$languageJson = json_decode($json,true);
		foreach($languageJson as $value){
			foreach($value as $data){
				foreach(array_values($data['detectedLanguages']) as $language){
					return ($language['name']);
				}
			}
		}
	}

	function getFileSentiment($json){
		$languageJson = json_decode($json,true);
		foreach($languageJson as $value){
			foreach($value as $data){
				return $data['score'];
			}
		}
	}

	function getFileKeyPhrases($json){
		$languageJson = json_decode($json,true);
		foreach($languageJson as $value){
			foreach($value as $data){
				return $data['keyPhrases'];
			}
		}
	}

	function getFileEntity($json){
		$languageJson = json_decode($json,true);
		// return $languageJson;
		foreach($languageJson as $value){
			foreach($value as $data){
				return $data['entities'];
			}
		}
	}

	function updateIsPublic(){
		$isPublic = ($_POST['isPublic'] == 'on')? '1':'0';
		$this->db->set('isPublic',$isPublic);
		$this->db->where('idFile',$_POST['idFile']);
		$this->db->update('files');
	}

	function activate(){
		$this->db->where('idFile',$_POST['id']);
		$this->db->update('files',array('isPublic'=>1));
	}

	function deactivate(){
		$this->db->where('idFile',$_POST['id']);
		$this->db->update('files',array('isPublic'=>0));
	}

	function getAllFilesUploadToday(){
		$data = array();
		
		$this->db->from('files f');
		$this->db->join('activity_user au', 'f.idFile = au.files_idFile');
		$this->db->join('activities a', 'a.idActivity = au.activities_idActivity');
		$this->db->join('classes c', 'c.idClass = a.classes_idClass');
		$this->db->where('DATE(f.file_timestamp) = CURDATE()');
		$this->db->order_by('f.file_timestamp','DESC');
		$this->db->limit(5);
		$Q = $this->db->get();
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
