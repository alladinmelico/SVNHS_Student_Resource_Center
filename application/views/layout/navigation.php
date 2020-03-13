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
	padding: 8px 8px 8px 32px;
	text-decoration: none;
	font-size: 25px;
	color: #818181;
	display: block;
	transition: 0.3s;
	}

	.sidenav a:hover {
	color: #f1f1f1;
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

	@media screen and (max-height: 450px) {
	.sidenav {padding-top: 15px;}
	.sidenav a {font-size: 18px;}
	}
</style>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="<?=base_url()?>file">Files</a>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="#" onclick="openNav()">
		<i class="fas fa-bars"></i>
	</a>
	<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
		aria-expanded="false" aria-label="Toggle navigation"></button>

	<div class="collapse navbar-collapse" id="collapsibleNavId">
		<form class="form-inline ml-auto my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="text" placeholder="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
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
