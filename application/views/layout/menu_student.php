
<ul class="list-group">
	<li class="list-group-item d-flex 
		justify-content-between align-items-center list-group-item-action 
		<?=($this->uri->segment(1)=='user')? 'active':'bg-dark';?>">
		<i class="fas fa-home text-light lead"></i></i><a href="<?=base_url()?>user" class="mx-auto">Home</a>
	</li>

	<li class="list-group-item d-flex 
		justify-content-between align-items-center list-group-item-action 
		<?=($this->uri->segment(2)=='classes')? 'active':'bg-dark';?>">
		<i class="fas fa-chalkboard text-light lead"></i><a href="<?=base_url()?>user/classes">Classes</a>
			<span class="badge badge-info badge-pill">
				<?=$this->MClass->getTotalUserClass();?>
			</span>
	</li>

	<li class="list-group-item d-flex 
	justify-content-between align-items-center list-group-item-action 
	<?=($this->uri->segment(2)=='activity')? 'active':'bg-dark';?>">
		<i class="fas fa-clipboard-list text-light lead"></i><a href="<?=base_url()?>user/activity">Activity</a>
		<span class="badge badge-info badge-pill">
			<?=$this->MActivity->getTotalUserActivities();?>
		</span>
	</li>

	<li class="list-group-item d-flex 
	justify-content-between align-items-center list-group-item-action
	<?=($this->uri->segment(2)=='todo')? 'active':'bg-dark';?>">
		<i class="fas fa-exclamation-circle text-light lead"></i><a href="<?=base_url()?>activity/unchecked">To Do</a>
		<span class="badge badge-danger badge-pill">pill2</span>
	</li>
</ul>
