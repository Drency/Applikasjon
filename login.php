<?php 
    require_once __DIR__ . '/include/header.php';
    require_once __DIR__ . '/include/footer.php';  
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

</body>

</html>