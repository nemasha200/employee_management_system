<?php
include 'db_connect.php';

// Get filter values
$company = $_POST['company'] ?? '';
$department = $_POST['department'] ?? '';
$emp_type = $_POST['emp_type'] ?? '';

// Start building the query
$query = "SELECT full_name, comp_num, department, emp_type, emp_num, nic, epf , initial_name, sex, marital_status, dob, permanat_address, current_address, qulifications, mobile, landnumber, office_number, doj, recruitment_type, designation, job_title, grade, last_promo, emp_status, vehicle_num, img, ot, remark1, remark2, remark3 FROM employer WHERE 1=1";

// Add filters to the query only if they are selected
if (!empty($company)) {
    $query .= " AND comp_num = '" . mysqli_real_escape_string($con, $company) . "'";
}
if (!empty($department)) {
    $query .= " AND department = '" . mysqli_real_escape_string($con, $department) . "'";
}
if (!empty($emp_type)) {
    $query .= " AND emp_type = '" . mysqli_real_escape_string($con, $emp_type) . "'";
}

// Execute the query
$result = mysqli_query($con, $query);

// Check for errors
if (!$result) {
    echo "<tr><td colspan='7'>Error: " . mysqli_error($con) . "</td></tr>";
} else {
    // Check if results exist
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['full_name']}</td>
                    <td>{$row['comp_num']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['emp_type']}</td>
                    <td>{$row['emp_num']}</td>
                    <td>{$row['nic']}</td>
                    <td>{$row['epf']}</td>
                  </tr>";
        }
    } else {
        // No results found
        echo "<tr><td colspan='7'>No records found for the selected filters.</td></tr>";
    }
}
?>
