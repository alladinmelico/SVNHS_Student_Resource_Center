<nav>
	<a class="logo" href="<?=base_url()?>" onclick="openNav()">
		<picture>
			<source media="(min-width: 768px)" srcset="<?=base_url()?>logo_banner.png">
			<img src="<?=base_url()?>logo.png" alt="" height="50em">
		</picture>
	</a> 

	<form class="search" method="GET" action="<?=base_url()?>search">
		<input class="search-input" name="term" type="text" placeholder="Search" required>
		<button class="search-button" type="submit"><i class="fas fa-search"></i></button>
	</form>

	<a type="button" href="<?=base_url('login')?>" class="login"><i class="fas fa-user" style="margin-right: 0.5rem"></i></a>
</nav>
