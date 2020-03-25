<?php include('layout/head.php');?>
  <body class="bg-dark">
      <div class="container mt-5 text-dark" style="width: 25rem;">
      <div class="card text-left winter-neva-gradient">
        <img class="card-img-top "alt="" >
        <div class="card-body">

					<?=form_open('login')?>

					<div class="btn-group btn-group-toggle container" data-toggle="buttons">
						<label class="btn btn-info form-check-label">
							<input class="form-check-input" type="radio" name="role" id="option2" autocomplete="off" value="student" required>
							<i class="fas fa-user prefix mr-2"></i>
							Student
						</label>
						<label class="btn btn-info form-check-label">
							<input class="form-check-input" type="radio" name="role" id="option3" autocomplete="off" value="teacher" required>
								<i class="fas fa-user-tie prefix mr-2"></i>
								Teacher
						</label>
					</div>

					<div class="md-form md-outline form-lg">
						<i class="fas fa-user prefix"></i>
						<input name="username" type="text" id="inputIconEx2" class="form-control form-control-lg">
						<label for="inputIconEx2" class="bg-none">Username</label>
					</div>

					<div class="md-form md-outline form-lg">
						<i class="fas fa-lock prefix"></i>
						<input name="password" type="password" id="password" class="form-control">
						<label for="password">Password</label>
					</div>
					<div class="text-right mb-4">
						<a href="<?=base_url('user/forgotPassword')?>">forgot password?</a>
					</div>

					<button type="submit" class="btn btn-info btn-lg btn-block rounded-pill">LOG IN</button>

					<?=form_close()?>

          <p class="text-center mt-5">OR</p>
            <div id="my-signin2" class="d-flex justify-content-center mb-3"></div>
            <script>
              function onSuccess(googleUser) {
                console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
              }
              function onFailure(error) {
                console.log(error);
              }
              function renderButton() {
                gapi.signin2.render('my-signin2', {
                  'scope': 'profile email',
                  'width': 240,
                  'height': 50,
                  'longtitle': true,
                  'theme': 'dark',
                  'onsuccess': onSuccess,
                  'onfailure': onFailure
                });
              }
            </script>

            <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
          
            <p class="text-center mt-5">Don't have an Account? <a href="<?= base_url()?>register">Sign-up</a></p>
						<p class="d-flex justify-content-end text-muted">Continue as Guest<a href="<?=base_url()?>" ><i class="fas fa-arrow-right ml-2"></i></a></p>
        </div>
      </div>
          
      </div>
    
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
