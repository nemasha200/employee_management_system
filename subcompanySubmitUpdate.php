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

$compnum = $_POST['compnum'];
$compname = $_POST['compname'];
$location = $_POST['location'];


mysqli_query($con, "UPDATE `sub_company` SET `com_number`='$compnum', `com_name`='$compname', `location`='$location'  WHERE `id`='$user_id'");

header("Location: subCompanySearch.php");
exit();
?>
<?php
}
?>