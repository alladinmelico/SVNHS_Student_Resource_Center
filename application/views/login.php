
<!doctype html>
<html lang="en">
  <head>
    <title><?= $title;?></title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-signin-client_id" 
    content="293153048084-oh88r7c3hf34sp3q3vlkbb43p8m4j7tn.apps.googleusercontent.com">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
		

    <link href="<?= base_url()?>css/all.css" rel="stylesheet">
    <script defer src="<?= base_url()?>js/all.js"></script>
    <link href="<?= base_url()?>css/solid.css" rel="stylesheet">
    <script defer src="<?= base_url()?>js/solid.js"></script>
    <link rel="stylesheet" href="<?= base_url()?>css/custom.css">
  </head>
  <body class="bg-dark">
      <div class="container mt-5 text-dark" style="width: 25rem;">
      <div class="card text-left">
        <img class="card-img-top "alt="" >
        <div class="card-body">
          <?php
						echo form_open("login");
						
						echo form_label('Login as:');
						echo '<br><div class="custom-control custom-radio custom-control-inline ml-4 h5">';
							echo form_radio(array(
													'value'=>'student',
													'id'=>'radioStudent',
													'name'=>'role',
													'class'=>'custom-control-input',
													'required'=>'required'));
							echo form_label('<i class="fas fa-user"></i><span class="text-muted ml-2">Student</span>',
							'radioStudent',array('class'=>'custom-control-label'));
						echo '</div>';

						echo '<div class="custom-control custom-radio custom-control-inline h5">';
							echo form_radio(array(
													'value'=>'teacher',
													'id'=>'radioTeacher',
													'name'=>'role',
													'class'=>'custom-control-input',
													'required'=>'required'));
							echo form_label('<i class="fas fa-user-tie "></i><span class="text-muted ml-2">Teacher</span>',
							'radioTeacher',array('class'=>'custom-control-label  mb-3'));
						echo '</div><br>';

            $data = array('name'=>'username',
                            'type' => 'text',
                            'id'=>'username',
                            'size'=>25,
														'class'=>'form-control mb-3',
														'required'=>'required');
            echo form_label('Username');
            echo form_input($data);

            $data = array('name'=>'password',
                            'type' => 'password',
                            'id'=>'password',
                            'size'=>25,
														'class'=>'form-control mb-5',
														'required'=>'required');
            echo form_label('Password');
            echo form_input($data);

            echo anchor('user/forgotPassword','forgot password?<br>');
            $data = array('name'=>'login',
                            'type' => 'submit',
                            'id'=>'',
                            'value'=>'Login',
                            'class'=>'btn btn-success btn-lg btn-block');
						echo form_submit($data);
						
            echo form_close();
            
          ?>
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
