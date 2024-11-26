<?php
include 'db_connect.php'; 

$company = $_POST['company'] ?? '';
$section = $_POST['section'] ?? '';


$query = "SELECT full_name, company, section, emp_num, ref_num, wef, nic, prior_notice,img, remark FROM clearance";

$conditions = [];
if (!empty($company)) {
    $conditions[] = "company= '" . mysqli_real_escape_string($con, $company) . "'";
}
if (!empty($section)) {
    $conditions[] = "section = '" . mysqli_real_escape_string($con, $section) . "'";
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
                    <td>{$row['full_name']}</td>
                    <td>{$row['company']}</td>
                    <td>{$row['section']}</td>
                    <td>{$row['emp_num']}</td>
                    <td>{$row['ref_num']}</td>
                    <td>{$row['wef']}</td>
                    <td>{$row['nic']}</td>
                    <td>{$row['prior_notice']}</td>
                    <td>{$row['img']}</td>

                  
                    <td>{$row['remark']}</td>
                   
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No records found for the selected filters.</td></tr>";
    }
}
?>
