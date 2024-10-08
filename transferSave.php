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
$emp = $_POST['emp'];
$nameinitial = $_POST['nameinitial'];
$designation = $_POST['designation'];
$employment = $_POST['employment'];
$exdepartment = $_POST['exdepartment'];
$excompany = $_POST['excompany'];
$transdep = $_POST['transdep'];
$transcom = $_POST['transcom'];
$dob1 = $_POST['dob1'];
$dob2 = $_POST['dob2'];
$dob3 = $_POST['dob3'];
$remark = $_POST['remark'];






mysqli_query($con,"INSERT INTO `transfers`(`company`, `emp_num`, `name`, `designation`, `employment`, `ex_department`, `ex_company`, `trans_department`, `trans_company`, `effect_date`, `req_date`, `approve_date`, `remark`) 
VALUES ('$company', '$emp', '$nameinitial','$designation','$employment','$exdepartment','$excompany','$transdep','$transcom','$dob1','$dob2','$dob3','$remark')");
 
 header("Location: transers.php");
exit();


?>
<?php
}
?>