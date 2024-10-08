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
$employeeType = $_POST['employeeType']; 
$refnumber = $_POST['refnumber'];
$empnumber = $_POST['empnumber'];
$dob = $_POST['dob'];
$fullName = $_POST['fullName'];
$section = $_POST['section'];
$designation = $_POST['designation'];                                             
$headerGiven = $_POST['headerGiven'];
$remark = $_POST['remark'];

$query = "INSERT INTO `clearance` (`company_num`, `emptype`, `ref_num`, `emp_num`, `wef`, `fullname`, `section`, `designation`, `prior_notice`, `remark`) 
          VALUES ('$company', '$employeeType', '$refnumber', '$empnumber', '$dob', '$fullName', '$section', '$designation', '$headerGiven', '$remark')";

if (mysqli_query($con, $query)) {
    header("Location: clearance.php");
    exit();
} else {
    echo "Error: " . mysqli_error($con); 
}

?>

<?php
}
?>