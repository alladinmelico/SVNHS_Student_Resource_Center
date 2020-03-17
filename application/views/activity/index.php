<div class="container">
	<div class="row">
		<div class="col">
			<h1>Activities
				<button type="button" class="btn" data-toggle="modal" data-target="#modelId">
					<i class="fas fa-plus-circle h1"></i>
				</button>
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
						<th>Class</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($activities as $activity){ ?>
						<tr>
							<td scope="row"><?= $activity['activity_title']?></td>
							<td scope="row"><?= $activity['activity_description']?></td>
							<td scope="row"><?= $activity['class_title']?></td>
							<td><a href="activity/<?=$activity['idActivity']?>"><i class="fas fa-chevron-circle-right h2"></i></a></td>
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
						<h5 class="modal-title">Create Activity</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
			<div class="modal-body">
				<div class="container-fluid">
					<?php $this->load->view('activity/create');?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<?php
					$data = array('name'=>'',
					'type' => 'submit',
					'value'=>'Add',
					'class'=>'btn btn-success');
					echo form_submit($data);
					echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
