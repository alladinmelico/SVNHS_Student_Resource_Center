<div class="col py-3 px-3 border border-info rounded-lg shadow">
	<h1><?=$activity['activity_title']?></h1>
	<p><?=$activity['activity_description']?></p>
</div>

<?php
	if($file){
		$this->load->view('files/show');
	}else{
		$this->load->view('files/create'); 
	}
?>
