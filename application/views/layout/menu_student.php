<ul class="menu">
    <li class="<?=($this->uri->segment(2)=='')? 'active':'';?>">
        <i class="fas fa-home text-light lead"></i>
        <div class="menu-item">
            <a href="<?=base_url('user')?>" id="home">Home</a>
        </div>
    </li>

    <li class="<?=($this->uri->segment(2)=='classes')? 'active':'';?>">
        <i class="fas fa-chalkboard"></i>
        <div class="menu-item">
            <a href="<?=base_url('user/classes')?>">Classes</a>
			<span class="badge" data-target="class-content"><?=$this->MClass->getTotalUserClass();?></span>
        </div>
	</li>

	<div class="menu-item-content" id="class-content">
		<?php
		$class = $this->MClass->getTotalUserClassName(); 
		foreach ($class as $row){
		?>
			<a href=""><?=$row['class_title']?></a>	
		<?php }?>
	</div>

    <li class="<?=($this->uri->segment(2)=='todo')? 'active':'';?>">
        <i class="fas fa-exclamation-circle"></i>
        <div class="menu-item">
            <a href="<?=base_url('user/todo')?>">To Do</a>
            <span class="badge" data-target="todo-content"><?=$this->MActivity->getTotalUserToDo()?></span>
        </div>
	</li>
	
	<div class="menu-item-content" id="todo-content">
		<?php
		$todo = $this->MActivity->getTotalUserToDoName(); 
		foreach ($todo as $row){
		?>
			<a href="<?=base_url('user/activity/')?><?=$row['idActivity']?>"><?=$row['activity_title']?></a>	
		<?php }?>
	</div>

	<li class="<?=($this->uri->segment(2)=='bookmark')? 'active':'';?>">
		<i class="fas fa-user"></i>
		<div class="menu-item">
			<a href="#">Profile</a>
			<i class="fa fa-arrow-down badge" data-target="profile-content"></i>
		</div>
	</li>

	<div class="menu-item-content" id="profile-content">
		<a href="<?=base_url('u/bookmark')?>">Bookmarks</a>
		<a href="<?=base_url()?><?=($this->session->has_userdata('idUser'))? 'user':'teacher'?>/logout">
			<span class="danger">Logout</span></a>
	</div>
</ul>
