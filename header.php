<header class="d-flex justify-content-between container p-3">
  <h4>FDCI Assessment<h4>

  <div class="d-flex text-end justify-flex-end w-100 header-menu">
   <?php 
    if(isset($_SESSION['user_id'])) {
      
      echo '<a href="add-contacts.php" class=""  style="float: right;">Add Contacts</a> | <a href="contacts.php" class=""  style="float: right;">Contacts</a> | <a href="logout.php" class=""  style="float: right;">Logout</a>';
    } ?>
  </div>
  
</header>