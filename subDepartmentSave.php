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


$Departmentnum = $_POST['Departmentnum'];
$Departmentname = $_POST['Departmentname'];




mysqli_query($con,"INSERT INTO `sub_department`(`dep_num`, `dep_name`) VALUES ('$Departmentnum','$Departmentname')");
 
 header("Location: subDepartmentSearch.php");
exit();


?>
<?php
}
?>