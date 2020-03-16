<?php

	if(isset($error)){
		print_r($error);
	}
	echo form_open('classes/create');

	$option = array();

	$option['choose'] = 'Choose...';
	foreach($subjects as $subject){
		$option[$subject['idSubject']] = ucfirst($subject['subject_name']);
	}
	echo form_label('Subject');
	echo form_dropdown('subjects_idSubject',$option,'choose',array('class'=>'form-control'));
	
	$data = array('name'=>'class_title',
		'type' => 'text',
		'id'=>'class_title',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Title');
	echo form_input($data);

	$data = array('name'=>'class_description',
		'type' => 'text',
		'id'=>'class_description',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Description');
	echo form_input($data);

	$data = array('name'=>'class_code',
		'type' => 'text',
		'id'=>'class_code',
		'class'=>'form-control',
		'value'=> random_string('alnum', 8),
		'required'=>'required',
		'readonly'=>'readonly');
	echo form_label('Code');
	echo form_input($data);

	echo form_hidden('teachers_idTeacher',$this->session->userdata('idTeacher'));
	
	$data = array('name'=>'',
					'type' => 'submit',
					'value'=>'Upload',
					'class'=>'btn btn-success mt-5');
	echo form_submit($data);
	echo form_close();
?>
