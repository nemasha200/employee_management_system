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


$divisionumber = $_POST['divisionumber'];
$divisioname = $_POST['divisioname'];




mysqli_query($con,"INSERT INTO `sub_division`(`Job_title`, `grade`) VALUES ('$divisionumber','$divisioname')");
 
 header("Location: subDivision.php");
exit();


?>
<?php
}
?>