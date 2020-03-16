<?php

	if(isset($error)){
		print_r($error);
	}
	echo form_open('activity/create');
	
	$data = array('name'=>'activity_title',
		'type' => 'text',
		'id'=>'activity_title',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Title');
	echo form_input($data);

	$data = array('name'=>'activity_description',
		'id'=>'activity_description',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Description');
	echo form_textarea($data);

	$data = array('name'=>'total_items',
		'type' => 'number',
		'id'=>'total_items',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Total Number of Items');
	echo form_input($data);


	echo form_hidden('classes_idClass',$this->uri->segment(2));
	
	
?>
