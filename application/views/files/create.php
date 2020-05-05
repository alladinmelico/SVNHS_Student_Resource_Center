<?php

	if(isset($error)){
		print_r($error);
	}
	 echo form_open_multipart('file/create',array('class'=>'form'));

	$data = array('name'=>'file',
		'required'=>'required');
	echo form_label('Upload');
	echo form_upload($data);

	$data = array('name'=>'title',
		'type' => 'text',
		'id'=>'title',
		'required'=>'required');
	echo form_label('Title');
	echo form_input($data);

	$data = array('name'=>'description',
		'type' => 'text',
		'id'=>'description',
		'required'=>'required');
	echo form_label('Description');
	echo form_textarea($data);

	echo form_hidden('activities_idActivity', $this->uri->segment(3));
	
?>
<button name="submit" class="button" type="submit">SAVE</button>

<?=form_close();?>
