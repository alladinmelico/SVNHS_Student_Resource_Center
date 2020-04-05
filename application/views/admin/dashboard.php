<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
		$('.dataTables_length').addClass('bs-select');
	});
</script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawBar);
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
	</script>


<div class="container-fluid px-5 mt-5">

	<div class="row">		
		<div class="col-sm-3">
			<div class="container border rounded-lg bg-info-shadow winter-neva-gradient">
				<div class="row">
					<div class="col">
						<h2 class="text-dark">Emails Unverified</h2>
					</div>
					<div class="col-2">
						<strong class="display-4"><?=count($unverified)?></strong>
					</div>
				</div>
				<div class="row overflow-auto" style="height:10em">
					<table class="table table-hover ">
					   <tbody>
						   <?php foreach($unverified as $user){?>
								<tr>
									<th scope="row"><?=ucfirst($user['first_name']).' '.ucfirst($user['last_name'])?></th>
								</tr>
						   <?php }?>
					   </tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-sm-2">
			<div class="container border rounded-lg bg-info-shadow winter-neva-gradient">
				<h2 class="text-dark">Total Uploads</h2>
				<p>Today</p>
				<strong class="display-4"><?=count($fileNum);?></strong>
				<span class="font-weight-light">FILES</span>
			</div>
		</div>

		<div class="col-xl">
			<div class="container border rounded-lg bg-info-shadow overflow-auto flex-center" id="style">
				<div id="barchart" class="rounded-lg shadow" style="width: 500px;"></div>
			</div>
		</div>

		<div class="col-xs ">
			<div class="container border rounded-lg bg-info-shadow winter-neva-gradient overflow-auto">
				<h2 class="text-dark">Subjects
					<a class="btn blue-gradient px-3 rounded-circle text-white" data-toggle="modal" data-target="#modalSubject">
					<i class="fas fa-plus fa-lg"></i></a>
				</h2>
				<div class="row overflow-auto flex-center" style="height:20em" id="style">
					<table class="table table-hover text-center">
						<tbody>
							<form action="<?=base_url('subject/delete')?>" method="POST">
								<?php foreach($subjects as $subject) {?>
									<tr>
										<td><?php $name = ucwords($subject['subject_name']);echo $name?></td>
										<td><button type="submit" name="idSubject" value="<?=$subject['idSubject']?>" class="btn btn-danger px-3 btn-sm rounded-pill">
										<i class="fas fa-minus"></i></button></td>
									</tr>
								<?php }?>
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<div class="row mt-5">
		<div class="col-4 py-3">
			<div class="container-fluid border rounded-lg bg-info-shadow">
				<div class="row warm-flame-gradient rounded-top ">
					<div class="col">
						<h3 class="text-dark display-4"><i class="fas fa-user fa-sm mr-3"></i>Users</h3>
					</div>
					<div class="col-1">
						
					</div>
				</div>
				<div class="row overflow-auto flex-center" style="height:30em" id="style">
					<table class="table table-hover " cellspacing="0" id="dtUsers">
						<thead >
							<tr>
								<th class="th-lg font-weight-bold">Name</th>
								<th class="th-lg font-weight-bold">Email</th>
								<th class="th-xs font-weight-bold">Status</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach($users as $user){?>
							<tr class="text-<?=($user['isActive_User']==1)? 'dark':'danger'?>">
								<td scope="row"><strong><?php $name = ucfirst($user['first_name']).' '.ucfirst($user['last_name']);echo $name?></strong></td>
								<td scope="row"><?=$user['email']?></td>
								<td class="text-center">
									<?php if($user['isActive_User'] == 1){?>
										<button name="user" value="<?=$name.','.$user['idUser']?>" type="button" 
										class="btn btn-info btn-sm px-3 rounded-pill isActive" data-toggle="modal" data-target="#modalActivate">
											ACTIVE
										</a>
									<?php } else {?>
										<button name="user" type="button" value="<?=$name.','.$user['idUser']?>" 
										class="btn btn-danger btn-sm px-3 rounded-pill notActive" data-toggle="modal" data-target="#modalDelete">
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
		</div>

		<div class="col-4 py-3">
			<div class="container-fluid border rounded-lg bg-info-shadow">
				<div class="row sunny-morning-gradient rounded-top ">
					<div class="col">
						<h3 class="text-dark display-4"><i class="fas fa-chalkboard-teacher mr-3 fa-sm"></i>Teachers</h3>
					</div>
					<div class="col-1">
						
					</div>
				</div>
				<div class="row overflow-auto flex-center" style="height:30em" id="style">
					<table class="table table-hover" cellspacing="0" id="dtTeachers">
						<thead >
							<tr>
								<th class="th-lg font-weight-bold">Name</th>
								<th class="th-lg font-weight-bold">Email</th>
								<th class="th-xs font-weight-bold">Status</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach($teachers as $teacher){?>
							<tr class="text-<?=($teacher['isActive_Teacher']==1)? 'dark':'danger'?>">
								<td scope="row"><strong><?php $name = ucfirst($teacher['first_name']).' '.ucfirst($teacher['last_name']);echo $name?></strong></td>
								<td scope="row"><?=$teacher['email']?></td>
								<td class="text-center">
									<?php if($teacher['isActive_Teacher'] == 1){?>
										<button name="teacher" value="<?=$name.','.$teacher['idTeacher']?>" type="button" 
										class="btn btn-info btn-sm px-3 rounded-pill isActive" data-toggle="modal" data-target="#modalActivate">
											ACTIVE
										</button>
									<?php } else {?>
										<button name="teacher" type="button" value="<?=$name.','.$teacher['idTeacher']?>" 
										class="btn btn-danger btn-sm px-3 rounded-pill notActive" data-toggle="modal" data-target="#modalDelete">
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
		</div>


		<div class="col-4 py-3">
			<div class="container-fluid border rounded-lg bg-info-shadow">
				<div class="row tempting-azure-gradient rounded-top ">
					<div class="col">
						<h3 class="text-dark display-4"><i class="fas fa-clipboard-list mr-3 fa-sm"></i>Activities</h3>
					</div>
					<div class="col-1">
						
					</div>
				</div>
				<div class="row overflow-auto flex-center" style="height:30em" id="style">
					<table class="table table-hover" cellspacing="0" id="dtActivities">
						<thead >
							<tr>
								<th class="th-lg font-weight-bold">Title</th>
								<th class="th-lg font-weight-bold">Date</th>
								<th class="th-xs font-weight-bold">Status</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach($activities as $activity){?>
							<tr class="text-<?=($activity['isActive_Activity']==1)? 'dark':'danger'?>">
								<td scope="row"><strong><?php $name = $activity['activity_title'];echo $name?></strong></td>
								<td scope="row"><?=date("F j, Y, g:i a",strtotime($activity['activity_timestamp']))?></td>
								<td class="text-center">
									<?php if($activity['isActive_Activity'] == 1){?>
										<button name="activity" value="<?=$name.','.$activity['idActivity']?>" type="button" 
										class="btn btn-info btn-sm px-3 rounded-pill isActive" data-toggle="modal" data-target="#modalActivate">
											ACTIVE
										</button>
									<?php } else {?>
										<button name="activity" type="button" value="<?=$name.','.$activity['idActivity']?>" 
										class="btn btn-danger btn-sm px-3 rounded-pill notActive" data-toggle="modal" data-target="#modalDelete">
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
		</div>
	</div>


	<div class="row mt-3">
		<div class="col py-3 ">
			<div class="container-fluid border rounded-lg bg-info-shadow px-3">
				<div class="row deep-blue-gradient rounded-top ">
					<div class="col">
						<h3 class="text-dark display-4"><i class="fas fa-users mr-3 fa-sm"></i>Classes</h3>
					</div>
					<div class="col-1">
						
					</div>
				</div>
				<div class="row flex-center px-3"  id="style">
					<table class="table table-hover" cellspacing="0" id="dtClass">
						<thead >
							<tr>
								<th class="th-lg font-weight-bold">Title</th>
								<th class="th-lg font-weight-bold">Teacher</th>
								<th class="th-lg font-weight-bold">Activities</th>
								<th class="th-lg font-weight-bold">Code</th>
								<th class="th-xs font-weight-bold">Status</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach($classes as $class){?>
							<tr class="text-<?=($class['isActive_Class']==1)? 'dark':'danger'?>">
								<td scope="row"><strong><?php $name = $class['class_title'];echo $name;?></strong></td>
								<td scope="row"><?=ucfirst($class['first_name']).' '.ucfirst($class['last_name'])?></td>
								<td scope="row"><?=$class['activity_title']?></td>
								<td scope="row"><?=$class['class_code']?></td>
								<td class="text-center">
									<?php if($class['isActive_Class'] == 1){?>
										<button name="class" value="<?=$name.','.$class['idClass']?>" type="button" 
										class="btn btn-info btn-sm px-3 rounded-pill isActive" data-toggle="modal" data-target="#modalActivate">
											ACTIVE
										</button>
									<?php } else {?>
										<button name="class" type="button" value="<?=$name.','.$class['idClass']?>" 
										class="btn btn-danger btn-sm px-3 rounded-pill notActive" data-toggle="modal" data-target="#modalDelete">
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
		</div>


		<div class="col py-3 ">
			<div class="container-fluid border rounded-lg bg-info-shadow px-3">
				<div class="row ripe-malinka-gradient rounded-top ">
					<div class="col">
						<h3 class="text-dark display-4"><i class="fas fa-file-alt mr-3 fa-sm"></i></i>Files</h3>
					</div>
					<div class="col-1">
						
					</div>
				</div>
				<div class="row flex-center px-3"  id="style">
					<table class="table table-hover" cellspacing="0" id="dtFiles">
						<thead >
							<tr>
								<th class="th-lg font-weight-bold">Title</th>
								<th class="th-lg font-weight-bold">Activity</th>
								<th class="th-lg font-weight-bold">Date</th>
								<th class="th-xs font-weight-bold">Status</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach($files as $file){?>
							<tr class="text-<?=($file['isPublic']==1)? 'dark':'danger'?>">
								<td scope="row"><strong><?php $name = $file['title'];echo $name;?></strong></td>
								<td scope="row"><?=$file['activity_title']?></td>
								<td scope="row"><?=date("F j, Y, g:i a",strtotime($file['file_timestamp']))?></td>
								<td class="text-center">
									<?php if($file['isPublic'] == 1){?>
										<button name="file" value="<?=$name.','.$file['idFile']?>" type="button" 
										class="btn btn-info btn-sm px-3 rounded-pill isActive" data-toggle="modal" data-target="#modalActivate">
											ACTIVE
										</button>
									<?php } else {?>
										<button name="file" type="button" value="<?=$name.','.$file['idFile']?>" 
										class="btn btn-danger btn-sm px-3 rounded-pill notActive" data-toggle="modal" data-target="#modalDelete">
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
		</div>
	</div>
</div>



<!-- Central Modal Small -->
<div class="modal fade" id="modalActivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title w-100" id="myModalLabel">Activate</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <h4>Are you sure you want to activate <span id="userName" class="text-info font-weight-bold"></span>?</h4>
		  <form action="<?=base_url('admin/dashboard/activate')?>" method="POST">
		  <input type="hidden" name="action" id="inputAction">
		  <input type="hidden" name="id" id="inputId">
      </div>
      <div class="modal-footer flex-center">
			<button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Close</button>
			<button type="submit" name="submit" class="btn btn-info btn-sm">Activate</button>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger text-light">
				<h5 class="modal-title">Deactivate</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				<h4>Are you sure you want to deactivate <span id="userNameDelete" class="text-info font-weight-bold"></span>?</h4>
				<form action="<?=base_url('admin/dashboard/deactivate')?>" method="POST">
				<input type="hidden" name="action" id="inputActionDelete">
				<input type="hidden" name="id" id="inputIdDelete">
			</div>
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Close</button>
				<button type="submit" name="submit" class="btn btn-danger btn-sm">Deactivate</button>
				</form>
			</div>
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
	$('#modalActivate').on('show.bs.modal', event => {
		var button = $(event.relatedTarget);
		var modal = $(this);
		console.log(button);
		$("#userName").text(button.val().split(',')[0]);
		$("#inputAction").val(button.attr('name'));
		$("#inputId").val(button.val().split(',')[1]);		
	});

	$('#modalDelete').on('show.bs.modal', event => {
		var button = $(event.relatedTarget);
		var modal = $(this);
		$("#userNameDelete").text(button.val().split(',')[0]);
		$("#inputActionDelete").val(button.attr('name'));
		$("#inputIdDelete").val(button.val().split(',')[1]);		
	});

	$(".isActive").mouseover(function(){
		$(this).attr("class","btn btn-danger btn-sm px-3 rounded-pill");
		$(this).text('Deactivate');
		$(this).attr("data-target","#modalDelete");
		})
		.mouseleave(function(){
			$(this).attr("class","btn btn-info btn-sm px-3 rounded-pill");
			$(this).text('Active');
			$(this).attr("data-target","#modalActivate");
		})

	$(".notActive").mouseover(function(){
		$(this).attr("class","btn btn-success btn-sm px-3 rounded-pill");
		$(this).text('Activate');
		$(this).attr("data-target","#modalActivate");
		})
		.mouseleave(function(){
			$(this).attr("class","btn btn-danger btn-sm px-3 rounded-pill");
			$(this).text('Deactivated');
			$(this).attr("data-target","#modalDelete");
		})
	
</script>
