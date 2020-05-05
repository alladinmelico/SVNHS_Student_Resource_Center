

	<?php

		if(isset($error)){
			print_r($error);
		}
		echo form_open_multipart('file/create');

		$data = array('name'=>'file',
			'required'=>'required');
		echo form_label('Upload');
		echo form_upload($data);

		$data = array('name'=>'description',
			'type' => 'text',
			'id'=>'description',
			'required'=>'required');
		echo form_label('Description');
		echo form_input($data);

	?>
	<button name="submit" class="button" type="submit">SAVE</button>
	<?=form_close();?>
</div>
