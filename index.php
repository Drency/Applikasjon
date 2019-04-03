<?php
session_start();

//Requires
require_once __DIR__ . '/include/classes/db.class.php';
require_once __DIR__ . "/include/header.php";

    //MAPPER
// Innhenting av mappene til en bruker når siden blir lastet
$query_get_mapper = "SELECT m.mappeNavn, m.mapId FROM brukere b, bibliotek bib, mapper m WHERE b.brukernavn = :username AND bib.id = b.id AND bib.bibId = m.bibID";

$stmt = Db::getPdo()->prepare($query_get_mapper);

$stmt -> execute([
    ":username" => $_SESSION['user']
]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$linkResultat = "";



//Legge til en ny mappe, og legge den til på siden.
if (isset($_POST['data'])) {
    $mappeId = Mappe::add_mappe($_POST['data']);

    $response = array();

    if (is_int($mappeId) && mappeId > 0) {
        $response["mappeId"] = $mappeId;
    } else {
        $response["mappeId"] = -1;
    }
    echo json_encode($response);
}

//Sletting av mapper
if (isset($_GET['delMappe'])) {
    Mappe::del_mappe($_SESSION['user'], $_GET['folder']);
    header('location: index.php');
}


    //LINKER
// Sletting av linker fra en mappe
if (isset($_GET["delete"])) {
    if (Link::deleteLink($_SESSION['user'], $_GET["delete"])) {
        echo Warning::success("Link deleted", "You have successfully deleted the link.")->display();
    } else {
        echo Warning::danger("Deletion failed", "You do not have permissions to delete this link.")->display();
    }
}

// For å legge til nye linker inenfor en mappe
if (isset($_POST['nyLink']) && isset($_GET["folder"])) {
    $linknavn = $_POST['linknavn'];
    $url = $_POST['url'];
    $folder = $_GET["folder"];
 
    Mappe::addLink($folder, $linknavn, $url);
}

    //FILER
    //For å legge til nye filer
if (isset($_POST['nyFil']) && isset($_GET['folder'])) {
    $filename = $_POST['filNavn'];
    $folder = $_GET["folder"];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        echo Warning::danger("File er for stor", "Filen du prøvde å laste opp er for stor. Maks størrelse er 1 MB")->display();
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo Warning::danger("Det skjedde en feil", "Prøv igjen siden.")->display();
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo Warning::success("Fil lastet opp.", "Filen din har blitt lastet opp")->display();
        } else {
            echo Warning::danger("Opplasting feilet!", "Filen eksisterer allerede")->display();
        }
    }
    $folderLink = "uploads/$filename";
    Mappe::addFile($filename, $folder, $folderLink);
}

if (isset($_GET['delFil'])) {
    if (File::deleteFile($_SESSION['user'], $_GET['delFil'])) {
        $query_get_file_name  = "SELECT filNavn FROM filer WHERE filId = :filId";
        $get_file_name = Db::getPdo()->prepare($query_get_file_name);
        $get_file_name -> execute([":filId" => $_GET['delFil']]);
        $filename = $get_file_name->fetchColumn();

        $path = realpath('uploads/' . $filename);
        if (is_writable($path)) {
            echo Warning::success("Fil slettet", "Filen er slettet")->display();
        } else {
            echo Warning::danger("Sletting feilet", "Du har ikke tilgang til å slette denne filen.")->display();
        }
    }
}


    //BILDER

?>

    <!-- Container for main elements -->
<div class="container text-light" onload="lastInn()">
    <div class="row">
        <div class="col-4 text-center flex-column">
            <button class="btn btn-primary mt-2" onclick="nyMappe()">Ny mappe</button>
            <div id="btn-container">
            
            </div>
        </div>
        <!-- Om man han trykket på en mappe, vises innholdet i mappen -->
    <?php if (isset($_GET["folder"])) { ?>
        <div class="col-8" id="main">
            <div class="flex-box">
                <button class="btn btn-primary" onclick="nyLink()">Ny link</button>
                <button class="btn btn-primary" name="add_img" onclick="nyImg()">Nytt bilde</button>
                <button class="btn btn-primary" onclick="nyFil()">Ny fil</button>
                <a class="btn btn-danger ml-auto" href="<?php echo "?folder={$_GET['folder']}&delMappe=1"; ?>">Slett mappe</a>
                <form role="form" method="POST" id="linkForm" class="mt-2" style="display:none;">
                    <label>Legg til link : </label>
                    <input type="text" name="linknavn" placeholder="Navnet til linken">
                    <input type="link" name="url" placeholder="Link Url">
                    <button class="btn btn-primary" name="nyLink">Legg til link</button>
                </form>
                <form action="nicktare.php" method="POST" id="imgForm" class="mt-2" style="display:none;" enctype="multipart/form-data">
                    <label>Last opp bilde:</label>
                    <input type="file" name="file">
                    <input type="submit" class="btn btn-primary" name="submit" value="Last opp">
                </form>
                <form method="POST" id="fileForm" class="mt-2" style="display:none;" enctype="multipart/form-data">
                    <input type="text" name="filNavn" placeholder="Navnet til filen">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <button class="btn btn-primary" name="nyFil">Legg til fil</button>
                </form>
            </div>
            <div class="content" style="width:90%; margin-top:5%;">
            <hr style="background-color: #383838; padding: 2px;">
                <ul class='list-group' id="linkList">
                <!-- Legger til de forskjellige linkene fra databasen -->
                    <?php
                        $folder = $_GET["folder"];
                        $linkResult = array();
                        $linkResult = Mappe::getLinks($_GET["folder"]);
                    
                    foreach ($linkResult as $link) {
                        echo  "<li class='list-group-item list-group-item-primary d-flex justify-content-between align-items-center'><a href='{$link->getURL()}' target='_blank'>{$link->getName()}</a><span class='badge badge-danger badge-pill'><a class='text-light' href='?folder={$folder}&delete={$link->getId()}'>Delete</a></span></li>";
                    }
                    ?>
                </ul> 
                <hr style="background-color: #383838; padding: 2px;">
                <div class="img" style="color:black;">
                    <ul class='list-group' id="linkList">
                        <!-- <img style="100px"> -->
                </div>
                <hr style="background-color: #383838; padding: 2px;">
                <ul class='list-group' id="fileList">
                        <!-- Legger til filer fra databasen -->
                    <?php
                        $folder = $_GET['folder'];
                        $filResult = array();
                        $filResult = Mappe::getFile($folder);
                        
                    foreach ($filResult as $file) {
                        echo  "<li class='list-group-item list-group-item-primary d-flex justify-content-between align-items-center'><a>{$file->getName()}</a><span class='badge badge-danger badge-pill'><a class='text-light' href='?folder={$folder}&delFil={$file->getId()}'>Delete</a></span></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
    <?php } ?>

<script>
var slette = false;
var showLink = false;
var showImg = false;
var showFil = false;

    //Henter inn mapper som er i databasen
$(document).ready(function(){
    var jArray = <?php echo json_encode($result); ?>;

    for(var i=0; i<jArray.length; i++){

        var navn = jArray[i].mappeNavn;
        var button = document.createElement('a');
        button.innerHTML = navn;
        button.className += "btn btn-primary btn-block";
        button.setAttribute("id", jArray[i].mapId);
        button.setAttribute("href", "?folder=" + jArray[i].mapId);
        button.style ="margin-left: 10%; margin-top: 15%; width:60%;";
   
        document.getElementById("btn-container").appendChild(button);
    }
});

    // Ny mappe 
function nyMappe(){
    var mappenavn = prompt("Navnet til mappen: ");
    var mapId = -1;
    if(mappenavn.length < 2){
        alert("Oppgi mappenavn!");
    } else {
       $.ajax({
           type: "POST",
           url: "index.php",
           data: {data: mappenavn},
            success: function(result) {
                // Gyldig respons
                if (result.mappeId > 0) {
                    mapId = result.mappeId;
                }
           }
       });
    
        var button = document.createElement('a');
        button.innerHTML = mappenavn;
        button.setAttribute("id", mappenavn);
        button.setAttribute("href", "?folder=" + mapId);
        button.className += "btn btn-primary btn-block";
        button.style ="margin-left: 10%; margin-top: 15%; width:60%;";
   
        document.getElementById("btn-container").appendChild(button);
        location.reload();
    }  
}

function nyLink() {
    showLink =! showLink;
    if(showImg || showFil){
        document.getElementById('imgForm').style = "display:none;";
        document.getElementById('fileForm').style = "display: none;"
        showImg = false;
        showFil = false;
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
    if (showLink || showFil) {
        document.getElementById('linkForm').style="display:none;";
        document.getElementById('fileForm').style = "display:none";
        showLink = false;
        showFil = false;
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

function nyFil(){
    showFil =! showFil;
    console.log("nyFil");
    if(showImg || showLink){
        document.getElementById('imgForm').style = "display:none;";
        document.getElementById('linkForm').style = "display: none;"
        showImg = false;
        showLink = false;
        if(showFil){
            document.getElementById('fileForm').style="display:block;";
        } else {
            document.getElementById('fileForm').style="display:none;";
        }
    } else {
        if(showFil){
            document.getElementById('fileForm').style="display:block;";
        } else {
            document.getElementById('fileForm').style="display:none;";
        }
    }
}

</script>

    <!-- Legger inn footer -->
<?php
include_once __DIR__ . '/include/footer.php';