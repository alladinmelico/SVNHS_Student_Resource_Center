<h1><i class="fas fa-bookmark mr-3"></i>Bookmarks</h1>
<div class="card-container">
	<?php foreach($bookmarks as $bookmark){?>		
			<div class="card">
				<a href="<?=base_url().'search/file/'.$bookmark['idFile']?>">
					<div class="card-image">
						<img src="<?=base_url('files/covers/documents.jpg')?>"
						alt="Card image cap">
						<div class="image-caption">
							<h2><?=$bookmark['title']?></h2>
						</div>
					</div>
				</a>

				<div class="card-body">
					<h2><a href="<?=base_url().'search/file/'.$bookmark['idFile']?>" ><?=$bookmark['title']?></a></h2>
					<p><?=$bookmark['file_description']?></p>
				</div>
			</div>
		<?php }?>
	</div>
