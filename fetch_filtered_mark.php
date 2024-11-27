<?php
include 'db_connect.php'; 

$department = $_POST['department'] ?? '';



$query = "SELECT name, department, emp_num, evalu_mark, evalu_grade, remark FROM evaluation";

$conditions = [];
if (!empty($department)) {
    $conditions[] = "department= '" . mysqli_real_escape_string($con, $department) . "'";
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
                    <td>{$row['department']}</td>
                    <td>{$row['emp_num']}</td>
                    <td>{$row['evalu_mark']}</td>
                    <td>{$row['evalu_grade']}</td>
                    <td>{$row['remark']}</td> 
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found for the selected filters.</td></tr>";
    }
}
?>
