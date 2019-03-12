<?php
    include('db.php');


  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

  $query = "SELECT MappeNavn FROM bibliotek, mapper WHERE '$username' = brukere.PersonID AND brukere.PersonID = bibliotek.PersonID AND bibliotek.PersonID = bibliotek.bibID AND bibliotek.bibID = mapper.MappeNavn";
  $resultat = mysqli_query($db, $query);

  $ant = "SELECT COUNT(mapper.mapID) FROM mapper WHERE '$username' = brukere.PersonID AND brukere.PersonID = bibliotek.PersonID AND bibliotek.PersonID = bibliotek.bibID AND bibliotek.bibID = mapper.bibID";

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
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
                    <a class="nav-link" href="index.php?logout='1'" style="color: red;">Logg ut</a>
                </li>
            </ul>

        </div>
    </nav>

    <!-- Container for main elements -->
    <div class="container" style="color:white;">
        <div class="row">
            <div id="leftside" class="col-4 text-center flex-column" style="background-color: white;">
                

                <button class="btn btn-primary" style="margin-top:2%;" onclick="nyMappe()">Ny mappe</button>
                <div id="btn-container"></div>
            </div>
            <div class="col-8" style="background-color: red;">
            
            </div>

        </div>
    </div>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
    function nyMappe(){
        var mappenavn = prompt("Navnet til mappen: ");

        $.ajax({
        type: 'POST', 
        url: 'db.php',
        data: mappenavn,
        success: function(data, textStatus, jqXHR)
        {
        console.log(data);
        }
        });

        var button = document.createElement('button');
        button.innerHTML = mappenavn;
        button.className += "btn btn-primary";
        button.style ="margin-left: 10%; margin-top: 15%;";

       /* button.onclick = function(){
            
        }*/

        // var div = document.getElementById("leftside");
        document.getElementById("btn-container").appendChild(button);
        
    }

    </script>

</body>

</html>