<div class="container mt-5">
	<h1><i class="fas fa-clipboard-list mr-3"></i>To Do</h1>
	<div class="row row-cols-1 row-cols-md-3 mt-5">
		<?php foreach($todos as $todo){ ?>
			<div class="col mb-4">
				<div class="card">

				<div class="view">
					<img class="card-img-top" src="<?=base_url('files/covers/'.$todo['cover'])?>"
					alt="Card image cap" height="250">
					<a href="<?=base_url()?>user/classes/<?=$todo['idClass']?>" class="text-light">
						<div class="mask rgba-cyan-strong flex-center display-4 text-dark">
							<?= $todo['class_title']?>
						</div>
					</a>
				</div>

				<div class="card-body">

					<h2 class="card-title text-info"><?= $todo['activity_title']?></h2>
					<p class="card-text"><?= $todo['activity_description']?></p>
					<strong><?= $todo['activity_DueDate']?></strong>
					<a href="<?=base_url()?>user/activity/<?=$todo['idActivity']?>" 
					class="h2 d-flex justify-content-end "><i class="fas fa-chevron-circle-right "></i></a>

				</div>

				</div>
			</div>
		<?php }?>
	</div>

</div>
