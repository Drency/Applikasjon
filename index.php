<?php

    //Setter inn header og footer fra header.php
    require_once 'classes/header.php';

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