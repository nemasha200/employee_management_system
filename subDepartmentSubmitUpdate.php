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

$Departmentnum = $_POST['Departmentnum'];
$Departmentname = $_POST['Departmentname'];


mysqli_query($con, "UPDATE `sub_department` SET `dep_num`='$Departmentnum', `dep_name`='$Departmentname'  WHERE `id`='$user_id'");

header("Location: subDepartmentSearch.php");
exit();
?>
<?php
}
?>