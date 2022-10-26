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

      else {

        $query_delete = "DELETE FROM `employees` WHERE employee_id = '$decrypted_employee' ";
        $run_delete = mysqli_query($conn,$query_delete);

        if($run_delete){
            echo "<script>alert('Succesfully delete');
            window.location = 'dashboard.php';</script>";
        }

      }


    }
?>