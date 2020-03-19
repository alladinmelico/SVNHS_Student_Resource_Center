<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawLine);

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
		<div class="col-10">
				<div class="row overflow-auto py-3 rounded-lg shadow">
					<?php if($performances){?>
						<div id="linechart" style="width: 1000px; height: 500px" ></div>
					<?php } else echo "No Records yet, please submit on your activity";?>
				</div>
		</div>
		
		<div class="col-2 py-3 px-3 overflow-auto">
			<h3>Classmates</h3>
			<table class="table table-hover db-dark overflow-auto">
				<thead>
					<th>Name</th>
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
			<h2>Activities</h2>
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
								<td scope="row">
									<a href="<?=base_url()?>user/activity/<?=$activity['idActivity']?>"><i class="fas fa-chevron-circle-right h2"></i></a>
								</td>
							</tr>
						<?php }?>
					</tbody>
			</table>
		</div>
	</div>
</div>
