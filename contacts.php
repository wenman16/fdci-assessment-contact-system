<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts | FDCI Exam | Contact System</title>
  <?php if (!isset($_SESSION)) session_start(); include 'styles.php'; include 'inc/popup.php'; include 'connection.php'; ?>
</head>
<body>

<?php if(!isset($_SESSION['user_id'])) {
  echo '<script>location.href="index.php"</script>';
} ?>

<?php include 'header.php'; ?>

<div class="wrapper container">

  <div class="d-flex text-end justify-content-end w-100">
    <input type="search" class="form-control-sm form-control w-25" placeholder="Search">
  </div>
    
  <table class="table  table-striped table-hover">
    <thead>

      <th>Name</th>
      <th>Company</th>
      <th>Phone</th>
      <th>Email</th>
      <th></th> 

    </thead>

    <tbody>

    <?php 

      $user_id = $_SESSION['user_id'];
      $query = "SELECT * FROM contacts WHERE user_id = '$user_id' ";
      $result = $conn->query($query);
      if($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            ?>
            <tr id="<?php echo $row['id']; ?>">
              <td><?php echo $row['name'] ?></td>
              <td><?php echo $row['company'] == '' ? 'No data' :  $row['company'];?></td>
              <td><?php echo $row['phone'] == '' ? 'No data' :  $row['phone'];?></td>
              <td><?php echo $row['email'] == '' ? 'No data' :  $row['email']; ?></td>
              <td><a href="edit-contact.php?id=<?php echo $row['id'] ?>&name=<?php echo $row['name'] ?>">Edit</a> | <a href="javascript:;" name="<?php echo $row['name'] ?>" delete="<?php echo $row['id']; ?>" >Delete</a></td>
            </tr>
            <?php
        }
        
      
      } else {
       echo '<tr> <td class="text-center" colspan="5">You don\'t have any contacts yet.</td> </tr>';
      }
      
    ?>
      
    </tbody>
    
  </table>

</div>


</body>
<?php include 'scripts.php'; ?>

<script>
   $(document).ready(function() {

    $(document).on('click', '[delete]', function() {
      console.log('hello');
      let contact_id = $(this).attr('delete');
      let name = $(this).attr('name');
      
      let popup = $('.popup');
      popup.find('h3').html(`Are you sure you want to DELETE? <br>Contact Name: ${name}`);
      popup.find('button').remove();

      popup.find('h3').append(`<br><button class="btn btn-warning btn-sm" id="cancel-delete">NO</button> | <button confirm_delete="${contact_id}" class="btn btn-sm btn-danger">YES</button>`);
      popup.fadeIn();
      
    })

    $(document).on('click', '[confirm_delete]', function() {
      let contact_id = $(this).attr('confirm_delete');

      do_ajax('inc/contacts.php', 'POST', {
          contact_id: contact_id,
          type: 'delete',
        }, (result) => {
          console.log(result);

          let popup = $('.popup');
          popup.find('h3').html(result.message);
          popup.find('h3').append(`<br><button id="popup-btn" class="btn btn-warning btn-sm">${result.button}</button>`);
         
          $('.popup').fadeIn('slow', () => {
            $(`tr[id="${contact_id}"`).fadeOut('slow', () => {
              $(`tr[id="${contact_id}"`).remove();
            })
          });
          
      })
      
    })
    
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

    $(document).on('keyup', 'input[type="search"]', function() {
      // console.log($(this).val());
      let search = $(this).val();

      do_ajax('inc/search.php', 'POST', {
        search: search
      }, (result) => {
        // console.log(result);
        $('tbody *').fadeOut('slow', () => {
          $('tbody *').remove();
          $('tbody').append(result);
        })
      });
      
    });

  });
</script>

</html>
