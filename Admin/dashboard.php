<?php
session_start();
include('../connection.php');
include('../session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Welcome</title>
</head>
<body>
    <a href ="register.php">Register</a>
    <a href ="logout.php">Logout</a>



    <table>
  
  <thead>
      <tr>
      <th>No.</th>
      <th>Picture</th>
      <th>Employee ID</th>
      <th>Name</th>
      <th>Action</th>
      
      </tr>
     
  </thead>
  <tbody>
  <?php

      $sql = "SELECT * FROM employees ORDER BY id DESC ";
      $run = mysqli_query($conn,$sql);

       if(mysqli_num_rows($run) > 0){
          $count = 0;
          foreach($run as $row){
            $eid = $row['employee_id'];
            
          // Store the cipher method
          $ciphering = "AES-128-CTR";
          $iv_length = openssl_cipher_iv_length($ciphering);
          $options = 0;

          // Non-NULL Initialization Vector for encryption
          $encryption_iv = '1234567891011121';

          // Store the encryption key
          $encryption_key = "TeamAgnat";

          // Use openssl_encrypt() function to encrypt the data
          $encryption = openssl_encrypt($eid, $ciphering,
                      $encryption_key, $options, $encryption_iv);
          //   $encrypted_data = (($lrn*12345678911*56789)/987654);
            $edit_link = "edit.php?eid=" . $encryption;
            $delete_link = "delete.php?eid=" . $encryption;
            $view_link = "view-employee.php?profile=" . $encryption;
              $count++;

 
      ?>
      <tr class="clickable-row" data-href="<?php echo $view_link ?>" style="cursor:pointer;">
            <td><?php echo $count;?></td>
            <td>
              <?php echo '<img src="employee_pictures/'.$row['picture'].'" width="100px"; height:"100px;"' ?>
          </td>
         
          <td><?php echo $row['employee_id']?></td>
          <td><?php echo $row['first_name']." ".$row['last_name'] ?> </td>
          <td>
           
         
          <a href="<?php echo $edit_link ?>">edit</a>
          <a href="<?php echo $delete_link ?>">Delete</a>
          </td>
      </tr>
      <?php
          }
      }
      ?>

  </tbody>


  </table>

  <script src="../src/js/table.click.js"></script>




</body>
</html>
