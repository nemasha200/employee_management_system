
<?php
include 'db_connect.php';

$company = $_POST['company'] ?? '';
$department = $_POST['department'] ?? '';
$emp_type = $_POST['emp_type'] ?? '';

$query = "SELECT full_name, comp_num, department, emp_type, emp_num, nic, epf , initial_name, sex, marital_status, dob, permanat_address, 
current_address, qulifications, mobile, landnumber, office_number, doj, recruitment_type, designation, job_title, grade, last_promo, emp_status,
 vehicle_num, img, ot, remark1, remark2, remark3 FROM employer WHERE 1=1";

if (!empty($company)) {
    $query .= " AND comp_num = '" . mysqli_real_escape_string($con, $company) . "'";
}
if (!empty($department)) {
    $query .= " AND department = '" . mysqli_real_escape_string($con, $department) . "'";
}
if (!empty($emp_type)) {
    $query .= " AND emp_type = '" . mysqli_real_escape_string($con, $emp_type) . "'";
}

$result = mysqli_query($con, $query);

if (!$result) {
    echo "<tr><td colspan='7'>Error: " . mysqli_error($con) . "</td></tr>";
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td><input type='checkbox' class='select-checkbox'></td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['comp_num']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['emp_type']}</td>
                    <td>{$row['emp_num']}</td>
                    <td>{$row['nic']}</td>
                    <td>{$row['epf']}</td>
                    <td>{$row['initial_name']}</td>
                    <td>{$row['sex']}</td>
                    <td>{$row['marital_status']}</td>
                    <td>{$row['dob']}</td>
                    <td>{$row['permanat_address']}</td>
                    <td>{$row['current_address']}</td>
                    <td>{$row['qulifications']}</td>
                    <td>{$row['mobile']}</td>
                    <td>{$row['landnumber']}</td>
                    <td>{$row['office_number']}</td>
                    <td>{$row['doj']}</td>
                    <td>{$row['recruitment_type']}</td>
                    <td>{$row['designation']}</td>
                    <td>{$row['job_title']}</td>
                    <td>{$row['grade']}</td>
                    <td>{$row['last_promo']}</td>
                    <td>{$row['emp_status']}</td>
                    <td>{$row['vehicle_num']}</td>
                    <td>{$row['img']}</td>
                    <td>{$row['ot']}</td>
                    <td>{$row['remark1']}</td>
                    <td>{$row['remark2']}</td>
                    <td>{$row['remark3']}</td>
                    
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found for the selected filters.</td></tr>";
    }
}
?>
