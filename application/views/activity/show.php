<div class="container">
	<div class="row">
		<div class="col-xl-1-12">
			<h1><?=$activity['activity_title']?></h1>
			<p><?=$activity['activity_description']?></p>
		</div>
	</div>
	<div class="row">
		
	</div>
	<div class="row">
		<table class="table table-striped table-inverse table-responsive">
			<thead class="thead-inverse">
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				</thead>
				<tbody>
					<?php foreach($files as $file) {?>
						<tr>
							<td scope="row"><?=$file['last_name']?></td>
						</tr>
					<?php }?>
				</tbody>
		</table>
	</div>
</div>
