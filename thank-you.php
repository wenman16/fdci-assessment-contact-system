
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
  <?php include 'styles.php'; include 'inc/popup.php' ?>
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
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="app.js"></script>

</html>