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
     <link rel="stylesheet" href="../src/css/bootstrap.css">
     <link rel="stylesheet" href="../src/css/bootstrap.min.css">
     <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
      <link rel="stylesheet" href="assets/css/Fixed-navbar-starting-with-transparency-1.css">
      <link rel="stylesheet" href="assets/css/Fixed-navbar-starting-with-transparency.css">
      <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
      <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
      <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
      <link rel="stylesheet" href="assets/css/styles.css">
      <link rel="stylesheet" href="src/css/table.data.css">
    <title>Welcome</title>
</head>

<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="../src/pictures/navbar.png" alt="" width="150" height="45" class="d-inline-block align-text-left">

    </a>

    
  </div>
</nav>

    

    <div class="container mt-5">
  <div class="table-responsive">
    <table class="table table-dark table-hover align-middle mb-0 ">
  
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
            $edit_link = "edit-employee.php?eid=" . $encryption;
            $delete_link = "delete-employee.php?eid=" . $encryption;
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
           
         
          <a href="<?php echo $edit_link ?>"> Edit<i style="color:#56BBF1; font-size:25px;" class="fa-solid fa-pen-to-square"></i></a>
          <a href="<?php echo $delete_link ?>">Delete</a>
          </td>
      </tr>
      <?php
          }
      }
      ?>

  </tbody>


  </table>
  </div>
    </div>
  <script src ="../src/js/jquery-3.6.1.min.js"></script>

  <script src="../src/js/table.click.js"></script>




</body>
</html>
