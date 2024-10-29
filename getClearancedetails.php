<?php
include './db_connect.php';

if (isset($_POST['fullName'])) {
    $emp = $_POST['fullName'];

    $query = "SELECT full_name, emp_num, comp_num, department,  designation, FROM employer WHERE full_name = '$emp'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Error fetching employee details']);
    }
}
?>

