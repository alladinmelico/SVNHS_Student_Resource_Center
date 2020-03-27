<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fail</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container border rounded-lg text-center mt-5 shadow py-5 px-5">
		<h1 class="display-3">Oops!</h1>
		<h2 class="display-4">the email address can't be verified or already been verified, kindly check your email inbox for the verification.</h2>
		<a href="<?=base_url()?>" type="button" class="btn btn-lg bg-info mt-5 text-light">Continue as guest</a><br>
		<a href="<?=base_url('login')?>" type="button" class="btn btn-lg bg-success mt-5 text-light">Login</a>
	</div>
	
</body>
</html>
