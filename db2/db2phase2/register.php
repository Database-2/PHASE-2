<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
body{ font: 14px sans-serif; }
	.wrapper{ width: 350px; padding: 20px; }
</style>
</head>
<body>	

<div class="wrapper">
<h2>Sign Up</h2>
<p>Please fill this form to create an account.</p>

<form action="signup.php" method="POST">
	<input type="text" name="username" placeholder="Username"><br>
	<input type="text" name="email" placeholder="Email"><br>
	<input type="password" name="pwd" placeholder="Password"><br>
	<input type="text" name="location" placeholder="City, State"><br> 
	<button type="submit"> SIGN UP</button>
</form>
</div>
</body>
</html>
