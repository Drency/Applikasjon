<?php include('db.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
</head>
<body style="background-color:rgb(29, 28, 28)">
<nav class="navbar navbar-expand-lg navbar-light navbar-dark" style="background-color: #383838; color:white;">
        <a class="navbar-brand" href="index.html"><img src="img/FerdigLogo.png" alt="logo" style="height:100px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="use.html">Hjelp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">Om oss</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Logg inn</a>
                </li>
            </ul>

        </div>
    </nav>
	 
  <form method="post" action="login.php" style="color: white;">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="reg.php">Sign up</a>
  	</p>
  </form>
</body>
</html>