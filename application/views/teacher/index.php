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
		<div class="col-lg-12">
			
		</div>
		<div class="col-sm-1-12">
			<table class="table table-hover table-responsive">
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
								<td scope="row"><?=ucfirst($request['first_name']).' '.ucfirst($request['first_name'])?></td>
								<td scope="row"><?=ucfirst($request['class_title'])?></td>
								<td scope="row">
									<!-- <a href="<?=base_url()?>teacher/confirmUser/<?=$request['idUser']?>">confirm</a> -->
									<?php 
										if(isset($error)){
											print_r($error);
										}
										echo form_open('teacher/confirmUser');
										echo form_hidden('idUser',$request['idUser']);
										$data = array('name'=>'',
														'type' => 'submit',
														'value'=>'confirm',
														'class'=>'btn btn-link');
										echo form_submit($data);
										echo form_close();
									?>
								</td>
							</tr>
						 <?php }?>
					</tbody>
			</table>
		</div>
	</div>
</div>
