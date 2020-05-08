<style>	
	#activity-header {
		display: flex;
		justify-content: space-between;
		background-color: var(--light-blue);
		border-radius: 1rem;
		padding: 2rem;
	}

	#activity-header-toolbar button {
		padding-left: 1rem;
		margin-bottom: 1rem;
	}

	#activity-header-toolbar button i {
		color: var(--dark-blue);
	}

	#activity-header p{
		padding: 2rem;
		color: var(--dark-blue);
	}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});

		function loadCharts(){
			google.charts.setOnLoadCallback(drawPie);
			google.charts.setOnLoadCallback(drawBar);
		}

		function drawPie() {
			var data = new google.visualization.arrayToDataTable([
                ['Films','Reviews'],
                <?php
					$total = array();
					
					foreach($submitted as $submit){
						$language = $this->MFile->getFileLanguage($submit['language']);
						if(array_key_exists($language,$total)){
							$total[$language]++;
						} else {
							$total[$language] = 1;
						}
					}

                    foreach($total AS $key => $data){
                        echo "['".$key."',".$data."],";
                    }
                ?>
            ]);

			var options = {
			title: 'Languages'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);

			
		}

		
		function drawBar() {

			var data = google.visualization.arrayToDataTable([
                ['percentage','score'],
                <?php
					$totalSentiment = array();
                    foreach($submitted AS $submit){
						$sentiment = $this->MFile->getFileSentiment($submit['sentiment']);
						$totalSentiment[] = $sentiment;
					?>
                        ['<?= $submit['last_name'];?>',<?=$sentiment?>],
                <?php    } ?>
            ]);

			var options = {
			title: 'Sentiments',
			
			chartArea: {width: '50%'},
			hAxis: {
				title: 'Total Scores',
				minValue: 0
			},
			vAxis: {
				title: 'Students'
			}
			};

			var chart = new google.visualization.BarChart(document.getElementById('barchart'));

			chart.draw(data, options);
			}
		
		loadCharts();
		window.onresize = function(){loadCharts()}
	</script>

<!-- MDBootstrap Datatables  -->
<link href="<?=base_url('css/addons/datatables.min.css')?>" rel="stylesheet">

<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="<?=base_url('js/addons/datatables.min.js')?>"></script> 

<script type="text/javascript">
	$(document).ready(function() {
		$('#dtCheck').DataTable();
	});
</script>

<div id="activity-header">
	<div id="activity-header-details">
		<h1><?=ucfirst($activity['activity_title'])?></h1>
	<strong><?=date("F j, Y, g:i a",strtotime($activity['activity_DueDate']))?></strong>
	<p><?=$activity['activity_description']?></p>
	</div>
	<div id="activity-header-toolbar">
		<button class="modal-open" data-target="modal-activity" onclick="modalOpen(this)">
			<i class="fa fa-edit button"></i>
		</button>
		<?php
			echo form_open('activity/show');
			echo form_hidden('idActivity',$this->uri->segment(2));?>
			<button type="submit"><i class="fa fa-trash button"></i></button>
			<?php echo form_close();
		?>
	</div>
	
</div>



<?php if($submitted){?>
	
	<div class="sentiment">
		Total Sentiment
		<p class="display-4"><?=floor((array_sum($totalSentiment)/count($totalSentiment))*100)?>%</p>
	</div>
	<div id="barchart" class="chart graph" ></div>
	<div id="piechart" class="chart graph" ></div>
<?php }?>

<h3><i class="fas fa-file-alt"></i>Submissions</h3>

	<table class="" id="dtCheck">
		<thead>
			<tr>
				<th>Student</th>
				<th>Title</th>
				<th>Date Submitted</th>
				<th>Language</th>
				<th>Sentiment</th>
				<th>Score</th>
				<th>Status</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach($submitted as $submit){?>
					<tr>
						<td><?=ucfirst($submit['first_name']).' '.ucfirst($submit['last_name']) ?></td>
						<td><?=$submit['title']?></td>
						<td><?=date("F j, Y, g:i a",strtotime($submit['activity_submitted']))?></td>
						<td><?=$this->MFile->getFileLanguage($submit['language'])?></td>
						<td><?=$this->MFile->getFileSentiment($submit['sentiment'])?></td>
						<td><?=$submit['score']?></td>
						<td>
							<a href="<?=base_url()?>teacher/check/<?=$submit['idActivity']?>/<?=$submit['idUser']?>" 
							class="badge <?=($submit['score']==NULL)? 'btn-danger':'btn-success'?>">
								<?=($submit['score']==NULL)? 'UNCHECKED':'CHECKED'?>
							</a>
						</td>
					</tr>
				<?php }?>
			</tbody>
	</table>

<!-- Modal -->
<div class="modal" id="modal-activity">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Edit Activity</h5>
			<button type="button" data-target="modal-activity" onclick="modalClose(this)">
				&times;
			</button>
		</div>
		<div class="modal-body">
			<?php $this->load->view('activity/edit');?>
		</div>
		<div class="modal-footer">
			<button type="submit" class="button">Save</button>
			<?=form_close()?>
		</div>
	</div>
</div>
