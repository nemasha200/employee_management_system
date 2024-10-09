<?php
include './db_connect.php';

if (isset($_POST['empnumber'])) {
    $emp = $_POST['emp'];

    $query = "SELECT initial_name, department, company FROM employer WHERE emp_num = '$emp'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Error fetching employee details']);
    }
}
?>