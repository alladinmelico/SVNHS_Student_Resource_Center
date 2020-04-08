<div class="container border rounded-lg bg-info-shadow">
<div class="row ">
	<div class="col d-flex align-items-center">
		<h3>Enrollment Requests</h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<table class="table table-hover table-borderless">
			<thead class="thead-inverse">
			<tr>
				<th>Name</th>
				<th>Class</th>
				<th></th>
			</tr>
			</thead>
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
	</div>
</div>
</div>
