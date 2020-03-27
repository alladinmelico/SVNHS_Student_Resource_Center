<style>
	body {
	font-family: "Lato", sans-serif;
	transition: background-color .5s;
	}

	.sidenav {
	height: 100%;
	width: 0;
	position: fixed;
	z-index: 1;
	top: 0;
	left: 0;
	background-color: #111;
	overflow-x: hidden;
	transition: 0.5s;
	padding-top: 60px;
	}

	.sidenav a {
	padding: 8px 8px 8px 10px;
	text-decoration: none;
	font-size: 25px;
	color: white;
	display: block;
	transition: 0.3s;
	}


	.sidenav .closebtn {
	position: absolute;
	top: 0;
	right: 25px;
	font-size: 36px;
	margin-left: 50px;
	}

	#main {
	/* transition: margin-left .5s; */
	padding: 16px;
	}

	#logout{
		position: absolute;
		bottom: 5px;
	}

	@media screen and (max-height: 450px) {
	.sidenav {padding-top: 15px;}
	.sidenav a {font-size: 18px;}
	}

	input {
      border-top-style: hidden;
      border-right-style: hidden;
      border-left-style: hidden;
      border-bottom-style: none;
      }
      .no-outline:focus {
      outline: none;
      }

	  .custom-gradient,.blue-gradient{
		background: rgb(0,93,124);
		background: linear-gradient(13deg, rgba(0,93,124,1) 0%, rgba(51,181,229,1) 100%);
	  }
</style>

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

<nav class="navbar navbar-expand-lg navbar-dark custom-gradient">
	<a class="navbar-brand" href="#" onclick="openNav()">
		<i class="fas fa-bars mr-5"></i>
	</a>
	<a class="navbar-brand" href="<?=base_url()?><?=($this->session->has_userdata('idUser'))? 'user':'teacher'?>" >
		<img src="<?=base_url()?>logo_banner.png" alt="" height="70em">
	</a>
 
	<div class="container">
		<form class="form-inline mx-auto bg-light rounded-lg" method="GET" action="<?=base_url()?>search">
			<input class="no-outline bg-light rounded-left ml-1" name="term" type="text" placeholder="Search">
			<button class="btn btn-info waves-effect btn-pill" type="submit"><i class="fas fa-search fa-lg"></i></button>
		</form>
	</div>

	<!-- <div class="dropdown open">
		<button class="btn bg-none" 
		type="button" id="triggerId" data-toggle="dropdown" 
		aria-haspopup="true"aria-expanded="false">
		<span class="position-absolute rounded-pill bg-danger text-white pl-1 pr-1">2</span>
				<i class="fas fa-bell text-white h1 p-1"></i>
		</button>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
				<a class="dropdown-item text-dark" 
				href="<?=base_url()?>user/logout">
				</a>
		</div>
	</div> -->

	<div class="dropdown open">
		<button class="btn btn-outline-light dropdown-toggle" 
		type="button" id="triggerId" data-toggle="dropdown" 
		aria-haspopup="true"aria-expanded="false">
		<?=$this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>
		<i class="fas fa-user ml-2"></i>
		</button>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
			<a class="dropdown-item text-danger" 
				href="<?=base_url()?><?=($this->session->has_userdata('idUser'))? 'user':'teacher'?>/logout">Logout</a>
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
