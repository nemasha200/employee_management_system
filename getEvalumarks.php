<?php
include './db_connect.php';

if (isset($_POST['nameinitial'])) {
    $emp = $_POST['nameinitial'];

    $query = "SELECT full_name, department, company FROM employer WHERE full_name = '$emp'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Error fetching employee details']);
    }
}
?>