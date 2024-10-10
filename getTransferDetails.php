<?php
include './db_connect.php';

if (isset($_POST['empnumber'])) {
    $empnumber = $_POST['empnumber'];

    $query = "SELECT initial_name, designation, emp_status, department, comp_num FROM employer WHERE emp_num = '$empnumber'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Error fetching employee details']);
    }
}
?>

