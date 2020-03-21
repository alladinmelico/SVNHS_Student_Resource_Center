<div class="container">
	<div class="row">
		<div class="col">
			<h2 class="font-weight-lighter">
				<?=($searched)? '':'No '?>Search Result for "<span class="font-weight-bold"><?=$_GET['term'];?></span>"
			</h2>
		</div>
	</div>
	<div class="row">
		
	</div>
	<div class="row py-3">
		<?php if($searched){?>
			<div class="col-xl-12">
				<table class="table table-striped table-inverse	">
					<thead class="thead-inverse">
						<tr>
							<th>Title</th>
							<th>Description</th>
							<th>Key Phrases</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($searched as $file){ ?>
							<tr>
								<td scope="row">
									<?=preg_replace('/('.$_GET['term'].')/i ','<span class="text-light bg-info">$1</span>',$file['title']) ?>
								</td>
								<td scope="row">
									<?=preg_replace('/('.$_GET['term'].')/i ','<span class="text-light bg-info">$1</span>',$file['file_description']) ?>
								</td>
								<td scope="row">
									<?php 
									$phrases = array_values($this->MFile->getFileKeyPhrases($file['key_phrase']));
									foreach($phrases as $key => $data){
										if (preg_match('/'.$_GET['term'].'/i',$data)) {
											echo "<span class='badge badge-pill badge-info font-weight-bold'>".preg_replace('/('.$_GET['term'].')/i ','<span class="text-info bg-light">$1</span>',$data)."</span>";
										}
									}?>
								</td>
								<td>
									<a href="search/file/<?=$file['idFile']?>"><i class="fas fa-chevron-circle-right h2"></i></a>
								</td>
							</tr>
						<?php }?>
						</tbody>
				</table>
			</div>
		<?php }?>
	</div>

</div>
