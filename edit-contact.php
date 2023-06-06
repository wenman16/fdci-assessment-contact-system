<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Contacts | FDCI Exam | Contact System</title>
  <?php if (!isset($_SESSION)) session_start(); include 'styles.php'; include 'inc/popup.php'; include 'connection.php' ?>
</head>
<body>
<?php include 'header.php'; ?>
<div class="wrapper container">
  <div id="formContent" class="p-2">

    <div class="">
      <h1>Update Contact</h1>
      <small>You're editing the contact name: <?php echo $_GET['name'] ?></small>
    </div>

    <?php
      $contact_id = $_GET['id'];
      $query = "SELECT * FROM contacts WHERE id = '$contact_id' ";
      $result = $conn->query($query);

      if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $company = $row['company'];
        $phone = $row['phone'];
        $email = $row['email'];
      } else {
        echo '<script>location.href="index.php"</script>';
      }
      
    ?>

    <form class="px-3">
      <input type="hidden" class="w-100" name="id" placeholder="Name" value="<?php echo $_GET['id'] ?>">
      <input type="text" class="w-100" name="name" placeholder="Name" value="<?php echo $_GET['name'] ?>">
      <input type="text" class="w-100" name="company" placeholder="Company" value="<?php echo $company ?? null ?>">
      <input type="text" class="w-100" name="phone" placeholder="Phone"  value="<?php echo $phone ?? null ?>">
      <input type="email" class="w-100" name="email" placeholder="Email"  value="<?php echo $email ?? null ?>">
   
      <input type="submit" class="mb-3" value="Update Contact">
    </form>

  </div>
</div>


</body>
<?php include 'scripts.php'; ?>
<script>

 $(document).ready(function() {
  $('form').submit(function(e) {
    e.preventDefault();

    
    var name = $('[name="name"]').val();
    if(name == '') {
      alert('The name field is required.')
    } else {
     
      let email = $('[name="email"]').val();
      let company = $('[name="company"]').val();
      let phone = $('[name="phone"]').val();
      let contact_id = $('[name="id"]').val();
      
      do_ajax('inc/contacts.php', 'POST', {
        name: name,
        email: email,
        phone: phone,
        company: company,
        contact_id: contact_id,
        type: 'update',
      }, (result) => {
        console.log(result);

        if(result.redirect) {
          location.href=result.redirect
        } else {
          let popup = $('.popup');
          popup.find('h3').text(result.message);
          popup.find('button').text(result.button);
        }
        
        
        $('.popup').fadeIn('slow');
        
      })
    }
    
  });
 });
  
</script>

</html>
