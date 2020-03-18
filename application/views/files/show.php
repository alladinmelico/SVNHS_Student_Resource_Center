
<style>
	.pdfobject-container { height: 80rem; width: 70rem; }
</style>

<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div class="row py-5">
				<div class="col">
					<h3><?=$file['title']?></h3>
				</div>
				<div class="col-xs-1">
					<a href="" type="button" class="btn text-info btn-lg bg-none"><i class="fas fa-edit"></i></a>
					<?php
						echo form_open('file/show');
						echo form_hidden('source',$file['source']);
						echo form_hidden('idFile',$file['idFile']);
						echo form_hidden('idActivity',$this->uri->segment(3));?>
						<button type="submit" class="btn text-danger btn-lg bg-none"><i class="fas fa-trash"></i></button>
						<?php echo form_close();
					?>
				</div>
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
		<div id="document" class="col">	
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

