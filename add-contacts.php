<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Contacts | FDCI Exam | Contact System</title>
  <?php if (!isset($_SESSION)) session_start(); include 'styles.php'; include 'inc/popup.php' ?>
</head>
<body>
<?php include 'header.php'; ?>
<div class="wrapper container">
  <div id="formContent" class="p-2">

    <div class="">
      <h1>Add Contacts</h1>
    </div>

    <form class="px-3">
      <input type="text" class="w-100" name="name" placeholder="Name">
      <input type="text" class="w-100" name="company" placeholder="Company">
      <input type="text" class="w-100" name="phone" placeholder="Phone">
      <input type="email" class="w-100" name="email" placeholder="Email">
   
      <input type="submit" class="mb-3" value="Submit">
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
      
      do_ajax('inc/contacts.php', 'POST', {
        name: name,
        email: email,
        phone: phone,
        company: company,
        type: 'new',
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
