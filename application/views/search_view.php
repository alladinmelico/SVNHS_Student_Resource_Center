<h2>
	<?=($searched)? '':'No '?>Search Result for "<strong><?=$_GET['term'];?></strong>"
</h2>



<?php if($searched){
	foreach($searched as $file){ ?>
	<div class="search-result">
		<h3><a href="search/file/<?=$file['idFile']?>"><?=preg_replace('/('.$_GET['term'].')/i ','<span class="highlight">$1</span>',$file['title']) ?></a></h3>
		<p class="search-description"><?=preg_replace('/('.$_GET['term'].')/i ','<span class="highlight">$1</span>',$file['file_description']) ?></p>
		<div class="search-keys">
			<?php 
				$phrases = array_values($this->MFile->getFileKeyPhrases($file['key_phrase']));
				foreach($phrases as $key => $data){
					if (preg_match('/'.$_GET['term'].'/i',$data)) {
						echo "<span class='badge'>".preg_replace('/('.$_GET['term'].')/i ','<span class="highlight">$1</span>',$data)."</span>";
					}
				}?>
		</div>
	</div>
<?php }}?>

