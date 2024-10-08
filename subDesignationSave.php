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


$designationum = $_POST['designationum'];
$designationame = $_POST['designationame'];




mysqli_query($con,"INSERT INTO `sub_designation`(`desi_num`, `desi_name`) VALUES ('$designationum','$designationame')");
 
 header("Location: subDesignation.php");
exit();


?>
<?php
}
?>