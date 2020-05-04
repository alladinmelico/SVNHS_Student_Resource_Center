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

<!-- 
<div class="container mt-5">
	<div class="row row-cols-1 row-cols-md-3 mt-5">
		<?php foreach($bookmarks as $bookmark){?>
			<div class="col mb-4">
				<div class="card">
					<div class="view ">
						<img class="card-img-top" src="<?=base_url('files/covers/documents.jpg')?>"
						alt="Card image cap" height="250">
						<a href="<?=base_url().'search/file/'.$bookmark['idFile']?>" >
							<div class="mask rgba-cyan-strong flex-center text-dark display-4">
								<?=$bookmark['title']?>
							</div>
						</a>
					</div>
					<div class="card-body">
						<h4 class="card-title"><a href="<?=base_url().'search/file/'.$bookmark['idFile']?>" ><?=$bookmark['title']?></a></h4>
						<p class="card-text"><?=$bookmark['file_description']?></p>
						<a href="<?=base_url().'search/file/'.$bookmark['idFile']?>" class="btn btn-primary">Read more</a>
					</div>
				</div>
			</div>
			<?php }?>
	</div>
</div>
 -->
