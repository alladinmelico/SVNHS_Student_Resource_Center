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
<nav class="navbar blue-gradient">
	<a class="navbar-brand" href="<?=base_url('admin/dashboard')?>" >
		<img src="<?=base_url()?>logo_banner.png" alt="" height="70em">
	</a>
	<div class="d-flex justify-content-end">
		<a type="button" href="<?=base_url('user/logout')?>" 
		class="btn btn-light text-info"><i class="fas fa-user mr-2"></i>LOG OUT</a>
	</div>
</nav>
