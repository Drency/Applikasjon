<?php 
    require_once __DIR__ . "/include/header.php";
    require_once __DIR__ . '/include/classes/check_user.class.php';
    require_once __DIR__ . '/include/classes/warning.class.php';

if (isset($_POST['login_user'])) {
    if (user_check::is_user($_POST['username']))
    {
        
    }
}
    
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
        var pass = document.getElementById("passID");
        if (pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    }
</script>

<?php
require_once __DIR__ . '/include/footer.php';