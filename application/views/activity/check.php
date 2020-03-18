<div class="container mt-5">
	<div class="row">
		<div class="col py-3 px-3 border border-info rounded-lg shadow">
			<h1><?=$activity['activity_title']?></h1>
			<p><?=$activity['activity_description']?></p>
		</div>
	</div>
	<div class="row">
		<div class="col py-5">
			<?php
				if($file){
					$this->load->view('files/show');
				}
			?>
		</div>
	</div>
</div>
