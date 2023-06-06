<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | FDCI Exam | Contact System</title>
  <?php include 'styles.php'; include 'inc/popup.php'; include 'connection.php';  ?>
</head>
<body>
<?php include 'header.php'; ?>
<div class="wrapper container">
  <div id="formContent" class="p-2">

    <div class="">
      <h1>Sign In</h1>
    </div>

    <form>
      <input type="text" id="login" class="" name="email" placeholder="login">
      <input type="password" id="password" class="" name="password" placeholder="password">
      <input type="submit" class="mb-3" value="Log In">
      <a class="d-block" href="/register.php">Register</a>
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
          let email = $('[name="email"]').val();
          let password = $('[name="password"]').val();
          
          do_ajax('inc/login.php', 'POST', {
            email: email,
            password: password,
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
