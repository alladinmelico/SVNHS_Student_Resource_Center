
<ul class="list-group">
	<li class="list-group-item d-flex 
		justify-content-between align-items-center list-group-item-action 
		<?=($this->uri->segment(1)=='teacher')? 'active':'bg-dark';?>">
		<i class="fas fa-home text-light lead"></i></i><a href="<?=base_url()?>teacher" class="mx-auto">Home</a>
	</li>

	<li class="list-group-item d-flex 
		justify-content-between align-items-center list-group-item-action 
		<?=($this->uri->segment(1)=='classes')? 'active':'bg-dark';?>">
		<i class="fas fa-chalkboard text-light lead"></i><a href="<?=base_url()?>classes">Classes</a>
			<span class="badge badge-info badge-pill">
				<?=$this->MClass->getTotalTeacherClass();?>
			</span>
	</li>

	<li class="list-group-item d-flex 
	justify-content-between align-items-center list-group-item-action 
	<?=($this->uri->segment(1)=='activity')? 'active':'bg-dark';?>">
		<i class="fas fa-clipboard-list text-light lead"></i><a href="<?=base_url()?>activity">Activity</a>
		<span class="badge badge-info badge-pill">
			<?=$this->MActivity->getTotalTeacherActivities();?>
		</span>
	</li>

	<li class="list-group-item d-flex 
	justify-content-between align-items-center list-group-item-action
	<?=($this->uri->segment(2)=='unchecked')? 'active':'bg-dark';?>">
		<i class="fas fa-exclamation-circle text-light lead"></i><a href="<?=base_url()?>activity/unchecked">Unchecked</a>
		<span class="badge badge-danger badge-pill">pill2</span>
	</li>
</ul>