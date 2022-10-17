<?php
include('connection.php');
session_start();

if(session_destroy()){
unset($_SESSION['username']);
header("Location: login.php");
exit();
}
?>