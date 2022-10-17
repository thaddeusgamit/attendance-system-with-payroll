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
    <title>Login</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../src/pictures/navbar.png" alt="" width="150" height="45" class="d-inline-block align-text-center">
      
    </a>
  </div>
</nav>

<div class="form-container container-lg mt-0 d-flex flex-column justify-content-center align-items-center text-center">
    <form action="" method="POST" class="login-form">
        <span class="form-header">
            <h1 class="header-text bg-dark display-6">Login</h5>
        </span>
        <span class="input-boxes">
            <input type="text" class="form-control" name="username" placeholder="USERNAME" required >
            <input type="password" class="form-control" name="password" placeholder="PASSWORD" required>
            <input type="submit" name="login" value="Login" style="background-color: #1b1d1c;">
        </span>
    </form>
</div>
</body>
</html>


<?php
if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

$query="SELECT username, password FROM admin WHERE username = '$username'";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
         $hashed_password = $row['password'];

          $admin_pass = password_verify($password,$hashed_password);
      print_r($admin_pass);
      
      
      
        // if(password_verify($password,$row['password'])){ 
        //     header("location: chngpass.php");
        //      die();
        // }


        // if (password_verify($password, $row['password'])){ 
        //     $_SESSION['username'] = $username;
        //     header("location: dashboard.php");
        //      die();

        // } 
        // else{
        //     echo '<script>alert("Incorrect credentials")</script>' ; 
        // }


}

}





}


?>