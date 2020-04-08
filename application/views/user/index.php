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

<div class="container mt-5">
	<div class="row mt-5 mb-5">
		<h1><i class="fas fa-chart-line mr-3"></i>Overall Performance</h1>
		<div id="linechart" style="width: 1000px; height: 500px" class="card shadow mx-auto"></div>
	</div>

	<div class="row">
		<div class="col-xl">
			<?php $this->load->view('user/user_class')?>
		</div>
	</div>

	<h1><i class="fas fa-book mr-3 mt-5"></i>Latest Published Papers</h1>
	<div class="row row-cols-1 row-cols-md-3 mt-3">
		<?php foreach($files as $file){ ?>
			<div class="col mb-4">
				<div class="card">

				<div class="view">
					<img class="card-img-top" src="<?=base_url('files/covers/'.$file['cover'])?>"
					alt="Card image cap" height="250">
					<a href="<?=base_url()?>search/file/<?=$file['idFile']?>">
						<div class="mask rgba-cyan-light"></div>
					</a>
				</div>

				<div class="card-body">

					<h2 class="card-title text-info"><?= $file['title']?></h2>
					<p class="card-text"><?= $file['file_description']?></p>
					<strong class="card-text text-info font-weight-bold"> <?=date("F j, Y, g:i a",strtotime($file['file_timestamp']))?></strong>
					<a href="<?=base_url()?>search/file/<?=$file['idFile']?>" class="h2 d-flex justify-content-end"><i class="fas fa-chevron-circle-right "></i></a>

				</div>

				</div>
			</div>
		<?php }?>
	</div>
	


</div>
