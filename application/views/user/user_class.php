<div class="container">
	<div class="row">
		<div class="col">
			<h1>Classes
				<a class="btn-floating btn-lg blue-gradient text-white mt-3" data-toggle="modal" data-target="#modelId">
				<i class="fas fa-plus-circle"></i></a>
			</h1>
		</div>
	</div>
	<div class="row">
		
	</div>

	<div class="row row-cols-1 row-cols-md-3">
		<?php foreach($classes as $class){ ?>
			<div class="col mb-4">
				<div class="card">

				<div class="view">
					<img class="card-img-top" src="<?=base_url('files/covers/'.$class['cover'])?>"
					alt="Card image cap" height="250">
					<a href="<?=base_url()?>user/classes/<?=$class['idClass']?>">
						<div class="mask rgba-cyan-light"></div>
					</a>
				</div>

				<div class="card-body">

					<h2 class="card-title text-info"><?= $class['class_title']?></h2>
					<p class="card-text"><?= $class['class_description']?></p>
					<a href="<?=base_url()?>user/classes/<?=$class['idClass']?>" class="h2 d-flex justify-content-end"><i class="fas fa-chevron-circle-right "></i></a>

				</div>

				</div>
			</div>
		<?php }?>
	</div>

</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">Create Class</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
			<div class="modal-body">
				<div class="container-fluid">
					<?php $this->load->view('user/user_add_class');?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-info">Request</button>
				<?=form_close()?>
			</div>
		</div>
	</div>
</div>
