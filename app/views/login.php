<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.80.0">
	<title>Signin</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">

	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">


	<!-- Custom styles for this template -->
	<link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
	<form method="post" action="" class="form-signin">

		<?php
		if (isset($message))
			echo "<span style='color: red;'>" . $message . "</span>";
		?>

		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
		<label for="email" class="sr-only">Email address</label>
		<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
		<label for="password" class="sr-only">Password</label>
		<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
		<div class="checkbox mb-3">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
	</form>
</body>

</html>