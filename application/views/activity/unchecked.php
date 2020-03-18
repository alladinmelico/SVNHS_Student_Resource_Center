<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-hover table-inverse table-responsive">
				<thead class="thead-inverse">
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Total Items</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
						<?php foreach($unchecks as $uncheck){?>
							<tr>
								<td scope="row"><?=$uncheck['activity_title']?></td>
								<td scope="row"><?=$uncheck['activity_description']?></td>
								<td scope="row"><?=$uncheck['total_items']?></td>
								<td scope="row">
									<a href="<?=base_url()?>activity/<?=$uncheck['idActivity']?>"><i class="fas fa-chevron-circle-right h2"></i></a>
								</td>
							</tr>
						<?php }?>
					</tbody>
			</table>
		</div>
	</div>
</div>
