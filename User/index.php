<?php
include('../connection.php');
date_default_timezone_set('Asia/Manila');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Fixed-navbar-starting-with-transparency-1.css">
    <link rel="stylesheet" href="assets/css/Fixed-navbar-starting-with-transparency.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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
    <section class="login-clean">
        <form action = ""  method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-time-outline"></i>
              <h2 id = "time" ></h2>
          </div>
            <div class="mb-3">
                <input class="form-control" class="border border-dark" type="number" name="employee_id" placeholder="Employee ID" style="border-color:black; "></div>
            <div class="mb-3"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" name = "time_in" type="submit">TIme in&nbsp;</button>
            <button class="btn btn-primary d-block w-100" name = "time_out" type="submit">Time out</button></div>
        </form>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Fixed-navbar-starting-with-transparency.js"></script>
    <script src="../src/js/time.js"></script>
</body>
</html>


<?php 

$employee_id = $_POST['employee_id'];
$day = date('l');
$date = date("M-d-Y");
$time_in = date("h:i");
$time_out = date("h:i");

$dateCreated = date("Y-m-d h:i:a");
$dateUpdated = date("Y-m-d h:i:a");

// time in

if(isset($_POST['time_in'])){

 

  //validating of employee

    $validate = "SELECT `employee_id` FROM `employees` WHERE employee_id = '$employee_id'";
    $run_validate = mysqli_query($conn,$validate);

    if(mysqli_num_rows($run_validate) == 1){

        // do not double send 
        $validate_date = "SELECT `date` FROM `attendance` WHERE employee_id ='$employee_id' AND date = '$date'";
        $run_valid_date = mysqli_query($conn,$validate_date);

        if(mysqli_num_rows($run_valid_date) == 1){


          echo "<script> alert('Already time in')</script>";


        }

      else{

            $insert_timein = "INSERT INTO `attendance`(`employee_id`, `date`, `time_in`, `day`, `date_time_created`, `date_time_updated`) 
            VALUES ('$employee_id','$date','$time_in','$day','$dateCreated','$dateUpdated')";
            $run_insert_timein = mysqli_query($conn,$insert_timein);

              if($run_insert_timein){
                 echo "<script> alert('Succesfully time in')</script>";
              }


          } 

    }


  else{

    echo "<script> alert('not registered')</script>";


  }

}




// time out 

if(isset($_POST['time_out'])){
  
  //validating of employee 

  $validate = "SELECT `employee_id` FROM `employees` WHERE employee_id = '$employee_id'";
  $run_validate = mysqli_query($conn,$validate);

  if(mysqli_num_rows($run_validate) == 1){

      // do not double send 



      $insert_timeout = "UPDATE `attendance` SET `time_out`='$time_out' WHERE employee_id ='$employee_id'";
      $run_insert_timeout = mysqli_query($conn,$insert_timeout);
  
      if($run_insert_timeout){
        echo "<script> alert('Succesfully time out')</script>";
      }



  }

  else{

    echo "<script> alert('not registered')</script>";

  }





}

?>