<style>
small{
    color: rgb(156, 156, 156);
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 15px;
    border-radius: 5px;
    background: rgb(1, 61, 66);
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: rgb(2, 222, 230);
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: rgb(2, 222, 230);
    cursor: pointer;
}

</style>

<div class="container mt-5">
	<div class="row">
		<div class="col py-3 px-3 border border-info rounded-lg shadow">
			<h1><?=$activity['activity_title']?></h1>
			<p><?=$activity['activity_description']?></p>
			<?php
				echo form_open('teacher/check');

				echo form_hidden('activities_idActivity',$this->uri->segment(3));
				echo form_hidden('users_idUser',$this->uri->segment(4));  
			?>
				<div class="container px-5">
					<label for="score" class="h3 text-info">Score</label>
					<span id="score_value" class="text-warning font-weight-bold h5 float-right display-4"><?=$file['score']?></span>
				</div>
				<div class="slidecontainer bg-transparent mb-3 px-5">
					<input name="score" type="range" min="1" max="<?=$activity['total_items']?>" value="<?=$file['score']?>" step="0.1" class="slider" 
					id="score" onchange="show_value(this.value,'score_value');overAll()">
				</div>
			<div class="row justify-content-center ">
				<button name="submit" type="submit" class="btn btn-info mr-5 ml-auto">SAVE</button>

				<?=form_close();?>
				
			</div>
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

<script>
    function show_value(val, id) {
        document.getElementById(id).innerHTML=val;
    }

    function overAll(){
        var score = Number(document.getElementById('score_value').innerHTML);
    }
</script>
