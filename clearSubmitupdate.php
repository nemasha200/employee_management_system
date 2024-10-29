<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}

// Include database connection
include 'db_connect.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $empnumber = mysqli_real_escape_string($con, $_POST['empnumber']);
    $refnumber = mysqli_real_escape_string($con, $_POST['refnumber']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $employeeType = mysqli_real_escape_string($con, $_POST['employeeType']);
    $company = mysqli_real_escape_string($con, $_POST['company']);
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $priorNotice = isset($_POST['headerGiven']) ? implode(',', $_POST['headerGiven']) : '';
    $remark = mysqli_real_escape_string($con, $_POST['remark']);

    // Update the clearance details in the database
    $query = "UPDATE clearance SET
                ref_num='$refnumber',
                wef='$dob',
                emptype='$employeeType',
                company_num='$company',
                fullname='$fullName',
                section='$section',
                designation='$designation',
                prior_notice='$priorNotice',
                remark='$remark'
              WHERE emp_num='$empnumber'"; // Assuming emp_num is the primary key

    if (mysqli_query($con, $query)) {
        // Redirect to a confirmation page or the updated clearance view
        header("Location: clearSearch.php?success=1"); // Redirect with success message
        exit();
    } else {
        // Handle error (you can redirect to an error page or show a message)
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    // If the form is not submitted properly, redirect back
    header("Location: clearUpdate.php");
    exit();
}

// Close the database connection
mysqli_close($con);
?>
