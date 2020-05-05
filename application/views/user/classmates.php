
<h3>Classmates</h3>
<table class="">
	<tbody>
		<?php foreach($users as $user){?>
			<tr>
				<td scope="row"><?= ucfirst($user['first_name']).' '.ucfirst($user['last_name']) ?></td>
			</tr>
		<?php }?>
	</tbody>
</table>
