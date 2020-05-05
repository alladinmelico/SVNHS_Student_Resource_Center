<h1><i class="fas fa-book"></i>Latest Published Papers</h1>
<div class="card-container">
		<?php foreach($files as $file){ ?>
				<div class="card">
					<a href="<?=base_url()?>search/file/<?=$file['idFile']?>">
						<div class="card-image">
							<img src="<?=base_url('files/covers/'.$file['cover'])?>"
							alt="Card image cap">
							<div class="image-caption">
								<?= $file['title']?>
							</div>
						</div>
					</a>

					<h2><?= $file['title']?></h2>
					<p><?= $file['file_description']?></p>
					
					<div class="card-bottom">
						<strong> <?=date("F j, Y, g:i a",strtotime($file['file_timestamp']))?></strong>
						<a href="<?=base_url()?>search/file/<?=$file['idFile']?>"><i class="fa fa-chevron-right button"></i></a>
					</div>
				</div>
		<?php }?>
</div>
