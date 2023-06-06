
<?php 
if (!isset($_SESSION)) session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You | FDCI Exam | Contact System</title>
  <?php include 'styles.php'; ?>
</head>
<body>

<div class="wrapper container">
  <div id="formContent" class="p-2">

    <h3>Thank You for registering.</h3>
    <h4>Welcome <?php echo $_SESSION['name']?>!</h4>
    <a href="contacts.php" class="btn btn-sm btn-primary">Continue</a>
  </div>
</div>

</body>

</html>