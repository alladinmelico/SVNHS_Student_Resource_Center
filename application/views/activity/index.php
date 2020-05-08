<h1>Activities
	<button class="modal-open" data-target="modal-activity" onclick="modalOpen(this)">
	<i class="fas fa-plus button"></i></a>
</h1>

<div class="card-container">
	<?php foreach($activities as $activity){ ?>
		<div class="card">
			<a href="activity/<?=$activity['idActivity']?>">
				<div class="card-image">
					<img src="<?=base_url('files/covers/'.$activity['cover'])?>">
					<div class="image-caption">
						<?= $activity['class_title']?>
					</div>
				</div>
			</a>

			<div class="card-body">
				<h2><?= $activity['activity_title']?></h2>
				<p><?= $activity['activity_description']?></p>
				<div class="card-bottom flex-end">
					<?= $activity['activity_DueDate']?>
					<a href="activity/<?=$activity['idActivity']?>" ><i class="fa fa-chevron-right button"></i></a>
				</div>
			</div>
		</div>

	<?php }?>
</div>

<!-- Modal -->
<div class="modal" id="modal-activity">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Create Activity</h5>
			<button type="button" data-target="modal-activity" onclick="modalClose(this)">
				&times;
			</button>
		</div>
		<div class="modal-body">
			<?php $this->load->view('activity/create');?>
		</div>
		<div class="modal-footer">
			<button type="submit" class="button">Save</button>
			<?=form_close()?>
		</div>
	</div>
</div>

