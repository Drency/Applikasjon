<?php 
    require_once __DIR__ . "/include/header.php";
    require_once __DIR__ . "/include/classes/check_user.class.php";



   /* if(check_user::username_exists($_POST["username"] != $_POST["username"])){
        $error = "Brukernavnet eksisterer allerede";
        die();
    }else{
        if(check_user::email_exists($_POST['email'] != $_POST['username'])){
            $error = "Email er allerede registrert";
            die();
        }else{
            $userdata = check_user::register(["username" => $_POST["username"],"email" => $_POST["email"], "passord" => $_POST["password"]]);
            if($id > 0){
                header('location: login.php');
            }
        }
    }*/

?>

<form role="form" method="POST" action="">   
    <h2><strong>Registrer deg til New Home!</strong></h2>
    <div class="form-group">
        <label>Brukernavn</label>
        <input type="text" class="form-control col-xs-2 col-sm-2 col-md-2 col-lg-2" name="username" value="">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control col-xs-2 col-sm-2 col-md-2 col-lg-2" name="email" >
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

    <p class="text-center" syle="color: red;">
        <?php echo $message?>
    </p>
</form>
