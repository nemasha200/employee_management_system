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


$jobnum = $_POST['jobnum'];
$jobname = $_POST['jobname'];




mysqli_query($con,"INSERT INTO `sub_jobcat`(`jobcat_num`, `jobcat_name`) VALUES ('$jobnum','$jobname')");
 
 header("Location: subJobCategory.php");
exit();


?>
<?php
}
?>