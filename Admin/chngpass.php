
<?php
include('../connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.css">
    <link rel="stylesheet" href="../src/css/login.css">
    <title>Admin</title>
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../src/pictures/navbar.png" alt="" width="150" height="45" class="d-inline-block align-text-center">
      Login
    </a>
  </div>
</nav>

<div class="form-container container-lg mt-0 d-flex flex-column justify-content-center align-items-center text-center">
    <form action="" method="POST" class="login-form">
        <span class="form-header">
            <h1 class="header-text bg-dark display-6">Change Pass</h5>
        </span>
        <span class="input-boxes">
            <input type="password" class="form-control" name="new-password" placeholder="New Password" required >
            <input type="password" class="form-control"  name="Re_password" placeholder="Re-type Password" required>
            <input type="submit" name="change" value="Confirm" style="background-color: #1b1d1c;">
        </span>
    </form>
</div>
    
</body>
</html>

<?php

   

    if(isset($_POST['change'])){
       $new_password = $_POST['new-password'];
       $re_password = $_POST['Re_password']; 
      

       if($new_password == $re_password){
        $new_password = password_hash($new_password,PASSWORD_DEFAULT);
            $update_query = "UPDATE `admin` SET `password` = '$new_password' WHERE id = '1'";
            $result = mysqli_query($conn,$update_query);
            header ("location: login.php");
            
            
            
       }

       else {
           echo("Password does not match");
       }

    }
?>