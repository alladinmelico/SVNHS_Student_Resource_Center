<style>
	#class-header {
		display: flex;
		justify-content: space-between;
		align-content: center;
		background: linear-gradient( rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 1) ), url("<?=base_url('files/covers/'.$class['cover'])?>");
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		border-radius: 1rem;
		padding: 2rem;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		margin-bottom: 1rem;
	}
	#class-toolbar{
		display: flex;
		flex-direction: column;
		justify-content: space-around;
	}
	#class-details h1,h3,p{
		color: white;
	}
	.form{
		width: 20%;
		margin: auto;
		margin: 0;
	}
	.chart{
		flex-direction: column;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		border-radius: 1rem;
		padding: 1rem;
	}

	.g{
		background-color: red;
	}
	
</style>

<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});

		function loadCharts(){
			google.charts.setOnLoadCallback(drawLine);
			google.charts.setOnLoadCallback(drawPie);
			google.charts.setOnLoadCallback(drawBar);
			google.charts.setOnLoadCallback(drawChartExponential);
			google.charts.setOnLoadCallback(drawRegression);
		}


		function drawRegression() {
			var data = google.visualization.arrayToDataTable([
                ['X','Points','forecast'],
                <?php
                    foreach($reg AS $row){ ?>
                        [<?=$row['x'];?>,<?= $row['y'];?>,<?= $row['f'];?>],
                <?php   } ?>
            ]);

			var options = {
			title: 'Score Sentiment Relationship using Linear Regression',
			hAxis: { title: 'Sentiment'},
			vAxis: { title: 'Score'},
			series: {
				1: { lineWidth: 3, pointSize: 0 }
				}
			};

			var chart = new google.visualization.ScatterChart(document.getElementById('reg_analytics'));
			chart.draw(data, options);
		}

		
		function drawChartExponential() {
					var data = google.visualization.arrayToDataTable([
					['x','Actual Data','Forecast Alpha: <?=$alpha?>'],
					<?php
							foreach($expo AS $row){ ?>
									['<?=$row['x'];?>',<?= $row['y'];?>,<?= $row['f'];?>],
					<?php   } ?>]);
	
				var options = {
					title: 'Score Forecast Using Exponential Smoothing',
					hAxis: {
					title: 'Time'
					},
					vAxis: {
					title: 'Score'
					}
				};
	
			var chart_lines = new google.visualization.LineChart(document.getElementById('expo_analytics'));
			chart_lines.draw(data, options);
		}

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
                ['percentage','score',{ role: 'style' }],
                <?php
                    foreach($topStudents AS $topStudent){ ?>
                        ['<?= $topStudent['first_name'];?>',<?= $topStudent['avgScore'];?>,'color: gray'],
                <?php    } ?>
            ]);

			var options = {
			title: 'Top Ranking Students',
			
			chartArea: {width: '50%'},
			hAxis: {
				title: 'Total Scores',
				minValue: 0,
			},
			vAxis: {
				title: 'Students',
				
			}
			};

			var chart = new google.visualization.BarChart(document.getElementById('barchart'));

			chart.draw(data, options);
		}
		loadCharts();
		window.onresize = function(){loadCharts()}
	</script>


<div id="class-header">
	<div id="class-details">
		<h3><?=ucfirst($subject['subject_name'])?></h3>
		<h1><?=$class['class_title']?></h1>
		<p><?=$class['class_description']?></p> 
	</div>
	<div id="class-toolbar">
		<button type="button" data-target="modal-class" onclick="modalOpen(this)">
			<i class="fas fa-edit button"></i>
		</button>
		<button name="submit" type="submit" value="delete" id="delete"><i class="fas fa-trash button"></i></button>
	</div>		
</div>
	
	<?php if($users){?>
				<div class="container">
					<?php if($scores){?>
						<div id="linechart" class="graph chart"></div>
						<div class="chart">
							<form action="#" method="GET" class="form">
								<input type="number" name="toForecast" id="" class="border border-info" value="<?(isset($_GET['toForecast']))? $_GET['toForecast']:''?>" placeholder="Score to Forecast">
								<input type="number" name="alpha" id="" class="border border-info" value="<?(isset($_GET['alpha']))? $_GET['alpha']:''?>" placeholder="α" min="0" max="1" step="0.1" >
								<button type="submit" class="btn btn-sm btn-primary" name="expo_smoothing">Save</button>
							</form>
							<div id="expo_analytics" class="graph"></div>
						</div>
						<div class="chart">
							<form action="#" method="GET" class="form">
								<input type="text" name="toForecastRegression" id=""
								value="<?=(isset($_GET['toForecast']))? $_GET['toForecast']:''?>" placeholder="Score to Forecast">
								<button type="submit" class="btn btn-sm btn-primary" name='regression'>Save</button>
							</form>
							<div id="reg_analytics" class="graph" ></div>
						</div>
					<?php }?>

					
					<?php if($topStudents){?>
						<div class="">
							<div id="piechart" class="chart graph"></div>
							<div id="barchart" class="chart graph"></div>
						</div>
					<?php }?>
				</div>
	<?php } 
	else {
	?>
		<h2>No student has been enrolled in this class...</h2>
		<strong>Kindly check your request inbox in your <a href="<?=base_url('teacher')?>">dashboard.</a></strong>
	<?php }?>

	<div id="students">
		<h2>Students</h2>
		<table>
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

	<div id="activities">
			<h2>Activities
				<button type="button" data-target="modal-activity" onclick="modalOpen(this)">
					<i class="fas fa-plus button"></i>
				</button>
			</h2>
			<table>
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
								<td><?=$activity['activity_title']?></td>
								<td><?=$activity['activity_description']?></td>
								<td><?=$activity['activity_timestamp']?></td>
								<td><?= anchor('activity/'.$activity['idActivity'],'<i class="fas fa-chevron-circle-right h2"></i>')?></td>
							</tr>
						<?php }?>
					</tbody>
			</table>
	</div>


<!-- Modal -->
<div class="modal" id="modal-activity">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Add Activity</h5>
			<button type="button" data-target="modal-activity" onclick="modalClose(this)">
				&times;
			</button>
		</div>
		<div class="modal-body">
			<?php $this->load->view('activity/create');?>
		</div>
		<div class="modal-footer">
			<button type="submit" class="button">Add</button>
			<?=form_close()?>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal" id="modal-class">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Edit Class</h5>
			<button type="button" data-target="modal-class" onclick="modalClose(this)">
				&times;
			</button>
		</div>
		<div class="modal-body">
			<?php $this->load->view('class/edit');?>
		</div>
		<div class="modal-footer">
			<button type="submit" class="button">Save</button>
			<?=form_close()?>
		</div>
	</div>
</div>
