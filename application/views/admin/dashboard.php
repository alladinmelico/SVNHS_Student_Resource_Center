<style>
	#top-dashboard{
		display: flex;
		justify-content: space-between;
		align-content: center;
		background-color: var(--dark-blue);
		padding: 1rem;
		border-radius: 1rem;
		width: 100%;
	}
	#top-dashboard h3,strong,span{
		color: white;
	}

	#total-upload,
	#email-unverified,
	#subject{
		display: flex;
		flex-direction: column;
	}

	#total-upload span{
		color: white
	}

	#total-upload strong{
		font-size: 2rem;
	}
	
	#tables{
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		align-content: center;
	}

	.table{
		display: flex;
		flex-direction: column;
		justify-content: stretch;
		align-items: stretch;
		margin-top: 1.5rem;
		padding: 1rem;
		border-radius: 1rem;
		background-color: white;
		color: var(--dark-blue);
	}

	.table strong{
		color: var(--blue);
	}

	a{
		color: white;
	}

	.modal-body h4,span,.modal-title{
		color: var(--dark-blue);
	}

	.isActive,.notActive{
		color: white !important;
		text-transform: uppercase;
	}
	.isActive{
		background-color: green !important;
	}

	.notActive{
		background-color: red !important;
	}
</style>



<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- MDBootstrap Datatables  -->
<link href="<?=base_url('css/addons/datatables.min.css')?>" rel="stylesheet">
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="<?=base_url('js/addons/datatables.min.js')?>"></script> 

<script type="text/javascript">
	$(document).ready(function () {
		$('#dtUsers').DataTable();
		$('#dtTeachers').DataTable();
		$('#dtActivities').DataTable();
		$('#dtClass').DataTable();
		$('#dtFiles').DataTable();
	});
</script>

    <script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		function loadCharts(){
			google.charts.setOnLoadCallback(drawBar);
		}

		function drawBar() {

			var data = google.visualization.arrayToDataTable([
                ['percentage','files'],
                <?php
                    foreach($classNum AS $class){ ?>
                        ['<?= $class['class_title'];?>',<?= $class['files'];?>],
                <?php    } ?>
            ]);

			var options = {
			title: 'Classes by File Uploads',
			
			hAxis: {
				title: 'Files',
				minValue: 0
			},
			vAxis: {
				title: 'Classes'
			}
			};

			var chart = new google.visualization.BarChart(document.getElementById('barchart'));

			chart.draw(data, options);
		}
		loadCharts();
		window.onresize = function(){loadCharts()}
	</script>

<div id="top-dashboard">
	<div id="email-unverified">
		<h3>Emails Unverified</h3>
		<strong><?=count($unverified)?></strong>
		<?php foreach($unverified as $user){?>
			<span><?=ucfirst($user['first_name']).' '.ucfirst($user['last_name'])?></span>
		<?php }?>
	</div>

	<div id="total-upload">
		<h3>Total Uploads (today)</h3>
		<strong><?=count($fileNum);?></strong>
		<span>FILES</span>
	</div>

	<div id="barchart" class="chart"></div>

	<div id="subject">
		<h3>Subjects
			<a>
			<i class="fas fa-plus fa-lg"></i></a>
		</h3>
		<form action="<?=base_url('subject/delete')?>" method="POST">
			<?php foreach($subjects as $subject) {?>
					<?php $name = ucwords($subject['subject_name']);echo $name?>
					<button type="submit" name="idSubject" value="<?=$subject['idSubject']?>">
					<i class="fas fa-minus"></i></button>
			<?php }?>
		</form>
	</div>

</div>

<div id="tables">
	<div class="table">
		<h3><i class="fas fa-user"></i>Users</h3>
		<table id="dtUsers">
			<thead >
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $user){?>
					<tr class="text-<?=($user['isActive_User']==1)? 'dark':'danger'?>">
						<td><strong><?php $name = ucfirst($user['first_name']).' '.ucfirst($user['last_name']);echo $name?></strong></td>
						<td><?=$user['email']?></td>
						<td>
							<?php if($user['isActive_User'] == 1){?>
								<button name="user" value="<?=$name.','.$user['idUser']?>" type="button" 
								class="badge isActive" data-target="modal-activate" onclick="modalOpen(this)" >
									ACTIVE
							<?php } else {?>
								<button name="user" type="button" value="<?=$name.','.$user['idUser']?>" 
								class="badge notActive" data-target="modal-delete" onclick="modalOpen(this)">
									DEACTIVATED
								</button>
							<?php }?>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>

	<div class="table">
		<h3><i class="fas fa-chalkboard-teacher"></i>Teachers</h3>
		<table  id="dtTeachers">
				<thead >
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Status</th>
					</tr>
				</thead>
			<tbody>
				<?php foreach($teachers as $teacher){?>
					<tr class="text-<?=($teacher['isActive_Teacher']==1)? 'dark':'danger'?>">
						<td><strong><?php $name = ucfirst($teacher['first_name']).' '.ucfirst($teacher['last_name']);echo $name?></strong></td>
						<td><?=$teacher['email']?></td>
						<td>
							<?php if($teacher['isActive_Teacher'] == 1){?>
								<button name="teacher" value="<?=$name.','.$teacher['idTeacher']?>" type="button" 
								class="badge isActive"  data-target="modal-activate" onclick="modalOpen(this)">
									ACTIVE
								</button>
							<?php } else {?>
								<button name="teacher" type="button" value="<?=$name.','.$teacher['idTeacher']?>" 
								class="badge notActive"  data-target="modal-delete" onclick="modalOpen(this)">
									DEACTIVATED
								</button>
							<?php }?>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>

	<div class="table">
		<h3><i class="fas fa-clipboard-list"></i>Activities</h3>
		<table id="dtActivities">
				<thead >
					<tr>
						<th>Title</th>
						<th>Date</th>
						<th>Status</th>
					</tr>
				</thead>
			<tbody>
				<?php foreach($activities as $activity){?>
					<tr class="<?=($activity['isActive_Activity']==1)? '':'danger'?>">
						<td><strong><?php $name = $activity['activity_title'];echo $name?></strong></td>
						<td><?=date("F j, Y, g:i a",strtotime($activity['activity_timestamp']))?></td>
						<td>
							<?php if($activity['isActive_Activity'] == 1){?>
								<button name="activity" value="<?=$name.','.$activity['idActivity']?>" type="button" 
									class="badge isActive"  data-target="modal-activate" onclick="modalOpen(this)">
									ACTIVE
								</button>
							<?php } else {?>
								<button name="activity" type="button" value="<?=$name.','.$activity['idActivity']?>" 
									class="badge notActive"  data-target="modal-delete" onclick="modalOpen(this)">
									DEACTIVATED
								</button>
							<?php }?>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>

	<div class="table">
		<h3><i class="fas fa-users mr-3 fa-sm"></i>Classes</h3>
		<table id="dtClass">
			<thead >
				<tr>
					<th>Title</th>
					<th>Teacher</th>
					<th>Activities</th>
					<th>Code</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($classes as $class){?>
					<tr class="text-<?=($class['isActive_Class']==1)? 'dark':'danger'?>">
						<td><strong><?php $name = $class['class_title'];echo $name;?></strong></td>
						<td><?=ucfirst($class['first_name']).' '.ucfirst($class['last_name'])?></td>
						<td><?=$class['activity_title']?></td>
						<td><?=$class['class_code']?></td>
						<td>
							<?php if($class['isActive_Class'] == 1){?>
								<button name="class" value="<?=$name.','.$class['idClass']?>" type="button" 
									class="badge isActive"  data-target="modal-activate" onclick="modalOpen(this)">
									ACTIVE
								</button>
							<?php } else {?>
								<button name="class" type="button" value="<?=$name.','.$class['idClass']?>" 
									class="badge notActive"  data-target="modal-delete" onclick="modalOpen(this)">
									DEACTIVATED
								</button>
							<?php }?>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>	

	<div class="table">
		<h3><i class="fas fa-file-alt mr-3 fa-sm"></i></i>Files</h3>
		<table id="dtFiles">
			<thead >
				<tr>
					<th >Title</th>
					<th >Activity</th>
					<th >Date</th>
					<th class="th-xs font-weight-bold">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($files as $file){?>
					<tr class="text-<?=($file['isPublic']==1)? 'dark':'danger'?>">
						<td><strong><?php $name = $file['title'];echo $name;?></strong></td>
						<td><?=$file['activity_title']?></td>
						<td><?=date("F j, Y, g:i a",strtotime($file['file_timestamp']))?></td>
						<td>
							<?php if($file['isPublic'] == 1){?>
								<button name="file" value="<?=$name.','.$file['idFile']?>" type="button" 
								class="badge isActive"  data-target="modal-activate" onclick="modalOpen(this)">
									ACTIVE
								</button>
							<?php } else {?>
								<button name="file" type="button" value="<?=$name.','.$file['idFile']?>" 
								class="badge notActive"  data-target="modal-delete" onclick="modalOpen(this)">
									DEACTIVATED
								</button>
							<?php }?>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal" id="modal-activate">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Activate</h5>
			<button type="button" data-target="modal-activate" onclick="modalClose(this)">
				&times;
			</button>
		</div>
		<div class="modal-body">
			<h4>Are you sure you want to activate <span id="nameActivate" class="text-info font-weight-bold"></span>?</h4>
			<form action="<?=base_url('admin/dashboard/activate')?>" method="POST">
			<input type="hidden" name="action" id="inputAction">
			<input type="hidden" name="id" id="inputId">
		</div>
		<div class="modal-footer">
			<button type="submit" class="button">Activate</button>
			<?=form_close()?>
		</div>
	</div>
</div>

<div class="modal" id="modal-delete">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title danger">Deactivate</h5>
			<button type="button" data-target="modal-delete" onclick="modalClose(this)">
				&times;
			</button>
		</div>
		<div class="modal-body">
			<h4>Are you sure you want to deactivate <span id="nameDelete" class="text-info font-weight-bold"></span>?</h4>
			<form action="<?=base_url('admin/dashboard/deactivate')?>" method="POST" class="form">
			<input type="hidden" name="action" id="inputActionDelete">
			<input type="hidden" name="id" id="inputIdDelete">
		</div>
		<div class="modal-footer">
			<button type="submit" class="button danger">Deactivate</button>
			<?=form_close()?>
		</div>
	</div>
</div>

<div class="modal fade" id="modalSubject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info text-light">
				<h5 class="modal-title">Subjects</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('subject/create')?>" method="POST">
				<label>Title</label>
				<input type="text" name="subject_name" class="form-control" id="subjName">
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Close</button>
				<button type="submit" name="submit" class="btn btn-info btn-sm">Add</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(".isActive").mouseover(function(){
		$(this).attr("class","badge notActive");
		$(this).text('Deactivate');
		$(this).attr("data-target","modal-delete",onclick="modalOpen(this)");
		})
		.mouseleave(function(){
			$(this).attr("class","badge isActive");
			$(this).text('Active');
			$(this).attr("data-target","modal-activate");
		})

	$(".notActive").mouseover(function(){
		$(this).attr("class","badge isActive");
		$(this).text('Activate');
		$(this).attr("data-target","modal-activate");
		})
		.mouseleave(function(){
			$(this).attr("class","badge notActive");
			$(this).text('Deactivated');
			$(this).attr("data-target","modal-delete",onclick="modalOpen(this)");
		})

	
</script>

