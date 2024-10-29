<?php
include './db_connect.php';

if (isset($_POST['nameinitial'])) {
    $name = $_POST['nameinitial'];

    $query = "SELECT full_name, emp_num FROM employer WHERE full_name = '$name'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Error fetching employee details']);
    }
}
?>

