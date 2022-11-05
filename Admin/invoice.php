<?php
session_start();
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
include('../connection.php');
include('../session.php');
date_default_timezone_set('Asia/Manila');

$decrypted_employee = 20228035;





$month = date("M");

$pay_cycle = date('d');

if($pay_cycle <= 15 ){
$pay_period = $month . "1-15";

}
else{
    $pay_period = $month . "16-30";

}

// design
$html='
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Season INC </title>
</head>

<style>



</style>


';



// query the employee

$query_data = "SELECT * FROM `employees` WHERE employee_id = '$decrypted_employee'";
$run_data =mysqli_query($conn, $query_data);

if(mysqli_num_rows($run_data) > 0 ){
    foreach($run_data as $row){
     $firstname = $row['first_name'];
     $lastname = $row['last_name'];
     $rate = $row['wage'];
        
    }

    

    
}









// query the hours 
$query_hours ="SELECT SUM(hours) AS total_hours FROM (SELECT `hours`  FROM attendance WHERE employee_id = '$decrypted_employee' AND day IN ('Monday','Tuesday', 'Wednesday','Thursday','Friday') ORDER BY date DESC LIMIT 15 ) AS total_hours ";
$run_hours = mysqli_query($conn, $query_hours);

if (mysqli_num_rows($run_hours) > 0 ) {
    $rows= mysqli_fetch_array($run_hours);

     $total_hours = $rows['total_hours'];
    


}



$query_rd = "SELECT COUNT(day) AS total_days FROM (SELECT `day` FROM attendance WHERE employee_id = '$decrypted_employee' AND day IN ('Saturday','Sunday')  ORDER BY date DESC LIMIT 15 ) AS total_days ";
$run_rd = mysqli_query($conn, $query_rd);

// Rest Day Pay = (Hourly rate × 130% × 8 hours)

    if(mysqli_num_rows($run_rd) > 0 ){
        $row = mysqli_fetch_array($run_rd);
        if($row['total_days'] > 0  ){
            $rest_day = $row['total_days'];

            // query of hours restday
            $query_rd_hours = "SELECT SUM(hours) AS total_hours FROM (SELECT `hours` FROM attendance WHERE employee_id = '$decrypted_employee' AND day IN ('Sunday','Saturday') ORDER BY date DESC LIMIT 15 ) AS total_hours "; 
            $run_query_rd_hours = mysqli_query($conn,$query_rd_hours);

            if(mysqli_num_rows($run_query_rd_hours) > 0 ){
                $row = mysqli_fetch_array($run_query_rd_hours);
                    $hours_rd = $row['total_hours'];
            }

            //Hourly rate x 130% x 130% x number of hours worked

            //computing the overime of restday


            
            
            $total_rd = $rest_day * 8;

            if($hours_rd > $total_rd){
                $overtime_rate = $hours_rd - $total_rd;
                $rd_eq_1 = ($rate * 1.3 * 1.3)*$overtime_rate;
                $rd_eq_2 = ($rate *0.3) * $rest_day;
                $overtime_rd= $rd_eq_1 + $rd_eq_2;
            }

            else{
                
                $overtime_rd = 0;
                $overtime_rate = 0;
            }


            if($hours_rd == $total_rd){
                $restday_pay = ($rate * 0.3) * $hours_rd; 
            }

            else{
                $overtime_rd = 0;
                
                

            }

          
           








        }

        else{
            $rest_day = 0;
            $restday_pay = 0;
        } 
        
    }





   


    //computations

    $per_cut = $rate * 80;
    $monthly_rate = ($rate * 80) * 2 ;

    $year = date('Y');




    if($total_hours < 80){

        $absent = (80 - $total_hours)*$rate;
        
        }

        else {
            $absent = 0;

        }
        

        
        if($total_hours > 80) {
        
        $overtime = $total_hours - 80;
        
        
        $overtime_hourly = $rate * 1.25;
        $total_overtime = $overtime_hourly * $overtime;
        
        }
        
        else {
           
            $total_overtime = 0;
        }

        $sss = $monthly_rate * 0.045;

        if($sss > 1125){
            $sss = 1125;
        }
        else {
            $sss;
        }

        if($monthly_rate <= 1500){
            $pagibig = $monthly_rate * 0.01;
        }
        else{
            $pagibig = $monthly_rate * 0.02;
        }

        if($year == 2022 ){
            if($monthly_rate <= 10000 ){
                $health = 400;
            }

            else {
                $health = $monthly_rate *0.04;
            }
        }

        if($year == 2023 ){
            if($monthly_rate <= 10000 ){
                $health = 450;
            }

            else {
                $health = $monthly_rate *0.045;
            }
        }

        if($year == 2024 || $year == 2025 ){
            if($monthly_rate <= 10000 ){
                $health = 500;
            }

            else {
                $health = $monthly_rate *0.05;
            }
        }



     //tax
     

     if($monthly_rate <= 20833){
        $tax = 0;

     }

     elseif($monthly_rate >= 20833 && $monthly_rate <= 33332){

        $tax = ($monthly_rate - 20833)*0.2;
        }
        
        elseif($monthly_rate >= 33333 && $monthly_rate <= 66666){
            $tax  = ($monthly_rate - 33333)*0.25 + 2500.00;
        }
        
        elseif($monthly_rate >= 66667 && $monthly_rate <= 166666){
        
            $tax  = ($monthly_rate- 66667)*0.30 + 10833.33;
        }
        
        elseif($monthly_rate >= 166667 && $monthly_rate <= 666666){
        
            $tax  = ($monthly_rate - 166667)*0.32 + 40833.33;
        }

     else{
        $tax  = ($monthly_rate - 666667)*0.35 + 200833.33 ;
     }

        
     $tax_inc = $tax / 2;


     $deductions =  $absent + $sss + $pagibig + $health + $tax_inc;
     $earnings =  $overtime_rd + $restday_pay + $per_cut + $total_overtime;

     $net_pay = $earnings - $deductions;

        //computation deduction
       
       

       
        




        //date 

        // $day = date('d');

        // if($day == 15){

        //  $deductions =  $absent + $sss + $health + $tax_inc;  
        //  $earnings =  $overtime_rd + $restday_pay + $per_cut + $total_overtime;
        //  $net_pay = $earnings - $deductions;

        // }


        // elseif($day == 30 || $day == 31){
            
         //  $deductions =  $absent + $pagibig + $tax_inc;  
        //  $earnings =  $overtime_rd + $restday_pay + $per_cut + $total_overtime;
        //  $net_pay = $earnings - $deductions;


        // }
        
    




    $html.=' 
    <h4> SEASON INC </h4>
    <br>
    <h4> PAYSLIP </h4>



    <label> Name: '.$firstname.'  '.$lastname.'</label> 
    <br>
    <label> Paycycle: '.$pay_period.'  </label>
    <br>
    <label> Rate: '.$monthly_rate.'</label> 

    <h4> EARNINGS </h4>
    <hr>

    <label> Basic:'.$rate.'</label>
    <label> Percut off: '.$per_cut.' </label>
    <br>
    <label> Absent: '.$absent.' </label>
    <br>
    <label> Overtime: '.$total_overtime.' </label>
    <br>
   <label> Restday: '.$rest_day.' '.$restday_pay.'  </label>
    <br>
    <label> Restday_OT: '.$overtime_rd.' '.$overtime_rate.'  </label>
    <hr>
    <label> Total Earnings: '.$earnings.'</label>
    <hr>
    <h4> DEDUCTIONS </h4>
    <label> SSS: '.$sss.' </label>
    <br>
    <label> PAG-IBIG: '.$pagibig.' </label>
    <br>
    <label> PHILHEALTH: '.$health.' </label>
    <br>
    <label> Tax: '.$tax_inc.'</label>
    <br>
    <hr>
    <label> Total Dededuction: '.$deductions.'</label>
    <br>
    <hr>
    <label> Netpay: '.$net_pay.'</label>
        
    
 






    ';

















$dompdf = new Dompdf();

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Legal', 'portrait');



$dompdf->get_canvas()->get_cpdf()->setEncryption(NULL, "password", array('print'));
$dompdf->get_canvas()->get_cpdf()->encrypted=true;



$dompdf->loadHtml($html);



// Render the HTML as PDF
$dompdf->render();



$dompdf->stream("Seasonal INC paycheck", Array("Attachment" =>0));


?>