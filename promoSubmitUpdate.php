<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    $user_id = $_POST['user_id'];

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

    $stmt = $con->prepare("UPDATE `promotion` SET `company` = ?, `emp_num` = ?, `name` = ?, `department` = ?, `doj` = ?, `ex_grade` = ?, `ex_designation` = ?, `promo_grade` = ?, `promo_designation` = ?, `promo_action` = ?, `promo_effect_date` = ?, `last_promo_date` = ?,  `remark` = ? WHERE `id` = ?");

    $stmt->bind_param("sssssssssssssi", $company, $empnumber, $nameinitial, $department, $doj, $grade, $designation, $grade1, $designation1, $action, $dob1, $dob2,  $remark, $user_id);

    if ($stmt->execute()) {
        header("Location: promoSearch.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
?>
