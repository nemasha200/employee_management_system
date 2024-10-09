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

$company = $_POST['company'];
$empnumber = $_POST['empnumber'];
$nameinitial = $_POST['nameinitial'];
$department = $_POST['department'];
$grade = $_POST['grade'];
$designation = $_POST['designation'];
$grade1 = $_POST['grade1'];
$designation1 = $_POST['designation1'];
$action = $_POST['action'];

$dob1 = $_POST['dob1'];
$dob2 = $_POST['dob2'];
$doj = $_POST['doj'];  
$remark = $_POST['remark'];

$insertPromotionQuery = "INSERT INTO `promotion`(`company`, `emp_num`, `name`, `department`, `doj`,`ex_grade`, `ex_designation`, `promo_grade`, `promo_designation`, `promo_action`, `promo_effect_date`, `last_promo_date`, `remark`) 
VALUES ('$company', '$empnumber', '$nameinitial', '$department','$doj',  '$grade', '$designation', '$grade1', '$designation1', '$action', '$dob1', '$dob2', '$remark')";

if (mysqli_query($con, $insertPromotionQuery)) {
    header("Location: promotion.php");
    exit();
} else {
    echo "Error: " . $insertPromotionQuery . "<br>" . mysqli_error($con);
}
?>

<?php
}
?>