<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else { 
    include 'db_connect.php';

    $empnumber = $_POST['empnumber'];
    $nameinitial = $_POST['nameinitial'];
    $designation = $_POST['designation'];
    $employment = $_POST['employment'];
    $exdepartment = $_POST['exdepartment'];
    $excompany = $_POST['excompany'];
    $transdep = $_POST['transdep'];
    $transcom = $_POST['transcom'];
    $designation1 = $_POST['designation1'];
    $dob1 = $_POST['dob1'];
    $dob2 = $_POST['dob2'];
    $dob3 = $_POST['dob3'];
    $remark = $_POST['remark'];

    $insertTransQuery = "INSERT INTO `transfers` (`emp_num`, `name`, `designation`, `employment`, `ex_department`, `ex_company`, 
            `trans_department`, `trans_company`, `trans_designation`, `effect_date`, `req_date`, `approve_date`, `remark`) 
            VALUES ('$empnumber', '$nameinitial', '$designation', '$employment', '$exdepartment', '$excompany', 
            '$transdep', '$transcom', '$designation1', '$dob1', '$dob2', '$dob3', '$remark')";

    if (mysqli_query($con, $insertTransQuery)) { // Correct variable name here 
    // Update the employer table
        $updateEmployerQuery = "UPDATE employer 
                                SET comp_num = '$transcom', department = '$transdep', designation = '$designation1'
                                WHERE emp_num = '$empnumber'";

        if (mysqli_query($con, $updateEmployerQuery)) { // Properly handle the second query
            header("Location: transferSearch.php");
            exit();
        } else {
            echo "Error: " . $updateEmployerQuery . "<br>" . mysqli_error($con);
        }
    } else {
        echo "Error: " . $insertTransQuery . "<br>" . mysqli_error($con);
    }
} 
?>
