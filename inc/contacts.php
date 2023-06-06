<?php

include '../connection.php';

if (!isset($_SESSION)) session_start(); 

$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$phone = $_POST['phone'] ?? null;
$company = $_POST['company'] ?? null;

$type = $_POST['type'];
$contact_id = $_POST['contact_id'] ?? null;

$message = [];
$user_id = $_SESSION['user_id'];

if($type == 'new') {
  $query = "INSERT INTO contacts (name, email, company, phone, user_id) VALUES('$name', '$email', '$company', '$phone', '$user_id') ";
  if($conn->query($query) === TRUE) {
    $message = [
      'redirect' => 'contacts.php'
    ];
  }
} elseif($type == 'update') {

  $query = "UPDATE contacts SET name = '$name', company = '$company', phone = '$phone' WHERE id = '$contact_id'";
  if($conn->query($query) === TRUE) {
    $message = [
      'message' => 'The contact has been updated successfully!',
      'button' => 'Continue',
      'redirect' => 'contacts.php'
    ];
  }
  
} else {
  $query = "DELETE FROM contacts WHERE id = '$contact_id' ";
  if($conn->query($query) === TRUE) {
    $message = [
      'message' => 'The contact has been deleted successfully!',
      'button' => 'Continue',
    ];
  }
  
}


echo json_encode($message);
