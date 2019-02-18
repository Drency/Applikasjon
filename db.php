<?php
session_start();

// initializing variables
$password = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'app');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fnavn = mysqli_real_escape_string($db, $_POST['fornavn']);
  $enavn = mysqli_real_escape_string($db, $POST_['etternavn']
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($email)) { array_push($errors, "Skriv inn din mail"); }
  if (empty($password)) { array_push($errors, "Skriv inn ditt passord"); }
  if (empty($fnavn)) { array_push($errors, "Trenger fornavn"); }
  if (empty($enavn)) { array_push($errors, "Skriv inn etternavn"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Velg et annet brukernavn");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email er allerede registrert");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO brukere (Email, Password) 
  			  VALUES('$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Du er nå logget inn";
  	header('location: index.php');
  }
}
