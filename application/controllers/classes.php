<?php
class Classes extends CI_Controller{
    public function __construct(){
        parent::__construct();
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$this->session->has_userdata('idTeacher')){
			redirect('access_denied');
		}
		require_once ('vendor\autoload.php');
	}

	function index(){
		$data['title'] = "Classes";
		$data['contents'] = 'class/index';
		$data['classes'] = $this->MClass->getAllTeacherClasses();
		$data['subjects'] = $this->MSubject->getAllSubjects();
		$this->load->vars($data);
		$this->load->view('layout/template');
	}

	function show($id){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			redirect('class');
		} else{
			$data['title'] = "Class";
			$data['contents'] = 'class/show';
			$data['class'] = $this->MClass->getCLass($id);
			$data['users'] = $this->MClass->getClassUsers($id);
			$data['activities'] = $this->MClass->getClassActivities($id);
			$data['subject'] = $this->MClass->getClassSubject($id);
			$data['scores'] =$this->MClass->getClassAverageScores($id);
			$top =  $this->MClass->getTopStudents($id);
			$data['topStudents'] = $top;
			$data['subjects'] = $this->MSubject->getAllSubjects();
			$scoreSentiment = $this->MActivity->getScoreSentiment($id);

			for($i = 0; $i < (count($scoreSentiment)); $i++){
				$scoreSentiment[$i]['sentiment'] = $this->MFile->getFileSentiment($scoreSentiment[$i]['sentiment']);
			}
			
			$this->load->library('Analytics');
			$alpha = 0.2;
			$toForecast = 0;
			$toForecastReg = null;
			$file = array();
			$fileReg = array();
			$handle = fopen("sample_score.csv", "r");
			for ($i = 0; $row = fgetcsv($handle ); ++$i) {
				$selected = array();
				$selected['score'] = $row[0];
				$selected['date']=$row[1];
				$file[] = $selected;
			}
			fclose($handle);

			$handle = fopen("sample_sentimentScore.csv", "r");
			for ($i = 0; $row = fgetcsv($handle ); ++$i) {
				$selected = array();
				$selected['sentiment'] = $row[0];
				$selected['percentage']=$row[1];
				$fileReg[] = $selected;
			}
			fclose($handle);

			array_shift($file);

			if(isset($_GET['expo_smoothing'])){
				$alpha = $_GET['alpha']; 
				$toForecast = $_GET['toForecast'];
			}
			if(isset($_GET['expo_smoothing'])){
				$toForecastReg = $_GET['toForecastRegression'];
			}

			$data['reg'] = $this->analytics->regression($fileReg,'sentiment','percentage');
			$data['expo'] = ($this->analytics->exponential_smoothing($file,'date','score',$alpha,$toForecast));
			$data['alpha']=$alpha;
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function create(){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MClass->create();
			redirect('classes');
		} else{
			$data['title'] = "Create Class";
			$data['contents'] = 'class/create';
			$data['subjects'] = $this->MSubject->getAllSubjects();
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function update($id=0){
		if($this->input->server('REQUEST_METHOD') =='POST'){
			$this->MClass->update();
			redirect('classes/'.$_POST['idClass']);
		} else {
			$data['title'] = "Update";
			$data['contents'] = 'class/edit';
			$data['class'] = $this->MClass->getClass($id);
			$this->load->vars($data);
			$this->load->view('layout/template');
		}
	}

	function delete(){

	}
}
?>
