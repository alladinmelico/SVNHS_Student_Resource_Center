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
		<div class="col-xl-12">
			<table class="table table-striped table-inverse	">
				<thead class="thead-inverse">
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Code</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($classes as $class){ ?>
						<tr>
							<td scope="row"><?= $class['class_title']?></td>
							<td scope="row"><?= $class['class_description']?></td>
							<td scope="row"><?= $class['class_code']?></td>
							<td><a href="<?=base_url()?>classes/<?=$class['idClass']?>"><i class="fas fa-chevron-circle-right h2"></i></a></td>
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
					<?php $this->load->view('class/create');?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
