<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //Setter inn header og footer fra header.php
    require_once 'classes/header.php';


/* Slette?
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
 */
?>


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


    
<script>
function nyMappe(){
    var mappenavn = prompt("Navnet til mappen: ");
    
    alert(mappenavn);
    $.ajax({
    type: 'POST', 
    url: 'db.php',
    data: { success: "true", name: mappenavn },
    dataType: 'json',
    success: function(name){
        console.log("Success: " + mappenavn);
        alert("Name: " + name.name + ", status: " + name.status + "\nError: " + name.error + "\nQuery:\n" + name.query);
        console.log(name.query);
    },
    error: function(jqxhr, status, exception) {
         alert("Exception: " + exception + ", status: " + status + "\nJqhxr: " + jqxhr.mappenavn);
     }
    });
    
    var button = document.createElement('button');
    button.innerHTML = mappenavn;
    button.className += "btn btn-primary";
    button.style ="margin-left: 10%; margin-top: 15%;";
   
   /* button.onclick = function(){
        
    }*/
    document.getElementById("btn-container").appendChild(button);
    
}
</script>