<?php

	if(isset($error)){
		print_r($error);
	}
	 echo form_open_multipart('file/create');

	$data = array('name'=>'file',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Upload');
	echo form_upload($data);

	$data = array('name'=>'title',
		'type' => 'text',
		'id'=>'title',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Title');
	echo form_input($data);

	$data = array('name'=>'description',
		'type' => 'text',
		'id'=>'description',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Description');
	echo form_textarea($data);

	echo form_hidden('activities_idActivity',$this->uri->segment(3));

	$data = array('name'=>'createActor',
					'type' => 'submit',
					'value'=>'Upload',
					'class'=>'btn btn-success mt-5');
	echo form_submit($data);
	echo form_close();
?>
