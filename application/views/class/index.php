<table class="table table-striped table-inverse table-responsive">
	<thead class="thead-inverse">
		<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($classes as $class){ ?>
			<tr>
				<td scope="row">
					<a href="classes/<?=$class['idClass']?>"><?= $class['class_code']?></a>
				</td>
				<td scope="row">
					<?= $class['class_description']?>
				</td>
			</tr>
		<?php }?>
		</tbody>
</table>
