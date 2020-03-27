
<div class="container border rounded-lg bg-info-shadow">
	<div class="row ">
		<div class="col d-flex align-items-center">
			<h3>Classes</h3>
		</div>
		<div class="col py-1">
			<a class="btn-floating btn-lg blue-gradient text-white" data-toggle="modal" data-target="#modelId">
			<i class="fas fa-plus"></i></a>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12">
			<table class="table table-hover table-borderless">
				<thead class="thead-inverse">
					<tbody>
					<?php foreach($classes as $class){ ?>
						<tr>
							<td scope="row"><a href="user/classes/<?=$class['idClass']?>"><?= $class['class_title']?></a></td>
						</tr>
					<?php }?>
					</tbody>
			</table>
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
				<button name="submit" class="btn btn-success" type="submit">SAVE</button>
				<?=form_close();?>
			</div>
		</div>
	</div>
</div>
