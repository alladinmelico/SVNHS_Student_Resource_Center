<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		
		function loadCharts(){
			google.charts.setOnLoadCallback(drawLine);
		}

		function drawLine() {
			var data = google.visualization.arrayToDataTable([
                ['percentage','score'],
                <?php
                    foreach($performances AS $performance){ ?>
                        ['<?= $performance['activity_submitted'];?>',<?= $performance['percentage'];?>],
                <?php    } ?>
            ]);

			var options = {
				title: 'Performances',
				hAxis: {
				title: 'Time'
				},
				vAxis: {
				title: 'Score Percentage'
				}
			};

			var chart = new google.visualization.LineChart(document.getElementById('linechart'));
			chart.draw(data, options);
		}
		loadCharts();
		window.onresize = function(){loadCharts()}
	</script>


<h1 class="text-info"><?=ucfirst($subject['subject_name'])?></h1>
<h2><?=$class['class_title']?></h2>
<p><?=$class['class_description']?></p> 
<?php if($performances){?>
	<div id="linechart" class="graph chart"></div>
<?php } else echo "No Records yet, please submit on your activity";?>


<div class="card-container">
	<?php foreach($activities as $activity){?>
		
		<div class="card">
			<div class="card-body">
				<h2><?=$activity['activity_title']?></h2>
				<p><?=$activity['activity_description']?></p>
				<div class="card-bottom">
					<?=$activity['activity_timestamp']?>
					<a href="<?=base_url()?>user/activity/<?=$activity['idActivity']?>" ><i class="fa fa-chevron-right button"></i></a>
				</div>
			</div>
		</div>
	<?php }?>
</div>

