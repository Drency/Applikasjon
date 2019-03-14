<?php
session_start();
    //Setter inn header
    require_once __DIR__ . "/include/header.php";
    require_once __DIR__ . '/include/classes/check_user.class.php';
    require_once __DIR__ . '/include/classes/warning.class.php';

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
    


    var button = document.createElement('button');
    button.innerHTML = mappenavn;
    button.className += "btn btn-primary";
    button.style ="margin-left: 10%; margin-top: 15%;";
   
   /* button.onclick = function(){
        
    }*/

    document.getElementById("btn-container").appendChild(button);
    
}
</script>

<!-- Legger inn footer -->
<?php
include_once __DIR__ . '/include/footer.php';