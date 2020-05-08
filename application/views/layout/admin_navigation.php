<style>
	#log-out{
		color: white;
		padding: 1rem;
	}
</style>
<nav>
	<div class="burger-logo">
		<a class="logo" href="<?=base_url()?>">
			<picture>
				<source media="(min-width: 768px)" srcset="<?=base_url()?>logo_banner.png">
				<img src="<?=base_url()?>logo.png" alt="" height="50em">
			</picture>
		</a>
	</div>

	<a href="<?=base_url('user/logout')?>" id="log-out"><i class="fas fa-user"></i>LOG OUT</a>

</nav>
