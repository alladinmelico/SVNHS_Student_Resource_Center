
<style>
	.pdfobject-container { height: 80rem; width: 70rem; }
</style>

<div class="container">
	<div class="row">
		<div class="col">
			<div class="row">
				<h3><?=$file['title']?></h3>
				<a href="" class="btn btn-info">Update</a>
				<?php
					echo form_open();
					echo form_hidden('idFile',$file['idFile']);
					$data = array('name'=>'createActor',
						'type' => 'submit',
						'value'=>'Delete',
						'class'=>'btn btn-danger');
					echo form_submit($data);
					echo form_close();
				?>
			</div>
			<p><?=$file['description']?></p>
		</div>
		<div id="document" class="col col-md-auto">	
		</div>
	</div>
</div>


<script src="<?=base_url()?>node_modules/pdfobject/pdfobject.js"></script>
<script>PDFObject.embed("<?=base_url()?><?=$file['source']?>", "#document");</script>

