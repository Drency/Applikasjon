<?php
require_once '/../classes/db.class.php';

if (isset($_POST['name'])){
    
    $statement = Db::getPdo()->prepare("
        SELECT bibID 
        FROM bibliotek AS bib, brukere AS b 
        WHERE b.BrukerNavn = :username AND b.PersonID = bib.PersonID
    ");
    
    $statement->execute([":username" => $_POST['name']]);

    if ($statement->rowCount())
    {

    }


    $mappenavn = mysqli_real_escape_string($db, $_POST['name']);

  $getbibID = "SELECT bibID 
  FROM bibliotek AS bib, brukere AS b 
  WHERE b.BrukerNavn = 'a' AND b.PersonID = bib.PersonID;"; 

  $query_getBibId = mysqli_real_escape_string($db, $getbibID);
  
  if (!$result = mysqli_query($db, $query_getBibId)) {
    die(json_encode(["status" => "failure", "name" => $mappenavn, "error" => $db->error, "query" => $query_getBibId]));
  }
  
  if ($result->num_rows >= 1){
    $result = $result->fetch_object();

    $id = $result->bibId;
  
    $nyMappe = "INSERT INTO mapper(MappeNavn, bibID)
      VALUES('$mappenavn', '1');";

    if (!mysqli_query($db, $nyMappe)) {
      die(json_encode(["status" => "failure", "name" => $nyMappe]));
      //echo $db->error;
    } else {
      die(json_encode(["status" => "success", "name" => 'null']));
    }
  } else {
    // Bruker eksisterer ikke eller kunne ikke finnes
    die(json_encode(["status" => "success", "name" => $mappenavn]));
  }
  
}