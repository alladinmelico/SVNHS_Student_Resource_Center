<?php include('layout/head.php');?>
<style>
	.error {
    font-size: small;
    color: red;
    text-align: center;
}
</style>
  <body class="bg-dark text-center">
      <div class="col-3 mx-auto mt-5 text-dark card">

				<h4 class="card-title h4 mb-4 text-dark display-4">Sign up</h4>

						<form class="text-center px-3 py-2 " action="<?=base_url('guest/register')?>" method="POST" accept-charset="utf-8">
						<div class="container-fluid btn-group btn-group-toggle " data-toggle="buttons">
							<label class="btn btn-info form-check-label bg-dark">
								<input class="form-check-input " type="radio" name="role" id="option2" autocomplete="off" value="student" required>
								<i class="fas fa-user prefix mr-2"></i>
								Student
							</label>
							<label class="btn btn-info form-check-label">
								<input class="form-check-input" type="radio" name="role" id="option3" autocomplete="off" value="teacher" required>
									<i class="fas fa-user-tie prefix mr-2"></i>
									Teacher
							</label>
						</div>
						<div class="form-row mb-4 ">
								<div class="col">
									<div class="md-form md-outline form">
										<input name="first_name" type="text" 
										id="defaultRegisterFormFirstName" class="form-control" 
										value="<?=set_value('first_name');?>">
										<label for="inputIconEx2" class="bg-none">First Name</label>
									</div>
								</div>
								<div class="col">
									<div class="md-form md-outline form">
										<input name="last_name" type="text" 
										id="defaultRegisterFormLastName" class="form-control" 
										value="<?=set_value('last_name');?>">
										<label for="inputIconEx2" class="bg-none">Last Name</label>
									</div>
								</div>
						</div>

						<?=form_error('email','<div class="error">', '</div>'); ?>
						<div class="md-form md-outline form">
							<input name="email" type="email" id="defaultRegisterFormEmail" 
							class="form-control mb-4" value="<?=set_value('email');?>">
							<label for="inputIconEx2" class="bg-none">Email</label>
						</div>

						<?=form_error('username','<div class="error">', '</div>'); ?>
						<div class="md-form md-outline form">
							<input name="username" type="text" class="form-control mb-4" value="<?=set_value('username');?>">
							<label for="inputIconEx2" class="bg-none">Username</label>
						</div>

						<?=form_error('password','<div class="error">', '</div>'); ?>
						<div class="md-form md-outline form">
							<input name="password" type="password" id="defaultRegisterFormPassword" class="form-control mb-2" 
							aria-describedby="defaultRegisterFormPasswordHelpBlock" value="<?=set_value('password');?>">
							<label for="inputIconEx2" class="bg-none">Password</label>
						</div>

						<?=form_error('passconf','<div class="error">', '</div>'); ?>
						<div class="md-form md-outline form">
							<input name="passconf" type="password" id="defaultRegisterFormPassword" class="form-control mb-5" 
							aria-describedby="defaultRegisterFormPasswordHelpBlock" value="<?=set_value('password');?>">
							<label for="inputIconEx2" class="bg-none">Confirm Password</label>
						</div>
			
						<button class="btn btn-info my-4 btn-block" type="submit">Sign in</button>

						<hr>

						<p>By clicking
								<em>Sign up</em> you agree to our
								<a href="" target="_blank">terms of service</a>
						</p>

								<a href="<?= base_url();?>login" class="d-flex justify-content-start text-success mb-3"><i class="fas fa-angle-left fa-lg mr-2"></i>LOG IN</a>
						</form>
        </div>
    
  </body>
</html>
