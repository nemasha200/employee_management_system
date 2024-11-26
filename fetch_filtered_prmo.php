<?php
include 'db_connect.php'; 

$company = $_POST['company'] ?? '';
$department = $_POST['department'] ?? '';
$promo_action = $_POST['promo_action'] ?? '';

$query = "SELECT name, company, emp_num, department, doj, ex_grade, ex_designation, promo_grade, promo_designation, promo_action, promo_effect_date, last_promo_date, remark FROM promotion";

$conditions = [];
if (!empty($company)) {
    $conditions[] = "company= '" . mysqli_real_escape_string($con, $company) . "'";
}
if (!empty($department)) {
    $conditions[] = "department = '" . mysqli_real_escape_string($con, $department) . "'";
}
if (!empty($promo_action)) {
    $conditions[] = "promo_action = '" . mysqli_real_escape_string($con, $promo_action) . "'";
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
                    <td>{$row['company']}</td>
                    <td>{$row['emp_num']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['doj']}</td>
                    <td>{$row['ex_grade']}</td>
                    <td>{$row['ex_designation']}</td>
                    <td>{$row['promo_grade']}</td>
                    <td>{$row['promo_designation']}</td>
                    <td>{$row['promo_action']}</td>
                    <td>{$row['promo_effect_date']}</td>
                    <td>{$row['last_promo_date']}</td>
                    <td>{$row['remark']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='13'>No records found for the selected filters.</td></tr>";
    }
}
?>
