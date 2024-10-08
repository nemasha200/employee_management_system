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
    $doj = $_POST['doj'];  // Fixed the typo, changed $dob to $doj
    $remark = $_POST['remark'];

    // Use prepared statements to avoid SQL injection
    $stmt = $con->prepare("UPDATE `promotion` SET `company` = ?, `emp_num` = ?, `name` = ?, `department` = ?, `ex_grade` = ?, `ex_designation` = ?, `promo_grade` = ?, `promo_designation` = ?, `promo_action` = ?, `promo_effect_date` = ?, `last_promo_date` = ?, `doj` = ?, `remark` = ? WHERE `id` = ?");

    // Bind parameters to the query
    $stmt->bind_param("sssssssssssssi", $company, $empnumber, $nameinitial, $department, $grade, $designation, $grade1, $designation1, $action, $dob1, $dob2, $doj, $remark, $user_id);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect on success
        header("Location: promoSearch.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
