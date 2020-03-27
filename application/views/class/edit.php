<?php

	if(isset($error)){
		print_r($error);
	}
	echo form_open('classes/update');

	$option = array();

	foreach($subjects as $subject){
		$option[$subject['idSubject']] = ucfirst($subject['subject_name']);
	}
	echo form_label('Subject');
	echo form_dropdown('subjects_idSubject',$option,$class['idClass'],array('class'=>'form-control mb-3'));
	
	$data = array('name'=>'class_title',
		'type' => 'text',
		'id'=>'class_title',
		'class'=>'form-control mb-3',
		'value'=> $class['class_title'],
		'required'=>'required');
	echo form_label('Title');
	echo form_input($data);

	$data = array('name'=>'class_description',
		'type' => 'text',
		'id'=>'class_description',
		'class'=>'form-control mb-3',
		'value'=> $class['class_description'],
		'required'=>'required');
	echo form_label('Description');
	echo form_input($data);

	$data = array('name'=>'class_code',
		'type' => 'text',
		'id'=>'class_code',
		'class'=>'form-control mb-5',
		'value'=> $class['class_code'],
		'required'=>'required');
	echo form_label('Code');
	echo form_input($data);

	echo form_hidden('teachers_idTeacher',$this->session->userdata('idTeacher'));
	echo form_hidden('idClass',$class['idClass']);
	$map = directory_map('files/covers');
	shuffle($map);
?>

<div class="container  overflow-auto" style="height: 300px">
	<div class=" container btn-group btn-group-toggle d-flex flex-column " data-toggle="buttons" >
		<?php foreach($map as $item){?>
			<label class="btn btn-light form-check-label text-center <?=($item == $class['cover'])? 'active':''?>">
				<img src="<?=base_url().'files/covers/'.$item?>" alt="" width="320">
				<input name="cover" value="<?=$item?>" class="form-check-input" 
				type="radio" id="option2" autocomplete="off" style="width:100px" required>
			</label>
		<?php } ?>
	</div>
</div>
