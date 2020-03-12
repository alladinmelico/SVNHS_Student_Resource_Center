<?php

	if(isset($error)){
		print_r($error);
	}
	
	echo form_open_multipart('file/update');

	echo form_hidden('idFile',$file['idFile']);
	echo form_hidden('oldFile',$file['source']);
	
	$data = array('name'=>'file',
		'class'=>'form-control',
		'value'=>$file['source']);
	echo form_label('Upload');
	echo form_upload($data);

	$data = array('name'=>'description',
		'type' => 'text',
		'id'=>'description',
		'class'=>'form-control',
		'value'=>$file['description'],
		'required'=>'required');
	echo form_label('Description');
	echo form_input($data);

	$data = array('name'=>'createActor',
		'type' => 'submit',
		'value'=>'Upload',
		'class'=>'btn btn-success mt-5');
	echo form_submit($data);
	echo form_close();
?>
