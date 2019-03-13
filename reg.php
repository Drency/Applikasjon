<?php

require_once __DIR__ . "/include/header.php";
require_once __DIR__ . '/include/classes/check_user.class.php';
require_once __DIR__ . '/include/classes/warning.class.php';

$error = "";

if (isset($_POST['reg_user'])) {
    if (!isset($_POST['username'])) {
        echo Warning::danger("Manglende informasjon", "Brukernavn er ikke opplyst!")->display();
    } else {
        if (check_user::username_exists($_POST['username'])) {
            echo Warning::danger("Eksisterer allerede", "Brukernavn eksisterer allerede!")->display();
        } else {
            if (check_user::email_exists($_POST['email'] != $_POST['email'])) {
                echo Warning::danger("Eksisterer allerede", "E-posten eksisterer allerede!")->display();
            } else {
                $userdata = check_user::register(["username" => $_POST["username"],"email" => $_POST["email"], "passord" => $_POST["password"]]);
                echo Warning::success("Suksessfull registrering", "Velkommen {$_POST["username"]}!")->display();
                //header('location: login.php');
            }
        }
    }
}
?>

<form role="form" method="POST" action="">   
    <h2><strong>Registrer deg til New Home!</strong></h2>
    <div class="form-group">
        <label>Brukernavn</label>
        <input type="text" class="form-control col-xs-2 col-sm-2 col-md-2 col-lg-2" name="username" placeholder="Brukernavn">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control col-xs-2 col-sm-2 col-md-2 col-lg-2" name="email">
    </div>
    <div class="form-group">
        <label>Passord</label>
        <input type="text" class="form-control col-xs-2 col-sm-2 col-md-2 col-lg-2" name="password">
    </div>
    
    <div class="form-check">
        <button type="submit" class="btn btn-primary" name="reg_user">Registrer deg!</button>
    </div>

    <p>
        Allerede medlem? <a href="login.php">Logg inn!</a>
    </p>

    
</form>

<?php echo $error;

include_once __DIR__ . '/include/footer.php';
