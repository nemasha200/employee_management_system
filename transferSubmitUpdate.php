<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    $user_id = $_POST['user_id'];

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

    $query = "UPDATE `transfers` 
              SET `emp_num`='$empnumber',
                  `name`='$nameinitial',
                  `designation`='$designation',
                  `employment`='$employment',
                  `ex_department`='$exdepartment',
                  `ex_company`='$excompany',
                  `trans_department`='$transdep',
                  `trans_company`='$transcom',
                  `trans_designation`='$designation1',
                  `effect_date`='$dob1',
                  `req_date`='$dob2',
                  `approve_date`='$dob3',
                  `remark`='$remark' 
              WHERE `id`='$user_id'";

    mysqli_query($con, $query);

    header("Location: transferSearch.php");
    exit();
}
?>
