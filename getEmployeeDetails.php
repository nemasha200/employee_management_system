<?php
include './db_connect.php';

if (isset($_POST['nameinitial'])) {
    $name = $_POST['nameinitial'];

    $query = "SELECT emp_num, comp_num, department, doj, grade, designation, last_promo FROM employer WHERE full_name = '$name'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $employee = mysqli_fetch_assoc($result);
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Error fetching employee details']);
    }
}
?>