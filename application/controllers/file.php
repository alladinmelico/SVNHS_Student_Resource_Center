<?php
class File extends CI_Controller{
    public function __construct(){
        parent::__construct();
		require_once ('vendor\autoload.php');

		if(!isset($_SESSION)){
            session_start();
        }
	}
	function index(){
		$data['title'] = "Files";
		$data['contents'] = 'files/index';
		$data['files'] = $this->MFile->getAllUserFiles();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function show($id){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MFile->delete();
			redirect('file');
		} else{
			$data['title'] = "File";
			$data['contents'] = 'files/show';
			$data['file'] = $this->MFile->getUserFile($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}
	
	function create(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MFile->create();
			$this->MFile->user_file();
			redirect('file');
		} else{
			$data['title'] = "Upload Document";
			$data['contents'] = 'files/create';
	
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function update($id=0)
	{
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MFile->update();
			redirect('file');
		} else {
			$data['title'] = "Upload Document";
			$data['contents'] = 'files/edit';
			$data['file'] = $this->MFile->getFile($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function delete(){

	}

	function google_upload(){
		$client = new Google_Client();
		// Get your credentials from the console
		$client->setClientId('293153048084-oh88r7c3hf34sp3q3vlkbb43p8m4j7tn.apps.googleusercontent.com');
		$client->setClientSecret('i8BQhnYUPYmyGDd6Xf2GM91D');
		$client->setRedirectUri('http://svnhs-is.edu/');
		$client->setScopes(array('https://www.googleapis.com/auth/drive.file'));
	
		if(!isset($_SESSION)){
			session_start();
		}
		if (isset($_GET['code']) || (isset($_SESSION['access_token']) && $_SESSION['access_token'])) {
			if (isset($_GET['code'])) {
				$client->authenticate($_GET['code']);
				$_SESSION['access_token'] = $client->getAccessToken();
			} else
				$client->setAccessToken($_SESSION['access_token']);

			$service = new Google_Service_Drive($client);

			//Insert a file
			$file = new Google_Service_Drive_DriveFile();
			$file->setName('logo.jpg');
			$file->setDescription('A test document');
			$file->setMimeType('image/jpeg');

			$data = file_get_contents(base_url().'logo.jpg',true);

			$createdFile = $service->files->create($file, array(
				'data' => $data,
				'mimeType' => 'image/jpeg',
				'uploadType' => 'multipart'
				));

			print_r($createdFile);

		} else {
			$authUrl = $client->createAuthUrl();
			header('Location: ' . $authUrl);
			exit();
			// echo 'gg';
		}
	}

}
?>
