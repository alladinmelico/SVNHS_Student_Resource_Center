<div class="container">
	<div class="row">
		<div class="col-xl">
			<h1><?=ucfirst($activity['activity_title'])?></h1>
			<strong class="text-info"><?=$due['due'].' '.$due['dueTime']?></strong>
		</div>
		<div class="col-xs">
			<button type="button" class="btn text-info btn-lg bg-none" data-toggle="modal" data-target="#modelId">
			<i class="fas fa-edit"></i>
			</button>
					<?php
						echo form_open('activity/show');
						echo form_hidden('idActivity',$this->uri->segment(2));?>
						<button type="submit" class="btn text-danger btn-lg bg-none"><i class="fas fa-trash"></i></button>
						<?php echo form_close();
					?>
		</div>
	</div>
	<div class="row py-5">
		<p><?=$activity['activity_description']?></p>
	</div>
	<div class="row">
		
	</div>
	<div class="row">
		<table class="table table-striped table-inverse table-responsive">
			<thead class="thead-inverse">
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				</thead>
				<tbody>
					<?php foreach($files as $file) {?>
						<tr>
							<td scope="row"><?=$file['last_name']?></td>
						</tr>
					<?php }?>
				</tbody>
		</table>
	</div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
			<div class="modal-body">
				<div class="container-fluid">
					<?php $this->load->view('activity/edit');?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<?php
					$data = array('name'=>'',
					'type' => 'submit',
					'value'=>'Save',
					'class'=>'btn btn-success');
					echo form_submit($data);
					echo form_close();
				?>
			</div>
		</div>
	</div>
</div>

<script>
	$('#exampleModal').on('show.bs.modal', event => {
		var button = $(event.relatedTarget);
		var modal = $(this);
		// Use above variables to manipulate the DOM
		
	});
</script>
