<?php

include '../connection.php';

if (!isset($_SESSION)) session_start(); 

$search = $_POST['search'];

$html = '';
$query = "SELECT * FROM contacts WHERE name LIKE '%$search%' OR company LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%'";

$results = $conn->query($query);

if(!$search == '') { // if search query 's not empty then >>
  if($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
     $html .= '<tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['company'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['email'].'</td>
            <td><a href="edit-contact.php?id=<'.$row['id'].'&name='.$row['name'].'">Edit</a> | <a href="javascript:;" name="'.$row['name'].'" delete="'. $row['id'].'" >Delete</a></td>
           </tr>';
    }
  } else {
    $html = '<tr> <td class="text-center" colspan="5">No results.</td> </tr>';
  }
} else { // else select everything
  $user_id = $_SESSION['user_id'];
  $query = "SELECT * FROM contacts WHERE user_id = '$user_id' ";
  $results = $conn->query($query);

  if($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
      $html .= '<tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['company'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['email'].'</td>
            <td><a href="edit-contact.php?id=<'.$row['id'].'&name='.$row['name'].'">Edit</a> | <a href="javascript:;" name="'.$row['name'].'" delete="'. $row['id'].'" >Delete</a></td>
           </tr>';
    }
  }  else {
    $html = '<tr> <td class="text-center" colspan="5">No results.</td> </tr>';
  }
  
}

echo json_encode($html);

?>