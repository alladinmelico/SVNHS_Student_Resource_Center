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
	<div class="row">
		<div class="col-xl">
			<div class="d-flex flex-column bd-highlight mb-3">
				<?php foreach($classes as $class){ ?>
					<div class="p-2 bd-highlight py-2 px-2 d-flex flex-row border rounded-lg bg-info-shadow mb-5">
						<div class="col-sm-1-12">
							<h3><?= $class['class_title']?>
						</div>
						<div class="col-lg-1-12 px-4">
							<p class="font-weight-lighter"><?= $class['class_description']?></p>
						</div>
						<div class="col-xs-1-12">
							<a href="classes/<?=$class['idClass']?>"><i class="fas fa-chevron-circle-right h2"></i></a>
						</div>
						</h3>
					</div>
				<?php }?>
			</div>
		</div>
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
