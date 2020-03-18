<?php

	if(isset($error)){
		print_r($error);
	}
	echo form_open('activity/update');
	
	$data = array('name'=>'activity_title',
		'type' => 'text',
		'id'=>'activity_title',
		'class'=>'form-control',
		'value'=>$activity['activity_title'],
		'required'=>'required');
	echo form_label('Title');
	echo form_input($data);

	$data = array('name'=>'activity_description',
		'id'=>'activity_description',
		'class'=>'form-control',
		'value'=>$activity['activity_description'],
		'required'=>'required');
	echo form_label('Description');
	echo form_textarea($data);

	$data = array('name'=>'total_items',
		'type' => 'number',
		'id'=>'total_items',
		'class'=>'form-control',
		'value'=>$activity['total_items'],
		'required'=>'required');
	echo form_label('Total Number of Items');
	echo form_input($data);

	$data = array('name'=>'activity_DueDate',
		'type' => 'datetime-local',
		'id'=>'activity_DueDate',
		'class'=>'form-control',
		'value'=>$due['due'].'T'.$due['dueTime'],
		'required'=>'required');
	echo form_label('Due Date');
	echo form_input($data);

	$option = array();
	foreach($classes as $class){
		$option[$class['idClass']] = $class['class_title'];
	}

	echo form_hidden('idActivity',$this->uri->segment(2));
	$data = array('name'=>'classes_idClass',
			'id'=>'classes_idClass',
			'class'=>'form-control',
			'value'=>$activity['classes_idClass'],
			'required'=>'required');
	echo form_label('Class');
	echo form_dropdown('classes_idClass',$option,$activity['classes_idClass'],$data);

	
	
?>
