<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawLine);
		google.charts.setOnLoadCallback(drawPie);
		google.charts.setOnLoadCallback(drawBar);

		function drawLine() {

			var data = new google.visualization.DataTable();
			data.addColumn('number', 'X');
			data.addColumn('number', 'Dogs');

			data.addRows([
				[0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
				[6, 11],  [7, 27],  [8, 33],  [9, 40],  [10, 32], [11, 35],
				[12, 30], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
				[18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
				[24, 60], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
				[30, 55], [31, 60], [32, 61], [33, 59], [34, 62], [35, 65],
				[36, 62], [37, 58], [38, 55], [39, 61], [40, 64], [41, 65],
				[42, 63], [43, 66], [44, 67], [45, 69], [46, 69], [47, 70],
				[48, 72], [49, 68], [50, 66], [51, 65], [52, 67], [53, 70],
				[54, 71], [55, 72], [56, 73], [57, 75], [58, 70], [59, 68],
				[60, 64], [61, 60], [62, 65], [63, 67], [64, 68], [65, 69],
				[66, 70], [67, 72], [68, 75], [69, 80]
			]);

			var options = {
				hAxis: {
				title: 'Time'
				},
				vAxis: {
				title: 'Popularity'
				}
			};

			var chart = new google.visualization.LineChart(document.getElementById('linechart'));
			chart.draw(data, options);
		}


		function drawPie() {
			var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			['Work',     11],
			['Eat',      2],
			['Commute',  2],
			['Watch TV', 2],
			['Sleep',    7]
			]);

			var options = {
			title: 'My Daily Activities'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}


		function drawBar() {

			var data = google.visualization.arrayToDataTable([
			['City', '2010 Population',],
			['New York City, NY', 8175000],
			['Los Angeles, CA', 3792000],
			['Chicago, IL', 2695000],
			['Houston, TX', 2099000],
			['Philadelphia, PA', 1526000]
			]);

			var options = {
			title: 'Population of Largest U.S. Cities',
			
			chartArea: {width: '50%'},
			hAxis: {
				title: 'Total Population',
				minValue: 0
			},
			vAxis: {
				title: 'City'
			}
			};

			var chart = new google.visualization.BarChart(document.getElementById('barchart'));

			chart.draw(data, options);
			}
	</script>


<div class="container">
	<div class="row">
		<div class="col-lg-1-12">
			<h1 class="text-info"><?=ucfirst($subject['subject_name'])?></h1>
			<h2><?=$class['class_title']?></h2>
			<p><?=$class['class_description']?></p> 
		</div>
	</div>

	<div class="row py-5">
		<div class="col">
			<div class="container">
				<div class="row overflow-auto py-3 rounded-lg shadow">
					<div id="linechart" style="width: 1000px; height: 500px" ></div>
				</div>
				<div class="row py-3">
					<div class="col px-3">
						<div id="piechart" class="rounded-lg shadow" ></div>
					</div>
					<div class="col px-3">
						<div id="barchart" class="rounded-lg shadow" ></div>
					</div>
				</div>
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


	<div class="row">
		<div class="col-lg-1-12 py-3 px-3 border border-info rounded-lg shadow">
			<h2>Activities
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivity">
					<i class="fas fa-plus-circle"></i>
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
								<td scope="row"><?= anchor('activity','<i class="fas fa-chevron-circle-right h2"></i>')?></td>
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
				<?php
					$data = array('name'=>'',
					'type' => 'submit',
					'value'=>'Upload',
					'class'=>'btn btn-success');
					echo form_submit($data);
					echo form_close();
				?>
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
