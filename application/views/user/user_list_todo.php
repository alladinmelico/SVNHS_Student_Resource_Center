<div class="container border rounded-lg bg-info-shadow">
	<div class="row ">
		<div class="col d-flex align-items-center">
			<h3>To Do</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-hover table-borderless">
					<tbody>
						<?php foreach($todos as $todo){?>
							<tr>
								<td scope="row"><a href="<?=base_url()?>user/activity/<?=$todo['idActivity']?>"><?=$todo['activity_title']?></a></td>
							</tr>
						<?php }?>
					</tbody>
			</table>
		</div>
	</div>
</div>
