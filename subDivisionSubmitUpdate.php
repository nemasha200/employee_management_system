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

$divisionumber = $_POST['divisionumber'];
$divisioname = $_POST['divisioname'];


mysqli_query($con, "UPDATE `sub_division` SET `Job_title`='$divisionumber', `grade`='$divisioname'  WHERE `id`='$user_id'");

header("Location: subDivisionSearch.php");
exit();
?>
<?php
}
?>