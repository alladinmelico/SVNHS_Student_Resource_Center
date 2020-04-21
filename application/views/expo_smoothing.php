<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartExponential);

      function drawChartExponential() {
					var data = google.visualization.arrayToDataTable([
                ['x','Actual Data','Forecast Alpha: <?=$alpha?>'],
								<?php
										foreach($expo AS $row){ ?>
												['<?=$row['x'];?>',<?= $row['y'];?>,<?= $row['f'];?>],
								<?php   } ?>]);
  
			var options = {
				title: 'Exponential Smoothing',
				hAxis: {
				title: 'Time'
				},
				vAxis: {
				title: 'Dependent Variable'
				}
			};
  
        var chart_lines = new google.visualization.LineChart(document.getElementById('chart_lines'));
        chart_lines.draw(data, options);
      }
    </script>


<div class="row mt-5 mb-5">
	<div id="chart_lines" style="width: 1500px; height: 500px" class="card shadow mx-auto"></div>
</div>
