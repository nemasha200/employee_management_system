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

$depnumber = $_POST['depnumber'];
$depname = $_POST['depname'];


mysqli_query($con, "UPDATE `sub_designation` SET `desi_num`='$depnumber', `desi_name`='$depname'  WHERE `id`='$user_id'");

header("Location: subDesignationSearch.php");
exit();
?>
<?php
}
?>