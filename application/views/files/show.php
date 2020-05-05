<div class="file-container">

	<!-- check if on search page to add the file to the bookmarks -->
	<?php if($this->session->has_userdata('idUser') && ($this->uri->segment(1)=='search') ){?>
		<div class="file-activity-container">
			<?php $action = ($isBookMarked)? 'delete':'create'?>
			<form action="<?=base_url('u/bookmark/'.$action)?>" method="POST">
				<input type="hidden" name="idFile" value="<?=$this->uri->segment(3)?>">
				<input type="hidden" name="redirect" value="<?=base_url($this->uri->uri_string())?>">
				<button type="submit" class="btn btn-elegant btn-sm rounded-lg">
					<?=($isBookMarked)? '<i class="fas fa-bookmark fa-2x"></i>': '<i class="far fa-bookmark fa-2x"></i>' ?>
				</button>
			</form>
		</div>
	<?php }?>

	<div class="file-detail">
		<div class="file-detail-toolbar">
			<?php if($file['users_idUser'] == $this->session->userdata('idUser') && $this->uri->segment(1) != 'search'){?>
				<div class="radio-custom">
					<?php
						echo form_open('file/show');
						echo form_hidden('source',$file['source']);
						echo form_hidden('idFile',$file['idFile']);
						echo form_hidden('idActivity',$this->uri->segment(3));
					?>
						<input name="isPublic" type="checkbox"
						id="isPublic"<?=($file['isPublic'])? 'checked':''?>>
						<label class="custom-control-label" for="isPublic">Public</label>
				</div>
			<?php }?>
			<div class="edit-delete">
				<?php if($file['users_idUser'] == $this->session->userdata('idUser') && $this->uri->segment(1) != 'search'){?>	
					<button type="button" ><i class="fas fa-edit fa-lg"></i></button>
					<button name="submit" type="submit" value="delete" id="delete"><i class="fas fa-trash fa-lg"></i></button>
				<?php }?>
			</div>
		</div>
		<h3><?=$file['title']?></h3>
		<p><?=$file['file_description']?></p>	
		<strong class="mr-1">Language:</strong>
		<p class="text-info font-weight-bold"><?=$this->MFile->getFileLanguage($file['language']);?></p>
		<strong class="mr-1">Sentiment:</strong>
		<p class="text-info font-weight-bold"><?=($this->MFile->getFileSentiment($file['sentiment']));?></p>
		<?=(ucfirst($this->MFile->getFileLanguage($file['language'])) != 'English')? 
		'<small class="text-muted">Sentiment analysis does not currently work on languages other than English, we will notify you if this feature comes available</small>':''?>
		<strong class="mr-1">Entities:</strong>
		<p class="search-keys"><?php 
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
		<div id="document" class=""></div>
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
						<h5 class="modal-title" id="title">Publish File</h5>
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
				<button name="submit" type="submit" class="btn btn-info" value="Update">SAVE</button>
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


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $this->load->view('files/edit')?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button name="submit" class="btn btn-success" type="submit">SAVE</button>	
		<?=form_close();?>
      </div>
    </div>
  </div>
</div>
