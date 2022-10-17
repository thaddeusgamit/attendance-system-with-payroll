<?php

$conn = new mysqli('localhost', 'root' , '' , 'attendance/payroll_system');

if($conn == false) {
    echo "error" . $conn->error;
}


?>