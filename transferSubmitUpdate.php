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

$user_id = $_['user_id'];

$selectemp = $_POST['selectemp'];
$transtype = $_POST['transtype'];
$effectyear = $_POST['effectyear'];
$effectdate = $_POST['effectdate'];
$remark = $_POST['remark'];


mysqli_query($con, "UPDATE `transfers` SET `select_emp`='$selectemp', `trans_type`='$transtype', `trans_yr`='$effectyear', `trans_date`='$effectdate', `remark`='$remark' WHERE `id`='$user_id'");

header("Location: transferSearch.php");
exit();
?>
<?php
}
?>