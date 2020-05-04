<div id="sidenav" class="sidenav">
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

</nav>

<script>
function openNav() {
  document.getElementById("sidenav").classList.toggle('sidenav-active');
}

function closeNav() {
  document.getElementById("sidenav").classList.toggle('sidenav-active');
}
</script>
