<div class="container">
	<div class="row">
		<div class="col-lg-12">			
			<div class="d-flex flex-column bd-highlight mb-3">
				<?php foreach($files as $file){?>
					<div class="p-2 bd-highlight border border-info rounded-lg m-2">
						<div class="row">
							<div class="col-2 h3 ml-2 px-2">
								 <?=$file['title']?>
							</div>
							<div class="col-md px-2 font-weight-light">
								<p><?=$file['file_description']?></p>
								
							</div>
							<div class="col-3">
								
							</div>
							<div class="col-1">
								<a href="<?=base_url()?>search/file/<?=$file['idFile']?>" class="h1 text-info">
								<i class="fas fa-arrow-alt-circle-right"></i></a>
							</div>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>
