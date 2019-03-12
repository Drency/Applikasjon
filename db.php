<?php
session_start();


// initializing variables
$username = "";
$email    = "";
$password = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'app');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Skriv inn brukernavn"); }
  if (empty($email)) { array_push($errors, "Skriv inn mail"); }
  if (empty($password)) { array_push($errors, "Skriv inn passord"); }
  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM brukere WHERE brukernavn='$username' OR Email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['brukernavn'] === $username) {
      array_push($errors, "Brukernavnet er allerede tatt.");
    }

    if ($user['Email'] === $email) {
      array_push($errors, "Emailen er allerede registrert");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password);//encrypt the password before saving in the database
    $query = "INSERT INTO brukere (brukernavn, Email, Passord) 
              VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "Du er logget inn!";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Skriv inn brukernavn");
  }
  if (empty($password)) {
  	array_push($errors, "Skriv inn passord");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    
  	$query = "SELECT * FROM brukere WHERE brukernavn='$username' AND Passord='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Du er nå logget inn";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Feil brukernavn/passord kombinasjon");
  	}
  }
}

//AJAX 
if (isset($_POST['name'])){
  $mappenavn = mysqli_real_escape_string($db, $_POST['name']);

  $getbibID = "SELECT bibID 
  FROM bibliotek AS bib, brukere AS b 
  WHERE b.BrukerNavn = 'a' AND b.PersonID = bib.PersonID;"; 

  $query_getBibId = mysqli_real_escape_string($db, $getbibID);
  
  if (!$result = mysqli_query($db, $query_getBibId)) {
    die(json_encode(["status" => "failure", "name" => $mappenavn, "error" => $db->error, "query" => $query_getBibId]));
  }
  
  if ($result->num_rows >= 1)
  {
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

?>