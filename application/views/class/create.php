<style>
	.radio-custom{
		display: flex;
		flex-direction: column;
		overflow: scroll;
		height: 30vh;
	}
	.radio-item{
		width: 300px;
	}
	.radio-custom input[type="radio"]:checked+label img{
		border: 10px solid green;
		filter: contrast(180%);
	}
	.radio-item img{
		width: 100%;
	}
</style>

<?php

	if(isset($error)){
		print_r($error);
	}
	echo form_open('classes/create',array('class'=>'form'));

	$option = array();

	$option['choose'] = 'Choose...';
	foreach($subjects as $subject){
		$option[$subject['idSubject']] = ucfirst($subject['subject_name']);
	}
	echo form_label('Subject');
	echo form_dropdown('subjects_idSubject',$option,'choose');
	
	$data = array('name'=>'class_title',
		'type' => 'text',
		'id'=>'class_title',
		'required'=>'required');
	echo form_label('Title');
	echo form_input($data);

	$data = array('name'=>'class_description',
		'type' => 'text',
		'id'=>'class_description',
		'required'=>'required');
	echo form_label('Description');
	echo form_input($data);

	$data = array('name'=>'class_code',
		'type' => 'text',
		'id'=>'class_code',
		'value'=> random_string('alnum', 8),
		'required'=>'required',
		'readonly'=>'readonly');
	echo form_label('Code');
	echo form_input($data);

	echo form_hidden('teachers_idTeacher',$this->session->userdata('idTeacher'));

	$map = directory_map('files/covers');
	shuffle($map);
?>

<div class="radio-custom scroll">
	<?php foreach($map as $item){?>
			<input name="cover" value="<?=$item?>" type="radio" id="<?=$item?>">
			<label for="<?=$item?>" class="radio-item"><img src="<?=base_url().'files/covers/'.$item?>"></label>
	<?php } ?>
</div>
