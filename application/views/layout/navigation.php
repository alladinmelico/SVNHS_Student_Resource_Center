<div id="mySidenav" class="sidenav bg-dark">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <?php
	if($this->session->has_userdata('idUser')){
		$this->load->view('layout/menu_student');
	} elseif($this->session->has_userdata('idTeacher')){
		$this->load->view('layout/menu_teacher');
	} else{
		$message_403 = "You don't have access to the url you where trying to reach.";
show_error($message_403 , 403 );
	}
  ?>
</div>

<nav>
	<div class="burger-logo">
		<a class="burger" href="#" onclick="openNav()">
			<i class="fas fa-bars"></i>
		</a>
		<a class="logo" href="<?=base_url()?>">
			<picture>
				<source media="(min-width: 768px)" srcset="<?=base_url()?>logo_banner.png">
				<img src="<?=base_url()?>logo.png" alt="" height="50em">
			</picture>
		</a>
	</div>

	<form class="search" method="GET" action="<?=base_url()?>search">
		<input class="search-input" name="term" type="text" placeholder="Search" required>
		<button class="search-button" type="submit"><i class="fas fa-search"></i></button>
	</form>

	<div class="profile">
		<button class="profile-button">
			<?=$this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>
			<i class="fas fa-user ml-2"></i>
		</button>
		<div class="profile-content">
			<a href="<?=base_url('u/bookmark')?>">Bookmark</a>
			<a href="<?=base_url()?><?=($this->session->has_userdata('idUser'))? 'user':'teacher'?>/logout">Logout</a>
		</div>
	</div>
</nav>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
