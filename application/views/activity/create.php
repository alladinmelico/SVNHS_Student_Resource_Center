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

	if($this->uri->segment(2)){
		echo form_hidden('classes_idClass',$this->uri->segment(2));
	} else{
		$option = array();
		$option[''] = '';
		foreach($classes as $class){
			$option[$class['idClass']] = $class['class_title'];
		}

		$data = array('name'=>'classes_idClass',
				'id'=>'classes_idClass',
				'class'=>'form-control',
				'required'=>'required');
		echo form_label('Class');
		echo form_dropdown('classes_idClass',$option,'',$data);
	}
	
	
?>
