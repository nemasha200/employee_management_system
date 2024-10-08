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


$compnum = $_POST['compnum'];
$compname = $_POST['compname'];
$location = $_POST['location'];




mysqli_query($con,"INSERT INTO `sub_company`(`com_number`, `com_name`, `location`) VALUES ('$compnum','$compname','$location')");
 
 header("Location: subCompany.php");
exit();


?>
<?php
}
?>