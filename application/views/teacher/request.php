<h3>Enrollment Requests</h3>
<table class="">
	<tbody>
	<?php foreach($requests as $request){?>
		<tr>
			<td scope="row"><?=ucfirst($request['first_name']).' '.ucfirst($request['last_name'])?></td>
			<td scope="row"><?=ucfirst($request['class_title'])?></td>
			<td scope="row">
				
				<?php 
					if(isset($error)){
						print_r($error);
					}
					echo form_open('teacher/confirmUser');
					echo form_hidden('idUser',$request['idUser']);?>
					<button name="submit" class="btn btn-info btn-sm" type="submit">CONFIRM</button>
					<?=form_close();?>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
