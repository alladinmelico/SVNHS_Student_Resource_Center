<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		function loadCharts(){
			google.charts.setOnLoadCallback(drawBar);
		}

		function drawBar() {

			var data = google.visualization.arrayToDataTable([
                ['activity','No Submission','Unchecked','Below 50%','Above 50%','Perfect'],
                <?php
                    foreach($activitiesStat AS $row){ ?>
                        ['<?= $row['activity_title'];?>',<?= $row['not_submit'];?>,<?= $row['unchecked'];?>,<?= $row['lower_half'];?>,<?= $row['upper_half'];?>,<?= $row['perfect'];?>],
                <?php    } ?>
            ]);

			var options = {
			title: 'Activities',
			isStacked: true,
			};

			var chart = new google.visualization.BarChart(document.getElementById('barchart'));

			chart.draw(data, options);
			}
		loadCharts();
		window.onresize = function(){loadCharts()}
	</script>

<h1><i class="fas fa-chart-bar mr-3"></i>Activity Performances</h1>
<div id="barchart" class="graph chart" ></div>
<?php $this->load->view('class/index');?>
<?php $this->load->view('activity/index');?>
