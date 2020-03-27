<div class="container">
	<div class="row">
		<div class="col">
			<h1>Activities
				<a class="btn-floating btn-lg blue-gradient text-white mt-3" data-toggle="modal" data-target="#modelId">
					<i class="fas fa-plus-circle"></i></a>
			</h1>
		</div>
	</div>
	<div class="row">
		
	</div>

	<div class="row row-cols-1 row-cols-md-3">
		<?php foreach($activities as $activity){ ?>
			<div class="col mb-4">
				<div class="card">

				<div class="view">
					<img class="card-img-top" src="<?=base_url('files/covers/'.$activity['cover'])?>"
					alt="Card image cap" height="250">
					<a href="<?=base_url()?>classes/<?=$activity['idClass']?>" class="text-light">
						<div class="mask rgba-cyan-strong flex-center display-4">
							<?= $activity['class_title']?>
						</div>
					</a>
				</div>

				<div class="card-body">

					<h2 class="card-title text-info"><?= $activity['activity_title']?></h2>
					<p class="card-text"><?= $activity['activity_description']?></p>
					<strong><?= $activity['activity_DueDate']?></strong>
					<a href="activity/<?=$activity['idActivity']?>" class="h2 d-flex justify-content-end"><i class="fas fa-chevron-circle-right "></i></a>

				</div>

				</div>
			</div>
		<?php }?>
	</div>


	<!-- <div class="row">
		<div class="col-xl-12">
			<table class="table table-striped ">
				<thead class="thead-inverse">
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Class</th>
						<th>Date Due</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($activities as $activity){ ?>
						<tr>
							<td scope="row"><?= ucfirst($activity[''])?></td>
							<td scope="row"><?= $activity['']?></td>
							<td scope="row"><?= $activity['class_title']?></td>
							<td scope="row lg"></td>
							<td><a href="activity/<?=$activity['idActivity']?>"><i class="fas fa-chevron-circle-right h2"></i></a></td>
						</tr>
					<?php }?>
					</tbody>
			</table>
		</div>
	</div> -->

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
				<button name="submit" class="btn btn-success" type="submit">SAVE</button>
				<?=form_close();?>
			</div>
		</div>
	</div>
</div>
