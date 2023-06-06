<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | FDCI Exam | Contact System</title>
  <?php include 'styles.php'; include 'inc/popup.php' ?>
</head>
<body>
<?php include 'header.php'; ?>
<div class="wrapper container">
  <div id="formContent" class="p-2">

    <div class="">
      <h1>Register</h1>
    </div>

    <form class="px-3">
    <input type="text" id="login" class="w-100" name="name" placeholder="Name">
    <input type="email" id="login" class="w-100" name="email" placeholder="Email">
    <div class="d-flex justify-content-between">
    <input type="password" id="password" class="w-50" name="password" placeholder="Password">
    <input type="password" id="password" class="w-50 me-0" name="confirm_password" placeholder="Confirm Password">
    </div>
      <input type="submit" class="mb-3" value="Register">
      <a class="d-block" href="/index.php">Already registered? Login</a>
    </form>

  </div>
</div>


</body>
<?php include 'scripts.php'; ?>
<script>

 $(document).ready(function() {
  $('form').submit(function(e) {
    e.preventDefault();

    let isEmpty = false; 
    $('input').each(function() {
        if ($(this).val() === '') {
            isEmpty = true;
            return false; 
        }
    });
    
    if(isEmpty) {
      alert('Please fill in all fields.')
    } else {
      let name = $('[name="name"]').val();
      let email = $('[name="email"]').val();
      let password = $('[name="password"]').val();
      let confirm_password = $('[name="confirm_password"]').val();
      
      do_ajax('inc/register.php', 'POST', {
        name: name,
        email: email,
        password: password,
        confirm_password: confirm_password
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
