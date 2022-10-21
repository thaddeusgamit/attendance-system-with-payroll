<?php
session_start();
include('../connection.php');
include('../session.php');
date_default_timezone_set('Asia/Manila');


if(isset($_GET['eid'])){

    
        


    // Store the cipher method
    $ciphering = "AES-128-CTR";
    $options = 0;
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
  
    // Store the decryption key
    $decryption_key = "TeamAgnat";
  
    // Use openssl_decrypt() function to decrypt the data
    $decrypted_employee =openssl_decrypt ($_GET['eid'], $ciphering,
        $decryption_key, $options, $decryption_iv);
    // foreach ($_GET as $encrypting_lrn => $encrypt_lrn){
    //   $decrypt_lrn = $_GET[$encrypting_lrn] = base64_decode(urldecode($encrypt_lrn));
    //   $decrypted_lrn = ((($decrypt_lrn*987654)/56789)/12345678911);
    // }
      
      if(empty($_GET['eid'])){    //lrn verification starts here
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
    <title>Welcome</title>
</head>
<body>


    <!-- query of employee -->

    <?php
    $query_data = "SELECT `employee_id`, `picture`, `first_name`, `middle_name`, `last_name`, `birth_date`, `email`, `contact_number`, `sss_id`, `pagibig_id`, `philhealth_id`, `wage` 
    FROM `employees`
    WHERE employee_id = '$decrypted_employee'";
    $run_query_data = mysqli_query($conn, $query_data);
    $rows = mysqli_fetch_array($run_query_data);

    ?>

    <form action="" method="POST" enctype="multipart/form-data">
    <img src="<?php echo "employee_pictures/" . $rows['picture']?>" alt="user image" height="100px" width="100px">
    <br>
    <label for="">First name</label>
    <br>
    <input type="text" name="first_name" value = "<?php if(empty($rows['first_name'])){ echo "";}else{ echo $rows['first_name'];}?>" required>
    <br>
    <label for="">Middle name</label>
    <br>
    <input type="text" name="middle_name" value = "<?php if(empty($rows['middle_name'])){ echo "";}else{ echo $rows['middle_name'];}?>" >
    <br>
    <label for="">Last name</label>
    <br>
    <input type="text" name="last_name" value = "<?php if(empty($rows['last_name'])){ echo "";}else{ echo $rows['last_name'];}?>" >
    <br>
    <label for="">Birthdate</label>
    <br>
    <input type="date" name="birth_date" value= "<?php if(empty($rows['birth_date'])){ echo "";}else{ echo $rows['birth_date'];}?>" required>
    <br>
    <label for="">Contact No.</label readonly>
    <br>
    <input type="number" name="cnum" value = "<?php if(empty($rows['contact_number'])){ echo "";}else{ echo $rows['contact_number'];}?>"  required>
    <br>
    <label for="">Email</label>
    <br>
    <input type="email" name="email" value = "<?php if(empty($rows['email'])){ echo "";}else{ echo $rows['email'];}?>" required>
    <br>
    <label for="">SSS ID number</label>
    <br>
    <input type="text" name="sss_id" value = "<?php if(empty($rows['sss_id'])){ echo "";}else{ echo $rows['sss_id'];}?>" required>
    <br>
    <label for="">Pag-ibig ID number</label>
    <br>
    <input type="text" name="pagibig_id" value = "<?php if(empty($rows['pagibig_id'])){ echo "";}else{ echo $rows['pagibig_id'];}?>" required>
    <br>
    <label for="">Philhealth ID number </label>
    <br>
    <input type="text" name="heatlh_id" value = "<?php if(empty($rows['philhealth_id'])){ echo "";}else{ echo $rows['philhealth_id'];}?>" required>
    <br>
    <label for=""> Wage </label>
    <br>
    <input type="number" name="wage" value = "<?php if(empty($rows['wage'])){ echo "";}else{ echo $rows['wage'];}?>" required>
    <br>
    <input type="submit" name="edit" value = "Save changes">
    </form>

</body>
</html>


<?php
if(isset($_POST['edit'])){


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
    $dateUpdated = date("Y-m-d h:i:a");
   
// to check if there is a change

$validate_changes = "SELECT `first_name`, `middle_name`, `last_name`, `birth_date`, `email`, `contact_number`, `sss_id`, `pagibig_id`, `philhealth_id`, `wage` FROM `employees` 
WHERE employee_id = '$decrypted_employee' AND first_name = '$first_name' AND middle_name ='$middle_name' AND last_name = '$last_name' AND birth_date = '$birth_date' AND email ='$email' AND contact_number ='$cnum' AND sss_id = '$sss_id' AND pagibig_id = '$pagibig_id' AND philhealth_id ='$heatlh_id' AND wage ='$wage'";
$run_validate_changes = mysqli_query($conn,$validate_changes); 

if(mysqli_num_rows($run_validate_changes) == 1){

    echo "<script>alert('No changes have made')</script>";

}

//update
else{
$update_changes = "UPDATE `employees` SET `first_name`='$first_name',`middle_name`='$middle_name',`last_name`='$last_name',`birth_date`='$birth_date',`email`='$email',`contact_number`='$cnum',`sss_id`='$sss_id',`pagibig_id`='$pagibig_id',`philhealth_id`='$heatlh_id',`wage`='$wage',`date_time_updated`='$dateUpdated' WHERE employee_id = '$decrypted_employee'";
$run_update = mysqli_query($conn,$update_changes);

if($run_update == true){ 

    
    echo "<script>alert('succesfully updated');
    window.location = 'dashboard.php'</script>";

    

}

}



}

?>

