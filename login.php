<?php 
    require_once __DIR__ . '/include/header.php';
    
?>

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

<?php
require_once __DIR__ . '/include/footer.php';