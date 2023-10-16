<?php
session_start();
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
     <link rel="stylesheet" href="../src/css/bootstrap.min.css">
     <link rel="stylesheet" href="../src/css/login.css">
    <title>Welcome</title>
</head>
<body>

<?php 
include ('navbar.php');
?>


<div class="form-container container-lg mt-0 d-flex flex-column justify-content-center align-items-center text-center">
    <form action="" method="POST" class="login-form" enctype="multipart/form-data" >
        <span class="form-header">
            <h1 class="header-text bg-dark display-6">Register</h5>
        </span>
        <div class="row g-4">
  <div class="col-sm-4">
  <label>Picture</label>
    <input type="file" class="form-control" id="formFile"  name="employee_picture" required>
  </div>
  <div class="col-sm-4">
    <label>First Name </label>
    <input type="text" class="form-control"  id="validationCustom01" placeholder="First Name" name="first_name" required >
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-sm-4">
  <label>Middle Name</label>
    <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" required >
  </div>
  <div class="col-sm-4">
  <label>Last name</label>
    <input type="text" class="form-control" placeholder="Last name" name="last_name" required >
  </div>
  <div class="col-sm-4">
  <label>Birthdate</label>
    <input type="date" class="form-control" name="birth_date" required >
  </div>
  <div class="col-sm-4">
  <label>Contact Number</label>
    <input type="Number" class="form-control" placeholder="Contact Number" name="cnum" maxlength="10" required>
  </div>
  <div class="col-sm-4">
  <label>Email</label>
    <input type="email" class="form-control" placeholder="Email"  name="email"  maxlength="10" required>
  </div>
  <div class="col-sm-4">
  <label>SSS ID</label>
    <input type="text" class="form-control" placeholder="SSS ID" name="sss_id" required >
  </div>
  <div class="col-sm-4">
  <label>Pagibig</label>
    <input type="text" class="form-control" placeholder="Pagibig" name="pagibig_id" required >
  </div>
  <div class="col-sm-4">
  <label>Philhealth</label>
    <input type="text" class="form-control" placeholder="Philhealth" name="heatlh_id" required >
  </div>
  <div class="col-sm-4">
  <label>Per hour</label>
    <input type="number" class="form-control" placeholder="Wage" name="wage" required maxlength="5" >
  </div>

  <div class="col-sm-4">
    <div class="d-grid gap-2 col-8 mx-auto">
        <input type="submit" class="btn btn-outline-dark" name = "register" value="Register"></button>
    </div>
  </div>
 
  
</div>
    </form>

    <!-- <form action="" method="POST" enctype="multipart/form-data">
    <label for="">Insert a Photo</label>
    <br>
    <input type="file" name="employee_picture">
    <br>
    <label for="">First name</label>
    <br>
    <input type="text" name="first_name">
    <br>
    <label for="">Middle name</label>
    <br>
    <input type="text" name="middle_name">
    <br>
    <label for="">Last name</label>
    <br>
    <input type="text" name="last_name">
    <br>
    <label for="">Birthdate</label>
    <br>
    <input type="date" name="birth_date">
    <br>
    <label for="">Contact No.</label>
    <br>
    <input type="number" name="cnum">
    <br>
    <label for="">Email</label>
    <br>
    <input type="email" name="email">
    <br>
    <label for="">SSS ID number</label>
    <br>
    <input type="text" name="sss_id">
    <br>
    <label for="">Pag-ibig ID number</label>
    <br>
    <input type="text" name="pagibig_id">
    <br>
    <label for="">Philhealth ID number </label>
    <br>
    <input type="text" name="heatlh_id">
    <br>
    <label for=""> Wage </label>
    <br>
    <input type="number" name="wage">
    <br>
    <input type="submit" name = "register" value="Register">
    </form> -->
    
</body>
</html>

<?php
if(isset($_POST['register'])){

$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$birth_date = $_POST['birth_date'];
$cnum = $_POST['cnum'];
$email = $_POST['email'];
$sss_id = $_POST['sss_id'];
$pagibig_id = $_POST['pagibig_id'];
$heatlh_id = $_POST['heatlh_id'];
$wage = $_POST['wage'];


$dateCreated = date("Y-m-d h:i:a");
$dateUpdated = date("Y-m-d h:i:a");



$year = date('Y');
$rand = rand(9999, 1111);
$employee_id = ($year.$rand);


$pic_name = $first_name.$last_name;
$fileName = $_FILES['employee_picture']['name'];


$img_types = array('img/jpg','image/png','image/jpeg');
$validate_img_extension = in_array($_FILES['employee_picture']['type'],$img_types);


if($validate_img_extension)
{
    if(file_exists("employee_pictures/".$_FILES['employee_picture']['name']))
    {
        $store = $_FILES['employee_picture']['name'];
        echo "Image already exist".$store;

    }
    else
    {


        //validation of employee id
        $validation_id = "SELECT `employee_id` FROM `employees` WHERE employee_id = '$employee_id'";
        $validate_userid = mysqli_query($conn,$validation_id);


        if(mysqli_num_rows($validate_userid) > 0){


            //generate another user id
            $employee_id = ($year.$rand);


        }

        else{   


            // validation of employee 

            $validation_employee = "SELECT `email` FROM employees WHERE email = '$email' ";
            $run_validation_employee = mysqli_query($conn,$validation_employee);

            if(mysqli_num_rows($run_validation_employee) > 0){
                echo '<script>alert("Email has been taken")</script>'; 

                
            }

            else{  

                $query = "INSERT INTO `employees`(`employee_id`, `picture`, `first_name`, `middle_name`, `last_name`, `birth_date`, `email`, `contact_number`, `sss_id`, `pagibig_id`, `philhealth_id`, `wage`, `date_time_created`, `date_time_updated`) 
                VALUES ('$employee_id','$fileName','$first_name','$middle_name','$last_name','$birth_date','$email','$cnum','$sss_id','$pagibig_id','$heatlh_id','$wage','$dateCreated','$dateUpdated')";
                $query_run = mysqli_query($conn, $query);
                 
        
                if($query_run){
                    move_uploaded_file($_FILES['employee_picture']['tmp_name'], "employee_pictures/".$_FILES['employee_picture']['name']);
                    echo '<script>alert("Succefully registered")</script>'; 
                   
                }
    
                else{
                    echo "Error".$sql."<br>".$conn->error;
                }
            }

           

        }

       
       

    }

}

else{
    echo "only jpgs jpegs, pngs";
}




}

?>