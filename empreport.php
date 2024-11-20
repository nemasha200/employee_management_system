<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
?>

<!DOCTYPE html>
<html lang="en">

<?php 
include 'db_connect.php';
?>

<head>
    <meta charset="UTF-12">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Reports Form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: darkgrey;
            margin: 0;
            display: flex;
            background-image: url("black.jpg");
            overflow-x: hidden; 
        }
        .form-container {
    background-color: whitesmoke;
    padding: 30px;
    border-radius: 10px;
    border-color: black;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 1000px;
    overflow-y: auto;
    margin-left: 500px;
    margin-top: 70px; /* Add margin-top to push it down */
}

            
        
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container .btn {
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            border: none;
            color: white;
            background-color: green;
        }
        .btn-all {
            background-color: #007bff;
        }
        .form-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        .form-row input[type="text"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #be9fce;
            color: white;
        }
        .btn-print {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            border: none;
            color: white;
            margin-top: 20px;
        }

        .btn-all {
    padding: 0.2em 0.5em;
    width: auto; 
    min-width: auto;
    text-align: center;
}

.btn-all {
            background-color: red;
        }
        .btn-get-report {
            background-color: red;
        }

        .btn-success {
    background-color: green;
    
    margin-top: 30px; /* Adjust this value to move the button further down */
}
.btn-success:hover{
    background-color: red;
}

.table th {
        background-color: #b69dcc;
        color: black;
    }

    .text-black {
        color: black !important;
    }

    .dataTables_filter input {
        background-color: white !important;
    }
    


    .dataTables_filter label {
            display: flex;
            align-items: center;
            color: black; 
            font-weight: bold;
            position: relative;
        left: 40px;
        }

        .dataTables_filter input {
            background-color: #f0f0f0 !important; 
            border: 1px solid #ccc !important; 
            border-radius: 4px;
            padding: 5px;
            margin-left: 10px;
        }

        .dataTables_length label {
            display: flex;
            align-items: center;
            color: white; 
            font-weight: bold;
            position: relative;
        left: 200px;
        }

        .dataTables_length select {
            background-color: #f0f0f0 !important; 
            border: 1px solid #ccc !important; 
            border-radius: 4px;
            padding: 5px;
            margin-left: 10px;
        }
              
                .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
        }

        .dataTables_wrapper .dataTables_length {
            float: left;
        }
        .dataTables_paginate{
            position: relative;
            left: 50px;
        }
        .dataTables_info{
            position: relative;
            left: 20px;
            color: white;
        }
        .btn-primary{
            background-color: blue;
        }

        .btn-danger{
            background-color: purple;
        }
        .dataTables_length label {
            color: black;
            left: 20px;
        }

    </style>
</head>

<body>

<?php include 'submenubar.php'; ?> 
<?php include 'logout.php'; ?> 


<div class="form-container">
<h2 class="text-center"><u>Employee Reports</u></h2>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="company">Company:<span style="color:red">*</span></label>
            <select class="form-control" id="company" name="company">
                <option value="">Select an option</option>
                <?php 
                $getEmp = mysqli_query($con, "SELECT * FROM sub_company");
                while ($resCom = mysqli_fetch_array($getEmp)) { ?>
                    <option value="<?php echo $resCom['com_number']; ?>">
                        <?php echo $resCom['com_number'] . " / " . $resCom['com_name'] . " / " . $resCom['location']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="department">Department:<span style="color:red">*</span></label>
            <select class="form-control" id="department" name="department">
                <option value="">Select an option</option>
                <?php 
                $getEmp = mysqli_query($con, "SELECT * FROM sub_department");
                while ($resDep = mysqli_fetch_array($getEmp)) { ?>
                    <option value="<?php echo $resDep['dep_name']; ?>"><?php echo $resDep['dep_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="emp_type">Employee Type:<span style="color:red">*</span></label>
            <select class="form-control" id="emp_type" name="emp_type">
                <option value="">Select an option</option>
                <?php 
                $getEmp = mysqli_query($con, "SELECT DISTINCT emp_type FROM employer");
                while ($resCom = mysqli_fetch_array($getEmp)) { ?>
                    <option value="<?php echo $resCom['emp_type']; ?>"><?php echo $resCom['emp_type']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button class="btn btn-success" id="filterBtn">Generate report</button>

        <button class="btn btn-success" onclick="downloadTableAsCSV()">Download Excel Sheet</button>
    </div>


  
    <!-- <button class="btn btn-get-report" onclick="window.location.href='#'">Get Report</button> -->
   
  

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script>
    $(document).ready(function () {
        $('#tableID').DataTable({
            searching: true,
            paging: true
        });
    });
</script>
</head>

<body>
<!-- <?php include 'submenubar.php'; ?>
<?php include 'logout.php'; ?> -->

<div class="mainContainer">
<div class="container mt-4">
    <table id="tableID" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Company</th>
                <th>Department</th>
                <th>Employee Type</th>
                <th>Employee Number</th>
                <th>NIC</th>
                <th>EPF</th>
            </tr>
        </thead>
        <tbody id="reportBody">
        </tbody>
    </table>
</div>
</div>
</body>

</html>

    <!-- <button class="btn-print" onclick="window.print()">Print</button> -->
</div>


<script>
    //me function eken tama filter karanne data, ajax use karala
$(document).ready(function () {
    $('#filterBtn').click(function () {
        const company = $('#company').val();
        const department = $('#department').val();
        const empType = $('#emp_type').val();

        $.ajax({
            url: 'fetch_filtered_data.php',
            method: 'POST',
            data: { company, department, empType },
            success: function (response) {
                $('#reportBody').html(response);
            },
            error: function () {
                Swal.fire('Error', 'Failed to fetch data. Try again later.', 'error');
            }
        });
    });
});



function downloadTableAsCSV() {
    let csv = [];
    const rows = document.querySelectorAll("table tr");

    for (let row of rows) {
        let rowData = [];
        for (let cell of row.querySelectorAll("th, td")) {
            rowData.push(cell.innerText.replace(/,/g, "")); 
        }
        csv.push(rowData.join(","));
    }

    // Convert to CSV format
    const csvString = csv.join("\n");
    const blob = new Blob([csvString], { type: "text/csv" });
    const url = URL.createObjectURL(blob);

    // Create a download link and click it
    const downloadLink = document.createElement("a");
    downloadLink.href = url;
    downloadLink.download = "employee_data.csv";
    downloadLink.click();
}
</script>


</body>
</html>
<?php
}
?>