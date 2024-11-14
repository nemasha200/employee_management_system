<?php
include './db_connect.php';

if (isset($_POST['fullName'])) {
    $fullName = $_POST['fullName'];

    $query = "SELECT full_name, emp_num, comp_num, department, nic FROM employer WHERE full_name = '$fullName'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Error fetching employee details']);
    }
}
?>
