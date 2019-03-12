<?php include('db.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
</head>

<body style="background-color:rgb(29, 28, 28)">
<!-- <script>
        function pass() {
            var x = document.getElementById("passID");
            if (x.type === "password") {
                x.type = "text";
            }
            else{
                x.type = "password";
            }

        }
    </script> -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-dark" style="background-color: #383838; color:white;">
        <a class="navbar-brand" href="index.php"><img src="img/FerdigLogo.png" alt="logo" style="height:100px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="use.php">Hjelp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">Om oss</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Logg inn</a>
                </li>
            </ul>

        </div>
    </nav>


    <form method="post" action="login.php" style="color: white; margin-left: 5%;">
        <h2><strong>Logg inn til New Home</strong></h2>
        <div class="form-group" action="innlogging.html">
            <label for="InputEmail">Brukernavn</label>
            <input type="text" class="form-control col-xs-2 col-sm-2 col-md-2 col-lg-2" name="username">
        </div>
        <div class="form-group">
            <label for="InputPassword">Passord</label>
            <input type="password" class="form-control col-xs-2 col-sm-2 col-md-2 col-lg-2" name="password" id="passID">
        </div>
        <div class="form-check">
            <button type="submit" class="btn btn-primary" name="login_user">Logg Inn</button>
            <input type="checkbox" onclick="passVis()">Vis passord
        </div>
        <p>
            Ikke medlem? <a href="reg.php">Registrer deg!</a>
        </p>
        <?php include('errors.php'); ?>
    </form>

    <script>
function passVis() {
  var y = document.getElementById("passID");
  if (y.type === "password") {
    y.type = "text";
    } else {
    y.type = "password";
  }
}
</script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

</body>

</html>