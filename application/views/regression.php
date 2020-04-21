<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawRegression);

		function drawRegression() {
			var data = google.visualization.arrayToDataTable([
                ['X','Points','forecast'],
                <?php
                    foreach($reg AS $row){ ?>
                        [<?=$row['x'];?>,<?= $row['y'];?>,<?= $row['f'];?>],
                <?php   } ?>
            ]);

			var options = {
			title: 'Scatter Chart with a line',
			hAxis: { title: 'X'},
			vAxis: { title: 'Y'},
			series: {
				1: { lineWidth: 3, pointSize: 0 }
				}
			};

			var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
	</script>

<div class="row mt-5 mb-5">
	<div id="chart_div" style="width: 1000px; height: 1000px" class="card shadow mx-auto"></div>
</div>
