<h1>Classes
	<button class="modal-open" data-target="modal-class" onclick="modalOpen(this)">
	<i class="fas fa-plus button"></i></button>
</h1>

<div class="card-container">
	<?php foreach($classes as $class){ ?>
		<div class="card">
			<a href="<?=base_url()?>classes/<?=$class['idClass']?>">
				<div class="card-image">
					<img src="<?=base_url('files/covers/'.$class['cover'])?>"
					alt="Card image cap">
					<div class="image-caption">
						<?= $class['class_title']?>
					</div>
				</div>
			</a>

			<div class="card-body">
				<h2><?= $class['class_title']?></h2>
				<p><?= $class['class_description']?></p>
				<div class="card-bottom flex-end">
					<a href="<?=base_url()?>classes/<?=$class['idClass']?>" ><i class="fa fa-chevron-right button"></i></a>
				</div>
			</div>
		</div>
	<?php }?>
</div>

<!-- Modal -->
<div class="modal" id="modal-class">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Create Class</h5>
			<button type="button" data-target="modal-class" onclick="modalClose(this)">
				&times;
			</button>
		</div>
		<div class="modal-body">
			<?php $this->load->view('class/create');?>
		</div>
		<div class="modal-footer">
			<button type="submit" class="button">Save</button>
			<?=form_close()?>
		</div>
	</div>
</div>
