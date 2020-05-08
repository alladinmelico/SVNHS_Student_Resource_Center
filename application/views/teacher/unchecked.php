<h3><a href="<?=base_url('activity/unchecked')?>">Unchecked</a></h3>

<table class="">
	<tbody>
		<?php foreach($unchecks as $uncheck){?>
			<tr>
				<td><a href="<?=base_url()?>teacher/check/<?=$uncheck['idActivity']?>/<?=$uncheck['idUser']?>">
					<?=ucfirst($uncheck['first_name']).' '.ucfirst($uncheck['last_name']) ?></a></td>
			</tr>
		<?php }?>
	</tbody>
</table>
