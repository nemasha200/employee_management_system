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
$department = $_POST['department']; 
$nameinitial = $_POST['nameinitial'];
$epfnumber = $_POST['epfnumber']; 
$basic = $_POST['basic'];
$bra = $_POST['bra'];
$amount1 = $_POST['amount1'];
$amount2 = $_POST['amount2'];                                             
$amount3 = $_POST['amount3'];
$amount4 = $_POST['amount4'];     
$amount5 = $_POST['amount5']; 
$amount6 = $_POST['amount6'];
$amount7 = $_POST['amount7']; 
$amount8 = $_POST['amount8'];
$amount9 = $_POST['amount9'];
$amount10 = $_POST['amount10'];
$amount11 = $_POST['amount11'];                                             
$amount12 = $_POST['amount12'];
$amount13 = $_POST['amount13'];     
$amount14 = $_POST['amount14']; 
$amount15 = $_POST['amount15'];
$amount16 = $_POST['amount16']; 
$payment = $_POST['payment'];
$account = $_POST['account'];
$bank = $_POST['bank'];
$branch = $_POST['branch'];                                             

$query = "INSERT INTO `salary`(`company_num`, `department`, `name`, `epf`, `basic`, `bra`, `fa_travelling_amount`, `fa_budget_amount`, `fa_retravel_amount`, `fa_vehicle_amount`, `fa_fual_amount`, `fa_logging_amount`, `fa_attendance_amount`, 
`fa_travel_exp_amount`, `fa_pettah_amount`, `fa_bakery_amount`, `fa_insentive_amount`,
 `fd_welfare_amount`, `fd_medical_amount`, `fd_other1`, `fd_other2`, `fd_other3`, `payemnt`,
  `account_num`, `bank_name`, `branch_name`)
          VALUES ('$company', '$department', '$nameinitial', '$epfnumber', '$basic', '$bra', '$amount1', '$amount2', '$amount3', '$amount4', '$amount5', '$amount6', '$amount7', '$amount8', '$amount9', '$amount10', '$amount11', '$amount12', '$amount13', '$amount14', '$amount15', '$amount16', '$payment', '$account', '$bank', '$branch')";

if (mysqli_query($con, $query)) {
    header("Location: salarySearch.php");
    exit();
} else {
    echo "Error: " . mysqli_error($con); 
}

?>

<?php
}
?>