<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'classes/db.class.php';
require_once 'classes/check_user.class.php';
require_once 'classes/warning.class.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/../css/style.css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    
</head>


<body style="background-color:rgb(29, 28, 28);color:white;">
    <nav class="navbar navbar-expand-lg navbar-light navbar-dark" style="background-color: #383838; color:white;">
        <a class="navbar-brand" href="landingpage.php"><img src="img/FerdigLogo.png" alt="logo" style="height:100px;"></a>
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
                <?php if (isset($_SESSION['user'])) : ?>
                    <a class="nav-link text-danger" href="logout.php" style="text-decoration:none" name="logout">Logg ut</a>
                <?php else : ?>
                    <a class="nav-link" href="login.php" style="text-decoration:none">Logg inn</a>
                <?php endif; ?>
                </li>
            </ul>

        </div>
    </nav>



