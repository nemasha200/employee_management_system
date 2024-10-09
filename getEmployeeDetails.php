<?php
include './db_connect.php';

if (isset($_POST['empnumber'])) {
    $empnumber = $_POST['empnumber'];

    $query = "SELECT initial_name, comp_num, department FROM employer WHERE emp_num = '$empnumber'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Error fetching employee details']);
    }
}
?>
