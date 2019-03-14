<?php
session_start();

    //Requires
    require_once __DIR__ . "/include/header.php";
    require_once __DIR__ . '/include/classes/check_user.class.php';
    require_once __DIR__ . '/include/classes/warning.class.php';
    
if (isset($_POST['mname'])) {
    
    $mappenavn = $_POST['mname'];

    
    $query_get_bibId = "SELECT `bibId` FROM `bibliotek`, `brukere` WHERE brukere.brukernavn = :username AND brukere.id = bibliotek.bibId;";
    
    $db = Db::getPdo();
    
    $getBib = $db -> prepare($query_get_bibId);
    $getBib->execute([
        ":username" => $_SESSION['user']
    ]);
        
    $bibId = $getBib -> fetchColumn();

    

    $query_set_mappenavn = "INSERT INTO mapper(mappeNavn, bibID) VALUES(:mappenavn, 1);";
    
    $statement = $db->prepare($query_set_mappenavn);
    $statement->execute([
        ":mappenavn" => $mappenavn
        // ":bibId" => $bibId
    ]);
}

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
    
    $.ajax({
        type: "POST",
        url: 'index.php',
        data: {mname : mappenavn},
        success: function(mname)
        {
            console.log(mname);
            console.log(mappenavn);
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
<!-- Legger inn footer -->
<?php
include_once __DIR__ . '/include/footer.php';