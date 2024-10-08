<?php
include 'db_connect.php';

// Total capacity (assume you have this value, you can replace it with your actual value)
$total_capacity = 1000;

$result = mysqli_query($con, "SELECT COUNT(*) AS total FROM emp_register");
$row = mysqli_fetch_assoc($result);
$total = $row['total'];

echo json_encode(['total' => $total, 'total_capacity' => $total_capacity]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Employees</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body {
            background-color: #ffc0cb; /* Pink background color */
        }

        .container {
            margin-top: 50px;
        }

        .percentage-bar {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 25px;
            overflow: hidden;
            margin-top: 10px;
        }

        .percentage-fill {
            height: 25px;
            background-color: #007bff;
            width: 0;
            text-align: center;
            color: white;
            line-height: 25px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Total Registered Employees: <span id="totalEmployees">0</span></h1>
        <div class="percentage-bar">
            <div class="percentage-fill" id="percentageFill">0%</div>
        </div>
    </div>

    <script>
        function fetchTotalEmployees() {
            $.ajax({
                url: 'get_total_employees.php',
                method: 'GET',
                success: function(response) {
                    const data = JSON.parse(response);
                    const total = data.total;
                    const totalCapacity = data.total_capacity;
                    const percentage = (total / totalCapacity) * 100;

                    $('#totalEmployees').text(total);
                    $('#percentageFill').css('width', percentage + '%').text(percentage.toFixed(2) + '%');
                },
                error: function(error) {
                    console.error('Error fetching total employees:', error);
                }
            });
        }

        // Fetch total employees on page load
        $(document).ready(function() {
            fetchTotalEmployees();
        });

        // Optionally, you can set an interval to refresh the total count every few seconds
        setInterval(fetchTotalEmployees, 10000); // Refresh every 10 seconds
    </script>
</body>
</html>
