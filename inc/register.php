<?php

include '../connection.php';

if (!isset($_SESSION)) session_start(); 

$message = ['type' => 'error', 'message' => 'Passwords do not match.'];

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// make sure that the email's unique
// then confirm passwords
$query = "SELECT * FROM users WHERE email ='$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  $message = [
    'type' => 'error',
    'message' => 'The email is already registered.',
    'button' => 'Try Again',
  ];
} else {

  if($password === $confirm_password) {
    $hashed_password = md5($password);
    $query = "INSERT INTO users (name, email, password) VALUES('$name', '$email', '$hashed_password') ";
    if($conn->query($query) === TRUE) {

      $_SESSION['user_id'] = $conn->insert_id;
      $_SESSION['name'] = $name;
      
      $message = [
        'redirect' => 'thank-you.php'
      ];
    }
  }

}

echo json_encode($message);
