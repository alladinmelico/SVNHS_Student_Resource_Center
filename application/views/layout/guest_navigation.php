<style>
    input {
      border-top-style: hidden;
      border-right-style: hidden;
      border-left-style: hidden;
      border-bottom-style: none;
      }
      .no-outline:focus {
      outline: none;
      }
</style>
<nav class="navbar bg-info">
	<a class="navbar-brand" href="<?=base_url()?>" onclick="openNav()">
		<img src="<?=base_url()?>logo_banner.png" alt="" height="70em">
	</a> 
	<div class="container-sm">
		<form class="form-inline mx-auto bg-light rounded-lg" method="GET" action="<?=base_url()?>search">
			<input class="no-outline bg-light rounded-left ml-1" name="term" type="text" placeholder="Search">
			<button class="btn rounded-right bg-light" type="submit"><i class="fas fa-search"></i></button>
		</form>
	</div>

	<div class="container-sm d-flex justify-content-end">
		<a type="button" href="<?=base_url()?>login" class="btn btn-light text-info"><i class="fas fa-user mr-2"></i>LOGIN</a>
	</div>
</nav>
