<ul class="menu">
    <li class="<?=($this->uri->segment(1)=='teacher' && $this->uri->segment(2)=='')? 'active':'';?>">
        <i class="fa fa-home text-light"></i>
        <div class="menu-item">
            <a href="<?=base_url('teacher')?>" id="home">Home</a>
        </div>
    </li>

    <li class="<?=($this->uri->segment(1)=='classes')? 'active':'';?>">
        <i class="fas fa-chalkboard"></i>
        <div class="menu-item">
            <a href="<?=base_url('classes')?>">Classes</a>
			<span class="badge" data-target="class-content"><?=$this->MClass->getTotalTeacherClass();?></span>
        </div>
	</li>

	<div class="menu-item-content" id="class-content">
		<?php
			$class = $this->MClass->getAllTeacherClasses();
			foreach ($class as $row){
		?>
			<a href="<?=base_url('classes/'.$row['idClass'])?>"><?=$row['class_title']?></a>	
		<?php }?>
	</div>

    <li class="<?=($this->uri->segment(1)=='activity' && $this->uri->segment(2)=='' )? 'active':'';?>">
		<i class="fa fa-clipboard-check"></i>
        <div class="menu-item">
            <a href="<?=base_url('activity')?>">Activity</a>
            <span class="badge" data-target="todo-content"><?=$this->MActivity->getTotalTeacherActivities();?></span>
        </div>
	</li>
	
	<div class="menu-item-content" id="todo-content">
		<?php
		$todo = $this->MActivity->getAllTeacherActivities(); 
		foreach ($todo as $row){
		?>
			<a href="<?=base_url('activity/')?><?=$row['idActivity']?>"><?=$row['activity_title']?></a>	
		<?php }?>
	</div>

	<li class="<?=($this->uri->segment(2)=='unchecked' || $this->uri->segment(2)=='check')? 'active':'';?>">
		<i class="fa fa-exclamation-circle"></i>
		<div class="menu-item">
			<a href="<?=base_url('activity/unchecked')?>">Unchecked</a>
			<span class="badge" data-target="unchecked-content"> <?=$this->MActivity->getTotalTeacherUnchecked();?></span>
		</div>
	</li>

	<div class="menu-item-content" id="unchecked-content">
		<?php
		$check = $this->MActivity->getTeacherUnchecked(); 
		foreach ($check as $row){
		?>
			<a href="<?=base_url('teacher/check/'.$row['idActivity'].'/'.$row['idUser'])?>"><?=$row['activity_title']?></a>	
		<?php }?>
	</div>
	<li><a href="<?=base_url()?><?=($this->session->has_userdata('idUser'))? 'user':'teacher'?>/logout">
		<span class="danger">Logout</span></a>
	</li>
</ul>

