<h1><i class="fas fa-chalkboard"></i>Classes
	<button class="modal-open" data-target="modal-class" onclick="modalOpen(this)">
	<i class="fas fa-plus button"></i></button>
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
					<div class="card-bottom flex-end">
						<a href="<?=base_url()?>user/classes/<?=$class['idClass']?>" ><i class="fa fa-chevron-right button"></i></a>
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
			<?php $this->load->view('user/user_add_class');?>
		</div>
		<div class="modal-footer">
			<button type="submit" class="button">Request</button>
			<?=form_close()?>
		</div>
	</div>
</div>

