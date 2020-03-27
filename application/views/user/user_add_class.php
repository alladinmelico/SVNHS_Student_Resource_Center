<?php

	if(isset($error)){
		print_r($error);
	}
	echo form_open('user/addClass');
	$option = array();

	$option[''] = '';
	foreach($allClass as $class){
		$option[$class['idClass']] = ucfirst($class['class_title']);
	}
	echo form_label('Class');
	echo form_dropdown('idClass',$option,'',array('class'=>'form-control','required'=>'required'));

	$data = array('name'=>'class_code',
		'type' => 'text',
		'id'=>'class_code',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Code');
	echo form_input($data);

	echo form_hidden('code');
	
?>
