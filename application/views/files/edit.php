<?php

	if(isset($error)){
		print_r($error);
	}
	
	echo form_open_multipart('file/update');

	echo form_hidden('idFile',$file['idFile']);
	echo form_hidden('oldFile',$file['source']);
	echo form_hidden('activities_idActivity', $this->uri->segment(3));
	
	$data = array('name'=>'file',
		'class'=>'form-control mb-3',
		'value'=>$file['source']);
	echo form_label('Upload');
	echo form_upload($data);

	$data = array('name'=>'title',
		'type' => 'text',
		'id'=>'title',
		'class'=>'form-control mb-3',
		'value'=>$file['title'],
		'required'=>'required');
	echo form_label('Title');
	echo form_input($data);

	$data = array('name'=>'file_description',
		'type' => 'text',
		'id'=>'file_description',
		'class'=>'form-control',
		'value'=>$file['file_description'],
		'required'=>'required');
	echo form_label('Description');
	echo form_textarea($data);

?>


