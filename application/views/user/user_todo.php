<h1><i class="fas fa-clipboard-list mr-3"></i>To Do</h1>
<div class="card-container">
<?php foreach($todos as $todo){ ?>
			
			<div class="card">
				<a href="<?=base_url()?>user/classes/<?=$todo['idClass']?>">
					<div class="card-image">
						<img src="<?=base_url('files/covers/'.$todo['cover'])?>"
						alt="Card image cap">
						<div class="image-caption">
							<?= $todo['class_title']?>
						</div>
					</div>
				</a>

				<div class="card-body">
					<h2><?= $todo['activity_title']?></h2>
					<p><?= $todo['activity_description']?></p>
					<div class="card-bottom flex-end">
						<a href="<?=base_url()?>user/activity/<?=$todo['idActivity']?>" ><i class="fa fa-chevron-right button"></i></a>
					</div>
				</div>
			</div>
		<?php }?>
	</div>
