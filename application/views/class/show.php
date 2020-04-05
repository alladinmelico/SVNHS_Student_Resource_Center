<style>
	.bg {
  /* The image used */

  background: linear-gradient( rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 1) ), url("<?=base_url('files/covers/'.$class['cover'])?>");
  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
	.content{
		z-index: 2;
		position: absolute;
		transform: translate(-50%, -50%);
	}
</style>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawLine);
		google.charts.setOnLoadCallback(drawPie);
		google.charts.setOnLoadCallback(drawBar);

		function drawLine() {
			var data = google.visualization.arrayToDataTable([
                ['percentage','score'],
                <?php
                    foreach($scores AS $score){ ?>
                        ['<?= $score['activity_title'];?>',<?= $score['avgScore'];?>],
                <?php    } ?>
            ]);

			var options = {
				title: 'Performances',
				hAxis: {
				title: 'Activities'
				},
				vAxis: {
				title: 'Score Percentage'
				}
			};

			var chart = new google.visualization.LineChart(document.getElementById('linechart'));
			chart.draw(data, options);
		}


		function drawPie() {
			var data = new google.visualization.arrayToDataTable([
                ['Films','Reviews'],
                <?php
					$avg = array(
						'less than 60'=>0,
						'70 percent'=>0,
						'80 percent'=>0,
						'90 percent'=>0,
						'90+'=>0,
					);
					
					foreach($topStudents as $topStudent){
						if($topStudent['avgScore'] <= $topStudent['total_items']/0.6){
							$avg['less than 60']++;
						} elseif($score['avgScore'] <= $topStudent['total_items']/0.7){
							$avg['70 percent']++;
						} elseif($score['avgScore'] <= $topStudent['total_items']/0.8){
							$avg['80 percent']++;
						} elseif($score['avgScore'] <= $topStudent['total_items']/0.9){
							$avg['90 percent']++;
						} else{
							$avg['90+']++;
						} 
					}


                    foreach($avg AS $key => $data){
                        echo "['".$key."',".$data."],";
                    }
                ?>
            ]);

			var options = {
			title: 'Student Averages by Category'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}


		function drawBar() {

			var data = google.visualization.arrayToDataTable([
                ['percentage','score'],
                <?php
                    foreach($topStudents AS $topStudent){ ?>
                        ['<?= $topStudent['first_name'];?>',<?= $topStudent['avgScore'];?>],
                <?php    } ?>
            ]);

			var options = {
			title: 'Top Ranking Students',
			
			chartArea: {width: '50%'},
			hAxis: {
				title: 'Total Scores',
				minValue: 0
			},
			vAxis: {
				title: 'Students'
			}
			};

			var chart = new google.visualization.BarChart(document.getElementById('barchart'));

			chart.draw(data, options);
			}
	</script>


<div class="container">
	<div class="row bg text-light py-3 px-3" style="border-radius: 1em;">
			<div class="col-1">
				<h3 class="text-info "><?=ucfirst($subject['subject_name'])?></h3>
			</div>
			<div class="col-lg">
				<h1 class="text-light text-center mt-5 mb-5 display-3"><?=$class['class_title']?></h1>
				<p class="mb-5 "><?=$class['class_description']?></p> 
			</div>
			<div class="col-1">
				<button type="button" class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#basicExampleModal">
					<i class="fas fa-edit fa-lg"></i>
				</button>
				<button name="submit" type="submit" class="btn btn-danger btn-sm" value="delete" id="delete"><i class="fas fa-trash fa-lg"></i></button>
			</div>
			
	</div>
	
	<?php if($users){?>
		<div class="row py-5">
			<div class="col">
				<div class="container">
					<?php if($scores){?>
						<div class="row overflow-auto py-3 rounded-lg shadow">
							<div id="linechart" style="width: 1000px; height: 500px" ></div>
						</div>
					<?php }?>

					
					<?php if($topStudents){?>
						<div class="row py-3">
							<div class="col px-3">
								<div id="piechart" class="rounded-lg shadow" ></div>
							</div>
							<div class="col px-3">
								<div id="barchart" class="rounded-lg shadow" ></div>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
	

	<div class="row py-5">
		<div class="col py-3 px-3 border border-info rounded-lg shadow">
			<h2>Students</h2>
			<table class="table table-hover db-dark overflow-auto">
				<thead>
					<tr>
						<th>Name</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach($users as $user){?>
							<tr>
								<td scope="row"><?= ucfirst($user['first_name']).' '.ucfirst($user['last_name']) ?></td>
							</tr>
						<?php }?>
					</tbody>
			</table>
		</div>
	</div>

	<?php } 
	else {
	?>
		<h2 class="mt-5">No student has been enrolled in this class...</h2>
		<strong class="text-muted mb-5">Kindly check your request inbox in your <a href="<?=base_url('teacher')?>">dashboard.</a></strong>
	<?php }?>

	<div class="row">
		<div class="col-lg-1-12 py-3 px-3 border border-info rounded-lg shadow">
			<h2>Activities
				<button type="button" class="btn blue-gradient px-3 rounded-circle text-white" data-toggle="modal" data-target="#addActivity">
					<i class="fas fa-plus fa-lg"></i>
				</button>
			</h2>
			<table class="table table-hover table-inverse table-responsive db-dark">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Date</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
						<?php foreach($activities as $activity){?>
							<tr>
								<td scope="row"><?=$activity['activity_title']?></td>
								<td scope="row"><?=$activity['activity_description']?></td>
								<td scope="row"><?=$activity['activity_timestamp']?></td>
								<td scope="row"><?= anchor('activity/'.$activity['idActivity'],'<i class="fas fa-chevron-circle-right h2"></i>')?></td>
							</tr>
						<?php }?>
					</tbody>
			</table>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="addActivity" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">Add Activity</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
			<div class="modal-body">
				<div class="container-fluid">
					<?php $this->load->view('activity/create');?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button name="submit" class="btn btn-success" type="submit">SAVE</button>
				<?=form_close();?>
			</div>
		</div>
	</div>
</div>

<script>
	$('#exampleModal').on('show.bs.modal', event => {
		var button = $(event.relatedTarget);
		var modal = $(this);
		// Use above variables to manipulate the DOM
		
	});
</script>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
	   <div class="modal-content">
		   <div class="modal-header">
			   <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				   <span aria-hidden="true">&times;</span>
			   </button>
		   </div>
		   <div class="modal-body">
		   		<div class="container-fluid">
					<?php $this->load->view('class/edit');?>
				</div>
		   </div>
		   <div class="modal-footer">
			   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			   <button name="submit" class="btn btn-success" type="submit">SAVE</button>
				<?=form_close();?>
		   </div>
	   </div>
   </div>
</div>
