<?php

use PhpParser\Node\Stmt\Else_;

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
            <div class="mb-3">
            <button class="btn btn-primary d-block w-100" name = "time_in" type="submit">Time in&nbsp;</button>
            <button class="btn btn-primary d-block w-100" name = "lunch_in" type="submit">Lunch In&nbsp;</button>
            <button class="btn btn-primary d-block w-100" name = "lunch_out" type="submit">Lunch out&nbsp;</button>
            <button class="btn btn-primary d-block w-100" name = "time_out" type="submit">Time out</button></div>
        </form>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Fixed-navbar-starting-with-transparency.js"></script>
    <script src="../src/js/time.js"></script>
</body>
</html>


<?php 


$day = date('l');
$date = date("M-d-Y");
$time_in = date("H:i",strtotime("now"));
$lunch_in = date("H:i",strtotime("now"));
$lunch_out = date("H:i",strtotime("now"));
$time_out = date("H:i",strtotime("now"));






$dateCreated = date("Y-m-d h:i:a");
$dateUpdated = date("Y-m-d h:i:a");

// time in


if(isset($_POST['time_in'])){

  $employee_id = $_POST['employee_id'];

 



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


// lunch_in

if(isset($_POST['lunch_in'])){
  $employee_id = $_POST['employee_id'];

  //validate employee 

  $validate_lunch = "SELECT `employee_id` FROM `employees` WHERE employee_id = '$employee_id'";
  $run_validate_lunch = mysqli_query($conn, $validate_lunch);

  if(mysqli_num_rows($run_validate_lunch) == 1){
    
    // function of not double send 
    $query_lunch = "SELECT `lunch_in` FROM `attendance` WHERE employee_id = '$employee_id' AND date = '$date' AND lunch_in = '$lunch_in'";
    $run_query_lunch = mysqli_query($conn, $query_lunch);

    if(mysqli_num_rows($run_query_lunch) > 0 ){

      echo "<script> alert('Already lunch in')</script>";
    }

    else{
      // updating lunch

      $insert_lunchin = "UPDATE `attendance` SET `lunch_in` = '$lunch_in' WHERE employee_id ='$employee_id' AND date = '$date'";;
      $run_insert_lunch = mysqli_query($conn, $insert_lunchin);


      if($run_insert_lunch){
        echo "<script> alert('lunch in')</script>";


      }


      else{
        echo "<script> alert('Time in first')</script>";

      }

    }
 
 
 
  }

  else
  {
    echo "<script> alert('Not Registered')</script>";
  }



  
}




// lunch out



if(isset($_POST['lunch_out'])){
  $employee_id = $_POST['employee_id'];

  //validate employee 

  $validate_lunchout = "SELECT `employee_id` FROM `employees` WHERE employee_id = '$employee_id'";
  $run_validate_lunchout = mysqli_query($conn, $validate_lunchout);

  if(mysqli_num_rows($run_validate_lunchout) == 1){
    
    // function of not double send 
    $query_lunch_out = "SELECT `lunch_in` FROM `attendance` WHERE employee_id = '$employee_id' AND date = '$date' AND lunch_in = '$lunch_in'";
    $run_query_lunch_out = mysqli_query($conn, $query_lunch_out);

    if(mysqli_num_rows($run_query_lunch_out) == 1 ){

      echo "<script> alert('Already lunch out')</script>";
    }

    else{
      // updating lunch

      $insert_lunch_out = "UPDATE `attendance` SET `lunch_out` = '$lunch_in' WHERE employee_id ='$employee_id' AND date = '$date'";;
      $run_insert_lunch_out = mysqli_query($conn, $insert_lunch_out);


      if($run_insert_lunch_out){
        echo "<script> alert('lunch out')</script>";


      }


      else{
        echo "<script> alert('Lunch in first ')</script>";

      }

    }
 
 
 
  }

  else
  {
    echo "<script> alert('Not Registered')</script>";
  }



  
}





// time out 

if(isset($_POST['time_out'])){
  $employee_id = $_POST['employee_id'];
  
 


  //validating of employee 

  $validate = "SELECT `employee_id` FROM `employees` WHERE employee_id = '$employee_id'";
  $run_validate_query = mysqli_query($conn,$validate);

  if(mysqli_num_rows($run_validate_query) == 1){

      // do not double send 

      $insert_timeout = "UPDATE `attendance` SET `time_out`='$time_out' WHERE employee_id ='$employee_id' AND date = '$date' ";
      $run_insert_timeout = mysqli_query($conn,$insert_timeout);
  
      if($run_insert_timeout){
       


          $query_hour = "SELECT `time_in`, `lunch_in`, `lunch_out`, `time_out` FROM `attendance` WHERE employee_id = '$employee_id' AND date = '$date' ";
          $run_query_hour = mysqli_query($conn, $query_hour);

            if(mysqli_num_rows($run_query_hour) > 0){
              foreach($run_query_hour as $row){
                $diff_time = round(abs(strtotime($row['time_in']) - strtotime($row['time_out'])) / 3600,2);
                $diff_lunch = round(abs(strtotime($row['lunch_in']) - strtotime($row['lunch_out'])) / 3600,2);
                
                  print_r($diff_lunch);

                  $total_hour = $diff_time - $diff_lunch;

                
                  
                
               $insert_hour = "UPDATE `attendance` SET `hours` = '$total_hour' WHERE employee_id ='$employee_id' AND date = '$date'";
               $run_hour = mysqli_query($conn, $insert_hour);

               if($run_hour){
                echo "<script> alert('Succesfully time out')</script>";

               }



              }

            }


      }



  }

  else{

    echo "<script> alert('not registered')</script>";

  }





}

?>