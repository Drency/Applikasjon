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
$query_get_mapper = "SELECT mappeNavn FROM brukere, bibliotek, mapper WHERE brukere.brukernavn = :username AND bibliotek.id = brukere.id AND bibliotek.bibId = mapper.bibID";

$stmt = Db::getPdo()->prepare($query_get_mapper);

$stmt -> execute([
    ":username" => $_SESSION['user']
]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$linkResultat = "";



//Klasse kall
if (isset($_POST['data'])) {
    Mappe::add_mappe($_POST['data']);
}

if (isset($_POST['slettenavn'])) {
    Mappe::del_mappe($_POST['slettenavn']);
}

//Innhenting av linker til en mappe
if (isset($_POST['folder_name'])) {
    $linkResultat = Mappe::getLinks('Testmappe');
}

if (isset($_POST['nyLink'])) {
    $linknavn = $_POST['linknavn'];
    $url = $_POST['url'];

    Mappe::addLink('Testmappe', $linknavn, $url);
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
                <button class="btn btn-primary" onclick="nyLink()">Ny link</button>
                <button class="btn btn-primary" name="add_img" onclick="nyImg()">Nytt bilde</button>
                <form role="form" method="POST" id="linkForm" class="mt-2" style="display:none;">
                    <label>Legg til link : </label>
                    <input type="text" name="linknavn" placeholder="Navnet til linken">
                    <input type="link" name="url" placeholder="Link Url">
                    <button class="btn btn-primary" name="nyLink" onclick="addLink()">Legg til link</button>
                </form>
                <form method="POST" id="imgForm" class="mt-2" style="display:none;">
                    <label>Last opp bilde:</label>
                    <input type="file" name="photoimg" id="photoimg">
                    <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
                </form>
            </div>
            <div class="content" style="width:600px; height:600px; margin-top:5%;">
                <ul id="linkList">
                    <!-- Her skal linker, filer og bilder legges -->
                </ul> 
                <hr style="background-color:blue; padding: 2px;">
                <div class="img" style="color:black; height:100px;">
                    <!-- <img style="100px"> -->
                </div>
                <hr style="background-color:blue; padding: 2px;">
                <ul>
                    <!-- <li style="color:black;">Fil 1</li> -->
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
var slette = false;
var showLink = false;
var showImg = false;
var folder_name = "";

    //Henter inn mapper som er i databasen
$(document).ready(function(){
    var jArray = <?php echo json_encode($result); ?>;

    for(var i=0; i<jArray.length; i++){

        var navn = jArray[i].mappeNavn;
        var button = document.createElement('button');
        button.innerHTML = navn;
        button.className += "btn btn-primary btn-block";
        button.setAttribute("id", navn);
        button.style ="margin-left: 10%; margin-top: 15%; width:60%;";
   
        //Funksjonene som eksisterende mapper skal ha
        button.onclick = function(){
            if (slette){
                var name = this.innerHTML;
                $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: {slettenavn: name}
                });
                location.reload();
            } else {
                emptyLinks();
                folder_name = this.innerHTML;
                var mappenavn = this.innerHTML;
                getLinks(mappenavn);
                document.getElementById("main").style = "display:block;";
            }
        }
        document.getElementById("btn-container").appendChild(button);
    }
});

    // Ny mappe 
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
        button.setAttribute("id", mappenavn);
        button.className += "btn btn-primary btn-block";
        button.style ="margin-left: 10%; margin-top: 15%; width:60%;";

            //Funksjonene som nye mapper skal ha
        button.onclick = function(){
            if (slette){
                var name = this.innerHTML;
                console.log(name);
                $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: {slettenavn: name},
                });
                location.reload();
            } else {
                emptyLinks();
                var mappenavn = this.innerHTML;
                getLinks(mappenavn);
                document.getElementById("main").style = "display:block;";
            }
        }
        document.getElementById("btn-container").appendChild(button);
    }  
}

function slettMappe(){
    slette = ! slette;
    if(slette){
        document.getElementById("sletteMelding").style = "display:block;";

    } else {
        document.getElementById("sletteMelding").style = "display:none;";
    }
}

function nyLink() {
    showLink =! showLink;
    if(showImg){
        document.getElementById('imgForm').style = "display:none;";
        showImg = false;
        if(showLink){
            document.getElementById('linkForm').style="display:block;";
        } else {
            document.getElementById('linkForm').style="display:none;";
        }
    } else {
        if(showLink){
            document.getElementById('linkForm').style="display:block;";
        } else {
            document.getElementById('linkForm').style="display:none;";
        }
    }
}

function nyImg() {
    showImg =! showImg;
    if (showLink) {
        document.getElementById('linkForm').style="display:none;";
        showLink = false;
        if(showImg) {
            document.getElementById('imgForm').style = "display:block;";
        } else {
            document.getElementById('imgForm').style = "display:none;";
        }
    } else {
        if(showImg) {
            document.getElementById('imgForm').style = "display:block;";
        } else {
            document.getElementById('imgForm').style = "display:none;";
        }
    }   
}

function addLinks() {
    $.ajax({
        type: "POST",
        url: "index.php",
        data: {add_link : folder_name},
        dataType:'json',
        success: function(data){
            console.log(folder_name);
        }
    });

}

function emptyLinks(){
    $('#linkList').empty();
}

function getLinks(mappenavn){
    $.ajax({
        type: "POST",
        url: "index.php",
        data: {folderName : mappenavn},
        success: function(data){
            console.log(mappenavn);
        }
    });
    var linkArray = <?php echo json_encode($linkResultat); ?>;
    for (var y=0; y<linkArray.length; y++){
        var linkNavn = linkArray[y].linkNavn;
        var linkUrl = linkArray[y].linkUrl;
        var link = document.createElement('li');
        var ref = document.createElement('a');
        ref.setAttribute("href", linkUrl);
        link.appendChild(ref);
        link.innerHTML = linkNavn;
        link.style ="text-decoration:none; color:black;"
        document.getElementById("linkList").appendChild(link);
    }
}

</script>

    <!-- Legger inn footer -->
<?php
include_once __DIR__ . '/include/footer.php';