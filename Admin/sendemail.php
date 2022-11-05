<?php 

include ('../connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data" >
        <label>Email</label>
        <input type="file" name="file" accept= "application/pdf"> 
        <input type="email" name = "email" required> 
        <input type="submit" name="send" value="Send">
    </form>
    
</body>
</html>

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
        $mail->Password   = 'hmpsnnhddfroharu';     // passowrd                          //SMTP // email password password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->SetFrom('thaddeusgamit31@gmail.com');
        $mail->addAddress('thaddeusgamit31@gmail.com');
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
            echo "<script>alert('Sucess')</script>";
    
        }else{
            echo "<script>alert('Please upload the pdf')</script>";
           
        } 


    }

    else {
        echo " <script> alert('Email not Registered')</script>";
    }


}
?>