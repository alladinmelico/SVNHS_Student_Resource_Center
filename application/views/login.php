<?php include('layout/head.php');?>
  <body id="login">
      <div class="card-login">
		  <form action="<?=base_url('login')?>" method="POST">
			<div class="radio-custom">
				<input type="radio" name="role" id="student"  value="student" required>
				<label for="student"><i class="fas fa-user"></i>Student</label> 
				<input type="radio" name="role" id="teacher"  value="teacher" required>
				<label for="teacher"><i class="fas fa-user-tie"></i>Teacher</label> 
			</div>
			
			<?=form_error('password','<div class="error">', '</div>'); ?>
			<div class="inline-input">
				<i class="fas fa-user"></i>
				<label for="inputIconEx2">Username</label>
				<input name="username" type="text" class="<?=(validation_errors())? 'is-invalid':''?>" required>
			</div>

			<div class="inline-input">
				<i class="fas fa-lock"></i>
				<label for="password">Password</label>
				<input name="password" type="password" id="password" class="<?=(validation_errors())? 'is-invalid':''?>" required>
			</div>

			<div class="text-right">
				<a href="<?=base_url('user/forgotPassword')?>">forgot password?</a>
			</div>

			<button type="submit">LOG IN</button>

			</form>
		
			<p>Don't have an Account? <a href="<?= base_url()?>register">Sign-up</a></p>
			<div  class="text-right">
				<a href="<?=base_url()?>">Continue as Guest<i class="fas fa-arrow-right"></i></a>
			</div>
        </div>
      </div>
	</body>
</html>
