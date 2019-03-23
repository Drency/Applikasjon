<?php
session_start();

    //Requires
    require_once __DIR__ . '/include/classes/db.class.php';
    require_once __DIR__ . "/include/header.php";
    require_once __DIR__ . '/include/classes/check_user.class.php';
    require_once __DIR__ . '/include/classes/warning.class.php';
    require_once __DIR__ . '/include/classes/mappe.class.php';
    // require_once __DIR__ . '/include/upload.php';

// Innhenting av mappene til en bruker
$query_get_mapId = "SELECT mappeNavn FROM brukere, bibliotek, mapper WHERE brukere.brukernavn = :username AND bibliotek.id = brukere.id AND bibliotek.bibId = mapper.bibID";

$stmt = Db::getPdo()->prepare($query_get_mapId);

$stmt -> execute([
    ":username" => $_SESSION['user']
]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
if (isset($_POST['data'])) {
    Mappe::add_mappe($_POST['data']);
}

if (isset($_POST['mappename'])) {
    Mappe::del_mappe($_POST['mappename']);
}

if (isset($_POST['mappeVar'])) {
    if (isset($_POST['sendLink'])) {
        Mappe::addLink($_POST['mappeVar'], $_POST['linknavn'], $_POST['linkUrl']);
    }
}

?>

<div class='alert alert-danger' role='alert' style="display:none;" id="sletteMelding">
    <h4 class='alert-heading'>Sletting av mappe</h4>
    <p>Trykk på en mappe for å slette den</p>
</div>

    <!-- Container for main elements -->
<div class="container text-light" onload="lastInn()">
    <div class="row">
        <div class="col-4 text-center flex-column">
            <button class="btn btn-primary mt-2" onclick="nyMappe()">Ny mappe</button>
            <button class="btn btn-danger mt-2" onclick="slettMappe()">Slett mappe</button>
            <div id="btn-container">
            
            </div>
        </div>
        <div class="col-8" id="main" style="display:none;">
            <div class="flex-box">
                <form class="mt-2">
                    <label>Legg til link : </label>
                    <input type="text" name="linknavn" placeholder="Navnet til linken">
                    <input type="link" name="linkUrl" placeholder="Link Url">
                    <button type="submit" class="btn btn-primary" name="sendLink">Legg til</button>
                </form>
                <form action="" class="mt-2">
                    <label>Last opp bilde:</label>
                    <input type="file" name="photoimg" id="photoimg">
                    <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
                </form>
            </div>
            <div class="content" style="width:600px; height:600px; background-color:white; margin-top:5%;">
                <ul id="linkList">
                    <!-- Her skal linker, filer og bilder legges -->
                    <li><a style="color:black;">Test link</a></li>
                    <li><a style="color:black;">Test link2</a></li>
                </ul> 
                <hr style="background-color:blue; padding: 2px;">
                <div class="img" style="color:black; height:100px;">
                    <!-- <img style="100px"> -->
                </div>
                <hr style="background-color:blue; padding: 2px;">
                <ul>
                    <li style="color:black;">Fil 1</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
var myBoolean = false;

$(document).ready(function(){
    
    var jArray = <?php echo json_encode($result); ?>;

    for(var i=0; i<jArray.length; i++){

        var navn = jArray[i].mappeNavn;
        var button = document.createElement('button');
        button.innerHTML = navn;
        button.className += "btn btn-primary btn-block";
        button.style ="margin-left: 10%; margin-top: 15%; width:60%;";
   
        button.onclick = function(){
            if (myBoolean){
                var name = this.innerHTML;
                $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: {mappename: name},
                });
                location.reload();
            } else {
                document.getElementById("main").style = "display:block;";
                var mapName = this.innerHTML;
                $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: {mappeVar: mapName}
                });
            }
        }
        document.getElementById("btn-container").appendChild(button);
    }
});

function nyMappe(){
    var mappenavn = prompt("Navnet til mappen: ");
    
    if(mappenavn.length < 2){
        alert("Oppgi mappenavn!");
    } else {
       $.ajax({
           type: "POST",
           url: "index.php",
           data: {data: mappenavn},
       });
    
        var button = document.createElement('button');
        button.innerHTML = mappenavn;
        button.className += "btn btn-primary btn-block";
        button.style ="margin-left: 10%; margin-top: 15%; width:60%;";
   
        button.onclick = function(){
            if (myBoolean){
                var name = this.innerHTML;
                console.log(name);
                $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: {mappename: name},
                });
                location.reload();
            } else {
                document.getElementById("main").style = "display:block;";
            }
        }

        document.getElementById("btn-container").appendChild(button);

    }  
}

function slettMappe(){
    myBoolean = ! myBoolean;
    if(myBoolean){
        document.getElementById("sletteMelding").style = "display:block;";

    } else {
        document.getElementById("sletteMelding").style = "display:none;";
    }
}

</script>
<!-- Legger inn footer -->
<?php
include_once __DIR__ . '/include/footer.php';