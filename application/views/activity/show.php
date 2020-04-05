<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawPie);
		google.charts.setOnLoadCallback(drawBar);

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

		$totalSentiment = array();
		function drawBar() {

			var data = google.visualization.arrayToDataTable([
                ['percentage','score'],
                <?php
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
	</script>

<!-- MDBootstrap Datatables  -->
<link href="<?=base_url('css/addons/datatables.min.css')?>" rel="stylesheet">
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="<?=base_url('js/addons/datatables.min.js')?>"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#dtCheck').DataTable();
		$('.dataTables_length').addClass('bs-select');
	});
</script>

<div class="container mt-5">
	<div class="row bg-dark rounded-lg px-3 py-3">
		<div class="col-xl">
			<h1><?=ucfirst($activity['activity_title'])?></h1>
			<strong class="text-info"><?=date("F j, Y, g:i a",strtotime($activity['activity_DueDate']))?></strong>
		</div>
		<div class="col-xs">
			<button type="button" class="btn bg-info text-light px-3" data-toggle="modal" data-target="#modelId">
			<i class="fas fa-edit "></i>
			</button>
					<?php
						echo form_open('activity/show');
						echo form_hidden('idActivity',$this->uri->segment(2));?>
						<button type="submit" class="btn text-light bg-danger px-3"><i class="fas fa-trash "></i></button>
						<?php echo form_close();
					?>
		</div>
	</div>
	<div class="row py-5 px-5">
		<p><?=$activity['activity_description']?></p>
	</div>

	<div class="row py-3 border border-info text-light rounded-lg bg-info">
		<div class="col-2 text-center bg-info rounded-lg py-2">
			<span class="font-weight-bold">Total Sentiment</span>
			<div class="rounded-lg  flex-center" >
				<p class="display-4"><?=floor((array_sum($totalSentiment)/count($totalSentiment))*100)?>%</p>
				<br>
			</div>
		</div>
		<div class="col px-3">
			<div id="barchart" class="border rounded-lg shadow" ></div>
		</div>
		<div class="col px-3">
			<div id="piechart" class="border rounded-lg shadow" ></div>
		</div>
	</div>
	
	<div class="row mt-5">
		<div class="col-lg-12 shadow border border-info rounded-lg">
			<h3><i class="fas fa-file-alt mr-3 mt-3"></i>Submissions</h3>
			<table class="table table-hover" id="dtCheck">
				<thead class="thead-info text-dark">
					<tr>
						<th class="font-weight-bold">Student</th>
						<th class="font-weight-bold">Title</th>
						<th class="font-weight-bold">Date Submitted</th>
						<th class="font-weight-bold">Language</th>
						<th class="font-weight-bold">Sentiment</th>
						<th class="font-weight-bold">Score</th>
						<th class="font-weight-bold">Status</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach($submitted as $submit){?>
							<tr>
								<td scope="row"><?=ucfirst($submit['first_name']).' '.ucfirst($submit['last_name']) ?></td>
								<td scope="row"><?=$submit['title']?></td>
								<td scope="row"><?=date("F j, Y, g:i a",strtotime($submit['activity_submitted']))?></td>
								<td scope="row" class="text-info font-weight-bold"><?=$this->MFile->getFileLanguage($submit['language'])?></td>
								<td scope="row" class="text-info font-weight-bold"><?=$this->MFile->getFileSentiment($submit['sentiment'])?></td>
								<td scope="row" class="text-info font-weight-bold"><?=$submit['score']?></td>
								<td scope="row">
									<a href="<?=base_url()?>teacher/check/<?=$submit['idActivity']?>/<?=$submit['idUser']?>" 
									class="btn rounded-pill btn-sm <?=($submit['score']==NULL)? 'btn-danger':'btn-info'?>">
										<?=($submit['score']==NULL)? 'UNCHECKED':'CHECKED'?>
									</a>
								</td>
							</tr>
						<?php }?>
					</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
			<div class="modal-body">
				<div class="container-fluid">
					<?php $this->load->view('activity/edit');?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button name="submit" class="btn btn-success" type="submit">SAVE</button>
				<?=form_close();?>
			</div>
		</div>
	</div>
</div>

<script>
	$('#exampleModal').on('show.bs.modal', event => {
		var button = $(event.relatedTarget);
		var modal = $(this);
		// Use above variables to manipulate the DOM
		
	});
</script>
