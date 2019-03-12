<?php 
    include('db.php');
?>

<!DOCTYPE html>
<html lang="no">

<head>
    <title>New Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    
</head>

<body>
    <!-- Adding Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-dark" id="navbar">
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
    

    <!-- Heading for landingpage -->
    <h1 class="text-center" id="index-heading">New Home</h1>



    <div class="card-deck" id="bg-color">
        <div class="card" id="bg-color">
            <h5 class="card-title">Brukerveiledning</h5>
            <p class="card-text">Trykk på knappen under om du trenger hjelp til bruken av New Home.</p>
            <a href="use.html" class="btn btn-light">Brukerveiledning</a>
        </div>
        <div class="card" id="bg-color">
            <h5 class="card-title">Om Oss</h5>
            <p class="card-text">Om du vil lære mer om oss i New Home kan du trykke på knappen under.</p>
            <a href="about.html" class="btn btn-light">Brukerveiledning</a>
        </div>
        <div class="card" id="bg-color">
            <h5 class="card-title">Registrering / Logg inn</h5>
            <p class="card-text">Her kan du registrere deg som ny bruker eller logg inn hvis du er eksisterende bruker</p>
            <a href="login.php" class="btn btn-light">Brukerveiledning</a>
        </div>
    </div>
     <div style="height: 555px;" id="bg-color"></div>
    
    <!-- Footer -->
    <footer class="footer navbar-fixed-bottom" id="bg-color">
        <div class="footer-copyright text-center" style="color:white;">

            © 2018 Copyright:
            <p>Alle rettigheter tilhører New Home Inc.</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

</body>

</html>