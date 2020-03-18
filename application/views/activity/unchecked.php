<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-hover table-inverse table-responsive">
				<thead class="thead-inverse text-dark">
					<tr>
						<th>Class</th>
						<th>Activity</th>
						<th>Student</th>
						<th>Date Submitted</th>
						<th>Date Due</th>
						<th>Days and Hours <small class="text-muted">(Before Date Due)</small></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
						<?php foreach($unchecks as $uncheck){?>
							<tr>
								<td scope="row"><?=$uncheck['class_title']?></td>
								<td scope="row"><?=$uncheck['activity_title']?></td>
								<td scope="row"><?=ucfirst($uncheck['first_name']).' '.ucfirst($uncheck['last_name']) ?></td>
								<td scope="row"><?=$uncheck['dateSubmitted']?></td>
								<td scope="row"><?=$uncheck['dateDue']?></td>
								<td scope="row"><?php
									$timeRemained=$uncheck['dayRemaining'].' day';
									$timeRemained.=($uncheck['dayRemaining']>1)? 's and ':'and ';
									$timeRemained.=(($uncheck['dayRemaining']*24)-($uncheck['timeRemaining']));
									$timeRemained.=($uncheck['dayRemaining']>1)? ' hours':' hour';
									echo $timeRemained;
									if($uncheck['timeRemaining']<0){
										echo '<i class="fas fa-exclamation-circle text-weight-bold">Late Submitted!</i>';
									}
									?>
								</td>
								<td scope="row">
									<a href="<?=base_url()?>teacher/check/<?=$uncheck['idActivity']?>"><i class="fas fa-chevron-circle-right h2"></i></a>
								</td>
							</tr>
						<?php }?>
					</tbody>
			</table>
		</div>
	</div>
</div>
