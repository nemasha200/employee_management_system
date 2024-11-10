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
$customer_id =$_GET['user_id'];

mysqli_query($con,"DELETE FROM `user` WHERE admin_id= $customer_id");
header('Location:priviSearch.php')


?>

<?php
}
?>