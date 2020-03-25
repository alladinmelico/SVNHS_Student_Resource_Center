
<style>
	.pdfobject-container { height: 80rem; width: 70rem; }
</style>
<div class="container mt-3">
	<div class="row">
		<div class="col-sm-3">
			<?php if($file['users_idUser'] == $this->session->userdata('idUser')){?>
				<div class="row justify-content-end">
					<div class="custom-control custom-switch d-flex justify-content-end mr-3">
					<?php
						echo form_open('file/show');
						echo form_hidden('source',$file['source']);
						echo form_hidden('idFile',$file['idFile']);
						echo form_hidden('idActivity',$this->uri->segment(3));
					?>
						<input name="isPublic" type="checkbox" class="custom-control-input "
						id="customSwitch1" data-toggle="modal" data-target="#modelId" 
							<?=($file['isPublic'])? 'checked':''?>>
						<label class="custom-control-label" for="customSwitch1">Public</label>
					</div>
				</div>
			<?php }?>
			<div class="row py-5">
				<div class="col">
					<h3><?=$file['title']?></h3>
				</div>
				<?php if($file['users_idUser'] == $this->session->userdata('idUser')){?>	
					<div class="col">
						<a href="" type="button" class="btn btn-primary btn-sm "><i class="fas fa-edit fa-lg"></i></a>
							
							<button name="submit" type="submit" class="btn btn-danger btn-sm" value="delete"><i class="fas fa-trash fa-lg"></i></button>
							
					</div>
				<?php }?>
			</div>
			<div class="row">
				<p><?=$file['file_description']?></p>	
			</div>
			<div class="row">
				<strong class="mr-1">Language:</strong>
				<p class="text-info font-weight-bold"><?=$this->MFile->getFileLanguage($file['language']);?></p>
			</div>
			<div class="row">
				<strong class="mr-1">Sentiment:</strong>
				<p class="text-info font-weight-bold"><?=($this->MFile->getFileSentiment($file['sentiment']));?></p>
			</div>
			<div class="row">
				<strong class="mr-1">Entities:</strong>
				<p><?php 
					$entity = array_values($this->MFile->getFileEntity($file['entity']));
					foreach($entity as $data){
						foreach($data as $key => $text){
							if($key=='wikipediaUrl'){?>
							
								<a href="<?=$data['wikipediaUrl']?>" target="_blank"
								 class="badge badge-pill badge-info font-weight-bold"><?=$data['name']?></a>
							<?php }
						}	
					}
				?>
				</p>
			</div>
		</div>
		<div id="document" class="col shadow border border-info rounded-lg py-2">	
		</div>
	</div>
</div>

<?php
	$parser = new \Smalot\PdfParser\Parser();
	$pdf    = $parser->parseFile(base_url().$file['source']);
 
	$text = substr($pdf->getText(),0,5100) ;
	$details  = $pdf->getDetails();
	$pdfDetails = array();
	foreach ($details as $property => $value) {
		if (is_array($value)) {
			$value = implode(', ', $value);
		}
		$pdfDetails[$property] = $value;
	}
?>

<script src="<?=base_url()?>node_modules/pdfobject/pdfobject.js"></script>
<script>PDFObject.embed("<?=base_url()?><?=$file['source']?>", "#document");</script>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">Publish File</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
			<div class="modal-body">
				<div class="container-fluid">
					<p> Do you want to make your file <?=($file['isPublic'])? 'PRIVATE':'PUBLIC'?>?</p>
					<small>It will be <?=($file['isPublic'])? 'NOT':''?> visible on search results.</small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" id="closebtn" data-dismiss="modal" >Close</button>
				<button name="submit" type="submit" class="btn btn-info" value="Update">Update</button>
				<?= form_close()?>
			</div>
		</div>
	</div>
</div>

<script>
	$('#exampleModal').on('show.bs.modal', event => {
		var button = $(event.relatedTarget);
		var modal = $(this);
		
	});

	$('#modelId').on('hide.bs.modal', function () {
	window.alert('hidden event fired!');
	});
</script>
