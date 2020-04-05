<div class="container border rounded-lg bg-info-shadow">
<div class="row ">
	<div class="col d-flex align-items-center">
		<h3><a href="<?=base_url('activity/unchecked')?>">Unchecked</a></h3>
	</div>
</div>
	<div class="row">
		<span class="col">
			<table class="table table-hover">
				<thead class="thead-inverse text-dark">
					<tr>
						<th>Activity</th>
						<th>Student</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach($unchecks as $uncheck){?>
							<tr>
								<td scope="row"><?=$uncheck['activity_title']?></td>
								<td scope="row"><a href="<?=base_url()?>teacher/check/<?=$uncheck['idActivity']?>/<?=$uncheck['idUser']?>">
									<?=ucfirst($uncheck['first_name']).' '.ucfirst($uncheck['last_name']) ?></a></td>
							</tr>
						<?php }?>
					</tbody>
			</table>
		</div>
	</div>
</div>
