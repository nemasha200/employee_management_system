<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}else{
?>
<?php 

include 'db_connect.php';


$title = $_POST['title'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$department = $_POST['department'];
$nic = $_POST['nic'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['password'];
$conpassword=$_POST['conpassword'];







mysqli_query($con,"INSERT INTO `user`(`title`, `first_name`, `last_name`, `department`, `nic`, `email`, `contact`, `type`, `username`, `password`,`con_password`) VALUES ('$title','$firstname','$lastname','$department','$nic','$email','$contact','$type','$username','$password','$conpassword')");
 
 header("Location: user.php");
exit();


?>
<?php
}
?>