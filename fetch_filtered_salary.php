<?php
include 'db_connect.php'; 

$company_num = $_POST['company_num'] ?? '';
$department = $_POST['department'] ?? '';

$query = "SELECT name, company_num, department, epf, basic, bra, fa_travelling_amount, fa_budget_amount,
 fa_retravel_amount, fa_vehicle_amount, fa_fual_amount, fa_logging_amount, fa_attendance_amount, fa_travel_exp_amount, 
 fa_pettah_amount, fa_bakery_amount, fa_ insentive_amount, fd_welfare_amount, 
fd_medical_amount, fd_other1, fd_other2, fd_other3, payemnt, account_num, bank_name, branch_name FROM salary";

$conditions = [];
if (!empty($company_num)) {
    $conditions[] = "company_num = '" . mysqli_real_escape_string($con, $company_num) . "'";
}
if (!empty($department)) {
    $conditions[] = "department = '" . mysqli_real_escape_string($con, $department) . "'";
}


// Append conditions if any exist
if (count($conditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$result = mysqli_query($con, $query);

if (!$result) {
    echo "<tr><td colspan='7'>Error: " . mysqli_error($con) . "</td></tr>";
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td><input type='checkbox' class='select-checkbox'></td>
                    <td>{$row['name']}</td>
                    <td>{$row['company_num']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['epf']}</td>
                    <td>{$row['basic']}</td>
                    <td>{$row['bra']}</td>
                    <td>{$row['fa_travelling_amount']}</td>
                    <td>{$row['fa_budget_amount']}</td>
                    <td>{$row['fa_retravel_amount']}</td>
                    <td>{$row['fa_vehicle_amount']}</td>
                    <td>{$row['fa_fual_amount']}</td>
                    <td>{$row['fa_logging_amount']}</td>
                    <td>{$row['fa_attendance_amount']}</td>
                    <td>{$row['fa_travel_exp_amount']}</td> 
                    <td>{$row['fa_pettah_amount']}</td>
                    <td>{$row['fa_bakery_amount']}</td>
                    <td>{$row['fa_ insentive_amount']}</td>
                    <td>{$row['fd_welfare_amount']}</td>

                    <td>{$row['fd_medical_amount']}</td>
                    <td>{$row['fd_other1']}</td>
                    <td>{$row['fd_other2']}</td>
                    <td>{$row['fd_other3']}</td>
                    <td>{$row['payemnt']}</td>
                    <td>{$row['account_num']}</td>
                    <td>{$row['bank_name']}</td>
                    <td>{$row['branch_name']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='26'>No records found for the selected filters.</td></tr>";
    }
}
?>
