<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawLine);

		function drawLine() {
			var data = google.visualization.arrayToDataTable([
                ['percentage','Score Percent'],
                <?php
                    foreach($performances AS $performance){ ?>
                        ['<?=$performance['activity_title'];?>',<?= $performance['score'];?>],
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
	</script>

<h1><i class="fas fa-chart-line"></i>Overall Performance</h1>
<div id="linechart" style="width: 1000px; height: 500px" class="card"></div>
<?php
	$this->load->view('user/user_class');
	$this->load->view('index');
?>
