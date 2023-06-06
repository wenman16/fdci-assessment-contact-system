<?php
if (!isset($_SESSION)) session_start();
include '../connection.php';

$message = ['type' => 'error', 'message' => 'Invalid Email or Password'];

$email = $_POST['email'];
$password = md5($_POST['password']);

$query = "SELECT * FROM users WHERE email ='$email' AND password = '$password' ";
$result = $conn->query($query);

if ($result->num_rows > 0) {

  $row = $result->fetch_assoc();
  $_SESSION['user_id'] = $row['id'];
  
  $message = [
    'redirect' => 'contacts.php'
  ];
} 


echo json_encode($message);
