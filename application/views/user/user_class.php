<h1><i class="fas fa-chalkboard"></i>Classes
	<a class="" data-toggle="modal" data-target="#modelId">
	<i class="fas fa-plus fa-lg"></i></a>
</h1>
	<div class="card-container">
		<?php foreach($classes as $class){ ?>
			
			<div class="card">
				<a href="<?=base_url()?>user/classes/<?=$class['idClass']?>">
					<div class="card-image">
						<img src="<?=base_url('files/covers/'.$class['cover'])?>"
						alt="Card image cap">
						<div class="image-caption">
							<p><?= $class['class_title']?></p>
						</div>
					</div>
				</a>

				<div class="card-body">
					<h2><?= $class['class_title']?></h2>
					<p><?= $class['class_description']?></p>
					<div class="card-bottom">
						<a href="<?=base_url()?>user/classes/<?=$class['idClass']?>"><i class="fas fa-chevron-circle-right "></i></a>
					</div>
				</div>
			</div>
		<?php }?>
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
