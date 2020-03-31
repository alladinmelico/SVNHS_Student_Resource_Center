<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawBar);

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
	</script>

<div class="container mt-5">
	<h1><i class="fas fa-chart-bar mr-3"></i>Activity Performances</h1>
	<div class="row mt-5">
		<div class="col d-flex justify-content-center ">
			<div id="barchart" style="width: 1000px; height: 500px" class="rounded-lg shadow " ></div>
		</div>
	</div>

	<div class="row mt-5">
		<div class="col d-flex justify-content-center ">
			<?php $this->load->view('class/index');?>
		</div>
	</div>
</div>
