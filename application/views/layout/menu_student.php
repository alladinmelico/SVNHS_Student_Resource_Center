
<ul class="list-group">
	<li class="list-group-item d-flex 
		justify-content-between align-items-center list-group-item-action 
		<?=($this->uri->segment(2)=='')? 'active':'bg-dark';?>">
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
	<?=($this->uri->segment(2)=='todo')? 'active':'bg-dark';?>">
		<i class="fas fa-exclamation-circle text-light lead"></i><a href="<?=base_url()?>user/todo">To Do</a>
		<span class="badge badge-danger badge-pill">
			<?=$this->MActivity->getTotalUserToDo()?>
		</span>
	</li>
</ul>
