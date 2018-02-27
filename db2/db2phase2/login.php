<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign In</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
body{ font: 14px sans-serif; }
	.wrapper{ width: 350px; padding: 20px; }
</style>
</head>
<body>	

<div class="wrapper">
<h2>Sign In</h2>
<p>Please fill this form to create an account.</p>

<form action="signin.php" method="POST">
	<input type="text" name="username" placeholder="Username"><br>
	<input type="password" name="pwd" placeholder="Password"><br>
   
    <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Login">
    </div>
    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
</form>
</div>
</body>
</html>