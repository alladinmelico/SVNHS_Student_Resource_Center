<div class="container mt-5">
	<h1><i class="fas fa-book mr-3"></i>Latest Published Papers</h1>
	<div class="row row-cols-1 row-cols-md-3 mt-5">
		<?php foreach($files as $file){ ?>
			<div class="col mb-4">
				<div class="card">

				<div class="view">
					<img class="card-img-top" src="<?=base_url('files/covers/'.$file['cover'])?>"
					alt="Card image cap" height="250">
					<a href="<?=base_url()?>search/file/<?=$file['idFile']?>">
						<div class="mask rgba-cyan-light"></div>
					</a>
				</div>

				<div class="card-body">

					<h2 class="card-title text-info"><?= $file['title']?></h2>
					<p class="card-text"><?= $file['file_description']?></p>
					<strong class="card-text text-info font-weight-bold"> <?=date("F j, Y, g:i a",strtotime($file['file_timestamp']))?></strong>
					<a href="<?=base_url()?>search/file/<?=$file['idFile']?>" class="h2 d-flex justify-content-end"><i class="fas fa-chevron-circle-right "></i></a>

				</div>

				</div>
			</div>
		<?php }?>
	</div>

	
</div>
