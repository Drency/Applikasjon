<?php
session_start();

    //Requires
    require_once __DIR__ . '/include/classes/db.class.php';
    require_once __DIR__ . "/include/header.php";
    require_once __DIR__ . '/include/classes/check_user.class.php';
    require_once __DIR__ . '/include/classes/warning.class.php';
    require_once __DIR__ . '/include/classes/mappe.class.php';
    // require_once __DIR__ . '/include/upload.php';
    
    
    
if (isset($_POST['sendLink'])) {
    $linknavn = $_POST['linknavn'];
    $linkUrl = $_POST['linkUrl'];
        
    $query_get_mapId = "SELECT mapId FROM brukere, bibliotek, mapper WHERE brukere.brukernavn = :username AND bibliotek.id = brukere.id AND bibliotek.bibId = mapper.bibID";
    
    $db = Db::getPdo();
    $get_mapId = $db->prepare($query_get_mapId);
    $get_mapId->execute([
        ":username" => $_SESSION['user']
    ]);
    $resultat_mapId = $get_mapId->fetchColumn();
        
    $query_insert_link = "INSERT INTO links(linkNavn, linkUrl, mapId) VALUES (:linknavn, :linkUrl, :mapId);";
    $inser_link = $db->prepare($query_insert_link);
    $inser_link->execute([
        "linknavn" => $linknavn,
        ":linkUrl" => $linkUrl,
        ":mapId" => $resultat_mapId
    ]);
}

    
if (isset($_POST['data'])) {
    echo $_POST['data'];
    Mappe::add_mappe($_POST['data']);
}

?>


    <!-- Container for main elements -->
<div class="container text-light">
    <div class="row">
        <div class="col-4 text-center flex-column">
            <button class="btn btn-primary mt-2" onclick="nyMappe()">Ny mappe</button>
            <div id="btn-container"></div>
        </div>
        <div class="col-8">
            <div class="flex-box">
                <form class="mt-2">
                    <label>Legg til link : </label>
                    <input type="text" name="linknavn" placeholder="Navnet til linken">
                    <input type="link" class="" name="linkUrl" placeholder="Bilde URL">
                    <button type="submit" class="btn btn-primary" name="sendLink">Send</button>
                </form>
                <form action="" class="mt-2">
                    <label>Last opp bilde:</label>
                    <input type="file" name="photoimg" id="photoimg">
                    <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
                </form>
            </div>
            <ul>
                <!-- Her skal linker, filer og bilder legges -->
            </ul> 
        </div>
    </div>
</div>

<!-- <?php
if (isset($_POST['data'])) {
    ?>
    <p>data value: <?php echo $_POST['data'] ?>.</p>
<?php } else { ?>
    <p> data not set </p>
<?php } ?> -->

<!--    
<script> console.log("<?php echo $query_insert_link ?>")</script>
<script> console.log("<?php echo $query_get_mapId ?>")</script> -->

<script>
function nyMappe(){
    var mappenavn = prompt("Navnet til mappen: ");
    
    if(mappenavn.length < 2){
        alert("Oppgi mappenavn!");
    } else {
       $.ajax({
           type: "POST",
           url: "index.php",
           data: {data: mappenavn},
           success: function(data)
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

        document.getElementById("btn-container").appendChild(button);

    }  
}
</script>
<!-- Legger inn footer -->
<?php
include_once __DIR__ . '/include/footer.php';