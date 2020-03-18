
<style>
	.pdfobject-container { height: 80rem; width: 70rem; }
</style>

<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div class="row">
				<h3><?=$file['title']?></h3>
				<a href="" class="btn btn-info">Update</a>
				<?php
					echo form_open('file/show');
					echo form_hidden('source',$file['source']);
					echo form_hidden('idFile',$file['idFile']);
					echo form_hidden('idActivity',$this->uri->segment(3));
					$data = array('name'=>'createActor',
						'type' => 'submit',
						'value'=>'Delete',
						'class'=>'btn btn-danger');
					echo form_submit($data);
					echo form_close();
				?>
			</div>
			<p><?=$file['file_description']?></p>
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

	print_r($pdfDetails);
?>

<script src="<?=base_url()?>node_modules/pdfobject/pdfobject.js"></script>
<script>PDFObject.embed("<?=base_url()?><?=$file['source']?>", "#document");</script>

