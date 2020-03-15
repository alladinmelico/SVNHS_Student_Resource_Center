<!doctype html>
<html lang="en">
  <head>
    <title><?php echo $title;?></title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <link href="<?= base_url()?>css/all.css" rel="stylesheet">
    <script defer src="<?= base_url()?>js/all.js"></script>
    <link href="<?= base_url()?>css/solid.css" rel="stylesheet">
    <script defer src="<?= base_url()?>js/solid.js"></script>
    <link rel="stylesheet" href="<?= base_url()?>css/custom.css">
  </head>
  <body class="bg-dark text-center">
      <div class="container mt-5 text-dark" style="width: 25rem;">
      <div class="card text-left">
        <img class="card-img-top "alt="" >
        <div class="card-body">
          <h4 class="card-title text-dark">Registration Form</h4>
          <?php
            echo form_open("user/register");
            $data = array('name'=>'email',
                            'type' => 'email',
                            'id'=>'email',
                            'size'=>25,
                            'class'=>'form-control');
            echo form_label('Email');
            echo form_input($data);

            $data = array('name'=>'first_name',
                            'type' => 'text',
                            'id'=>'first_name',
                            'size'=>25,
                            'class'=>'form-control');
            echo form_label('First Name');
            echo form_input($data);

            $data = array('name'=>'last_name',
                            'type' => 'text',
                            'id'=>'last_name',
                            'size'=>25,
                            'class'=>'form-control');
            echo form_label('Last Name');
						echo form_input($data);
						
						echo form_label('Register as:');
						echo '<br><div class="custom-control custom-radio custom-control-inline ml-5">';
							echo form_radio(array(
													'value'=>'student',
													'id'=>'radioStudent',
													'name'=>'role',
													'class'=>'custom-control-input',
													'required'=>'required'));
							echo form_label('Student','radioStudent',array('class'=>'custom-control-label'));
						echo '</div>';

						echo '<div class="custom-control custom-radio custom-control-inline mx-auto">';
							echo form_radio(array(
													'value'=>'teacher',
													'id'=>'radioTeacher',
													'name'=>'role',
													'class'=>'custom-control-input',
													'required'=>'required'));
							echo form_label('Teacher','radioTeacher',array('class'=>'custom-control-label  mb-3'));
						echo '</div><br>';
						
						$data = array('name'=>'username',
                            'type' => 'text',
                            'id'=>'username',
                            'size'=>25,
                            'class'=>'form-control');
            echo form_label('Username');
						echo form_input($data);

            $data = array('name'=>'password',
                            'type' => 'password',
                            'id'=>'password',
                            'size'=>25,
                            'class'=>'form-control');
            echo form_label('Password');
            echo form_input($data);

            $data = array('name'=>'password_confirm',
                            'type' => 'password',
                            'id'=>'password_confirm',
                            'size'=>25,
                            'class'=>'form-control');
            echo form_label('Confirm Password');
						echo form_input($data);
						
					

            $data = array('name'=>'login',
                            'type' => 'submit',
                            'id'=>'',
                            'value'=>'Register',
                            'class'=>'btn btn-success btn-lg mt-5 btn-block');
            echo form_submit($data);
            echo form_close();
            ?>
        </div>
				<a href="<?= base_url();?>login" class="text-center text-success mb-3">LOG IN</a>
      </div>
          
      </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
