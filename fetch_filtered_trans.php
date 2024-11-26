<?php
include 'db_connect.php'; 

$company = $_POST['company'] ?? '';
$department = $_POST['department'] ?? '';
$employment = $_POST['employment'] ?? '';

$query = "SELECT name, emp_num,  employment, ex_company, ex_department, designation ,trans_company ,trans_department , trans_designation, effect_date, req_date, 
approve_date, remark FROM transfers";

$conditions = [];
if (!empty($company)) {
    $conditions[] = "ex_company = '" . mysqli_real_escape_string($con, $company) . "'";
}
if (!empty($department)) {
    $conditions[] = "ex_department = '" . mysqli_real_escape_string($con, $department) . "'";
}
if (!empty($employment)) {
    $conditions[] = "employment = '" . mysqli_real_escape_string($con, $employment) . "'";
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
                    <td>{$row['emp_num']}</td>
                    <td>{$row['employment']}</td>
                    <td>{$row['ex_company']}</td>
                    <td>{$row['ex_department']}</td>
                    <td>{$row['designation']}</td>
                    <td>{$row['trans_company']}</td>
                    <td>{$row['trans_department']}</td>
                    <td>{$row['trans_designation']}</td>
                    <td>{$row['effect_date']}</td>
                    <td>{$row['req_date']}</td>
                    <td>{$row['approve_date']}</td>
                    <td>{$row['remark']}</td>

                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found for the selected filters.</td></tr>";
    }
}
?>
