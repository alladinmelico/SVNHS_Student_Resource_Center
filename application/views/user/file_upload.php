
<!-- <form action="<?= base_url()?>file/create" enctype="multipart/form-data" method="POST">
	<div class="form-group">
		<label for="">Upload File</label>
		<input type="file" class="form-control-file" name="file" id="file">
		<input type="text" class="form-control" name="description" id="">
		<button type="submit" class="btn btn-primary">Upload</button>
	</div>
</form> -->


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

	$data = array('name'=>'description',
		'type' => 'text',
		'id'=>'description',
		'class'=>'form-control',
		'required'=>'required');
	echo form_label('Description');
	echo form_input($data);

	$data = array('name'=>'',
					'type' => 'submit',
					'value'=>'Upload',
					'class'=>'btn btn-success mt-5');
	echo form_submit($data);
	echo form_close();
?>
