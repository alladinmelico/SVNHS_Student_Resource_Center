<div class="container">
	<div class="row">
		<div class="col-xl">
			<h1><?=ucfirst($activity['activity_title'])?></h1>
			<strong class="text-info"><?=$due['due'].' '.$due['dueTime']?></strong>
		</div>
		<div class="col-xs">
			<button type="button" class="btn btn-lg bg-info text-light" data-toggle="modal" data-target="#modelId">
			<i class="fas fa-edit fa-lg"></i>
			</button>
					<?php
						echo form_open('activity/show');
						echo form_hidden('idActivity',$this->uri->segment(2));?>
						<button type="submit" class="btn text-light btn-lg bg-danger"><i class="fas fa-trash fa-lg"></i></button>
						<?php echo form_close();
					?>
		</div>
	</div>
	<div class="row py-5">
		<p><?=$activity['activity_description']?></p>
	</div>
	<div class="row">
		<h3>Submitted</h3>
		<table class="table table-hover table-responsive">
			<thead class="thead-inverse">
				<tr>
					<th>Name</th>
					<th>Title</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
					<?php foreach($files as $file) {?>
						<tr>
							<td scope="row"><?=ucfirst($file['first_name']).' '.ucfirst($file['last_name'])?></td>
							<td scope="row"><a href="<?=base_url('search/file/'.$file['idFile'])?>"><?=$file['title']?></a></td>
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
				<button name="submit" class="btn btn-success" type="submit">SAVE</button>
				<?=form_close();?>
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
