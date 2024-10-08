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

$user_id = $_POST['user_id'];

$jobnum = $_POST['jobnum'];
$jobname = $_POST['jobname'];


mysqli_query($con, "UPDATE `sub_jobcat` SET `jobcat_num`='$jobnum', `jobcat_name`='$jobname'  WHERE `id`='$user_id'");

header("Location: subjobSearch.php");
exit();
?>
<?php
}
?>