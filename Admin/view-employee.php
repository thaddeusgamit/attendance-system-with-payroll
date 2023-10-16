<?php
session_start();
include('../connection.php');
include('../session.php');


if(isset($_GET['profile'])){

        


    // Store the cipher method
    $ciphering = "AES-128-CTR";
    $options = 0;
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
  
    // Store the decryption key
    $decryption_key = "TeamAgnat";
  
    // Use openssl_decrypt() function to decrypt the data
    $decrypted_employee =openssl_decrypt ($_GET['profile'], $ciphering,
        $decryption_key, $options, $decryption_iv);
    // foreach ($_GET as $encrypting_lrn => $encrypt_lrn){
    //   $decrypt_lrn = $_GET[$encrypting_lrn] = base64_decode(urldecode($encrypt_lrn));
    //   $decrypted_lrn = ((($decrypt_lrn*987654)/56789)/12345678911);
    // }
      
      if(empty($_GET['profile'])){    //lrn verification starts here
          echo "<script>alert('Employee not found');
          window.location = 'dashboard.php';</script>";
          exit();
      }


    

      $verify_lrn = "SELECT employees.employee_id FROM `employees` WHERE employee_id = '$decrypted_employee'";
      $query_request = mysqli_query($conn, $verify_lrn) or die (mysqli_error($conn));
      if(mysqli_num_rows($query_request) == 0){
              echo "
              <script type = 'text/javascript'>
              window.location = 'dashboard.php';
              </script>";
              exit();
      }


    }
  
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

    <!-- query of employee -->

    <?php
    $query_data = "SELECT `employee_id`, `picture`, `first_name`, `middle_name`, `last_name`, `birth_date`, `email`, `contact_number`, `sss_id`, `pagibig_id`, `philhealth_id`, `wage` 
    FROM `employees`
    WHERE employee_id = '$decrypted_employee'";
    $run_query_data = mysqli_query($conn, $query_data);
    $rows = mysqli_fetch_array($run_query_data);

    ?>


<div class="form-container container-lg mt-0 d-flex flex-column justify-content-center align-items-center text-center">
    <form action="" method="POST" class="login-form" enctype="multipart/form-data" >
        <span class="form-header">
            <h1 class="header-text bg-dark display-6">Employee Data</h5>
        </span>
        <div class="row g-4">
  <div class="col-sm-4">
  
  <img src="<?php echo "employee_pictures/" . $rows['picture']?>" alt="user image" height="100px" width="120px">
  </div>
  <div class="col-sm-4">
    <label>First Name </label>
    <input type="text" class="form-control"  placeholder="First Name" name="first_name" value="<?php if(empty($rows['first_name'])){ echo "";}else{ echo $rows['first_name'];}?> " disabled readonly >
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-sm-4">
  <label>Middle Name</label>
    <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value= "<?php if(empty($rows['middle_name'])){ echo "";}else{ echo $rows['middle_name'];}?>" disabled readonly >
  </div>
  <div class="col-sm-4">
  <label>Last name</label>
    <input type="text" class="form-control" placeholder="Last name" name="last_name" value= "<?php if(empty($rows['last_name'])){ echo "";}else{ echo $rows['last_name'];}?>" disabled readonly >
  </div>
  <div class="col-sm-4">
  <label>Birthdate</label>
    <input type="date" class="form-control" name="birth_date"  value= "<?php if(empty($rows['birth_date'])){ echo "";}else{ echo $rows['birth_date'];}?>" disabled readonly >
  </div>
  <div class="col-sm-4">
  <label>Contact Number</label>
    <input type="Number" class="form-control" placeholder="Contact Number" name="cnum" maxlength="10" value= "<?php if(empty($rows['contact_number'])){ echo "";}else{ echo $rows['contact_number'];}?>"  disabled readonly>
  </div>
  <div class="col-sm-4">
  <label>Email</label>
    <input type="email" class="form-control" placeholder="Email"  name="email" value= "<?php if(empty($rows['email'])){ echo "";}else{ echo $rows['email'];}?>"  maxlength="10" disabled readonly>
  </div>
  <div class="col-sm-4">
  <label>SSS ID</label>
    <input type="text" class="form-control" placeholder="SSS ID" name="sss_id" value= "<?php if(empty($rows['sss_id'])){ echo "";}else{ echo $rows['sss_id'];}?>" disabled readonly >
  </div>
  <div class="col-sm-4">
  <label>Pagibig</label>
    <input type="text" class="form-control" placeholder="Pagibig" name="pagibig_id" value= "<?php if(empty($rows['pagibig_id'])){ echo "";}else{ echo $rows['pagibig_id'];}?>" disabled readonly >
  </div>
  <div class="col-sm-4">
  <label>Philhealth</label>
    <input type="text" class="form-control" placeholder="Philhealth" name="heatlh_id" value= "<?php if(empty($rows['philhealth_id'])){ echo "";}else{ echo $rows['philhealth_id'];}?>" disabled readonly >
  </div>
  <div class="col-sm-4">
  <label>Per hour</label>
    <input type="number" class="form-control" placeholder="Wage" name="wage" value= "<?php if(empty($rows['wage'])){ echo "";}else{ echo $rows['wage'];}?>" maxlength="5" disabled readonly >
  </div>

</div>
<br>
    </form>















    <!-- <form action="" method="POST" enctype="multipart/form-data">
    <img src="<?php echo "employee_pictures/" . $rows['picture']?>" alt="user image" height="100px" width="100px">
    <br>
    <label for="">First name</label>
    <br>
    <input type="text" name="first_name" value= "<?php if(empty($rows['first_name'])){ echo "";}else{ echo $rows['first_name'];}?>" readonly>
    <br>
    <label for="">Middle name</label>
    <br>
    <input type="text" name="middle_name" value= "<?php if(empty($rows['middle_name'])){ echo "";}else{ echo $rows['middle_name'];}?>" readonly>
    <br>
    <label for="">Last name</label>
    <br>
    <input type="text" name="last_name" value= "<?php if(empty($rows['last_name'])){ echo "";}else{ echo $rows['last_name'];}?>" readonly>
    <br>
    <label for="">Birthdate</label>
    <br>
    <input type="date" name="birth_date" value= "<?php if(empty($rows['birth_date'])){ echo "";}else{ echo $rows['birth_date'];}?>" readonly>
    <br>
    <label for="">Contact No.</label readonly>
    <br>
    <input type="number" name="cnum" value= "<?php if(empty($rows['contact_number'])){ echo "";}else{ echo $rows['contact_number'];}?>"  readonly>
    <br>
    <label for="">Email</label>
    <br>
    <input type="email" name="email" value= "<?php if(empty($rows['email'])){ echo "";}else{ echo $rows['email'];}?>" readonly>
    <br>
    <label for="">SSS ID number</label>
    <br>
    <input type="text" name="sss_id" value= "<?php if(empty($rows['sss_id'])){ echo "";}else{ echo $rows['sss_id'];}?>" readonly>
    <br>
    <label for="">Pag-ibig ID number</label>
    <br>
    <input type="text" name="pagibig_id" value= "<?php if(empty($rows['pagibig_id'])){ echo "";}else{ echo $rows['pagibig_id'];}?>" readonly>
    <br>
    <label for="">Philhealth ID number </label>
    <br>
    <input type="text" name="heatlh_id" value= "<?php if(empty($rows['philhealth_id'])){ echo "";}else{ echo $rows['philhealth_id'];}?>" readonly>
    <br>
    <label for=""> Wage </label>
    <br>
    <input type="number" name="wage" value= "<?php if(empty($rows['wage'])){ echo "";}else{ echo $rows['wage'];}?>" readonly>
    <br>
    </form> -->
    

<!-- attendance -->
<br>

<h1>ATTENDANCE RECORDS</h1>



<table class="table table-hover table-hover align-middle mb-0 "> 
  
  <thead class="table-dark">
      <tr>
      <th>No.</th>
      <th>Date</th>
      <th>Day</th>
      <th>Time in</th>
      <th>Lunch in</th>
      <th>Lunch out</th>
      <th>Time Out</th>
      <th>Hours</th>
      
      
      </tr>
     
  </thead>
  <tbody>
  <?php

      $sql = "SELECT `date`, `time_in`, `lunch_in`, `lunch_out`, `time_out`, `day`, `hours` FROM `attendance` WHERE employee_id = '$decrypted_employee' ORDER BY date DESC";
      $run = mysqli_query($conn,$sql);

       if(mysqli_num_rows($run) > 0){
          $count = 0;
          foreach($run as $row){

            $count++;
 
      ?>
      <tr>
          <td><?php echo $count;?></td> 
          <td><?php echo $row['date']?></td>
          <td><?php echo $row['day']?></td>
          <td><?php echo $row['time_in']?></td>
          <td><?php echo $row['lunch_in']?></td>
          <td><?php echo $row['lunch_out']?></td>
          <td><?php echo $row['time_out']?></td>
          <td><?php echo $row['hours']?></td>
          
      </tr>
      <?php
          }
      }
      ?>

  </tbody>


  </table>








</body>
</html>