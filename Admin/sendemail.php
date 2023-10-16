<?php 

include ('../connection.php');
?>


<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$path){
    require ("PHPMailer.php");
    require("SMTP.php");
    require("Exception.php");


    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'thaddeusgamit31@gmail.com';    //don't forget the email                 //SMTP username // email username
        $mail->Password   = 'ptxwqzrbcyddokuv';     // passowrd                          //SMTP // email password password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->SetFrom('thaddeusgamit31@gmail.com');
        $mail->addAddress($email);
        $mail->addAttachment($path);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Payslip in SEASON INC";
        $mail->Body    = "This is your Payslip" ;
        

        $mail->send();
        return true;
    } 
    catch (Exception $e) {
        return false;
    }



            }



?>



<?php
if(isset($_POST['send'])){
    $email = $_POST['email'];

    $query_validation = "SELECT `email` FROM `employees` WHERE email = '$email' ";
    $email_validation = mysqli_query($conn, $query_validation);
    if(mysqli_num_rows($email_validation) > 0 ){

        $path = 'C:\Users\thadd\OneDrive\Documents\payslip'. basename($_FILES['file']['name']);
        if(move_uploaded_file($_FILES['file']['tmp_name'],$path)){
        
            sendMail($email,$path);
            echo "<script>alert('succesfully Send');
            window.location = 'dashboard.php'</script>";
    
        }else{
            echo "<script>alert('Upload PDF');
            window.location = 'dashboard.php'</script>";
           
        } 


    }

    else {
        echo "<script>alert('Email not register');
            window.location = 'dashboard.php'</script>";
    }


}
?>