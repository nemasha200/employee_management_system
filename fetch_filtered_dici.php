<?php
include 'db_connect.php'; 

$name = $_POST['name'] ?? '';
$emp_num = $_POST['emp_num'] ?? '';

$query = "SELECT name, emp_num, reason, action, img, remark FROM discipline";

$conditions = [];
if (!empty($name)) {
    $conditions[] = "name= '" . mysqli_real_escape_string($con, $name) . "'";
}
if (!empty($emp_num)) {
    $conditions[] = "emp_num = '" . mysqli_real_escape_string($con, $emp_num) . "'";
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
                    <td>{$row['reason']}</td>
                    <td>{$row['action']}</td>
                    <td>{$row['img']}</td>
                    <td>{$row['remark']}</td>
                   
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found for the selected filters.</td></tr>";
    }
}
?>
