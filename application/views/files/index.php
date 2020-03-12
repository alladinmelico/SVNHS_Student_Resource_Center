<table class="table table-striped table-inverse table-responsive">
	<thead class="thead-inverse">
		<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($files as $file){ ?>
			<tr>
				<td scope="row">
					<a href="<?= $file['idFile']?>"><?= $file['description']?></a>
				</td>
			</tr>
		<?php }?>
		</tbody>
</table>
