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
        background-color: #95bfbc;
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
    <h2><center><u>Disciplinary Reports <img src="xl.png" alt="Logo" class="logo"></u></center></h2>

    <!-- <button class="btn btn-all" onclick="window.location.href='emp.php'">All Deatils</button> -->


    <div class="form-row">

    <!-- <div class="form-group col-md-5">
<label for="dropdown">Company :<span style="color:red">*</span></label>
<select class="form-control" id="dropdown" name="company">
    <option value="" disabled selected>Select an option</option>
    <?php 
    $getEmp = mysqli_query($con,"SELECT * FROM  sub_company");
    while ($resCom = mysqli_fetch_array($getEmp)) {
        ?>

    <option value="<?php echo $resCom['com_number'] ?>"><?php echo $resCom['com_number']."/".$resCom['com_name']."/".$resCom['location'] ?></option>

        <?php
    }
?>
        </select>
</select>
</div> -->

    <!-- <div class="form-group col-md-3">
        <label for="department">Department :<span style="color:red">*</span></label>
        <select class="form-control" id="department" name="department">
        <option value="" disabled selected>Select an option</option>


        <?php 
    $getEmp = mysqli_query($con,"SELECT * FROM  sub_department");
    while ($resDep = mysqli_fetch_array($getEmp)) {
        ?>
    <option value="<?php echo $resDep['dep_name'] ?>"><?php echo $resDep['dep_name'] ?></option>

        <?php
    }
?>
        </select>


    </div>
        -->

    
    <!-- <div class="form-group col-md-3">
<label for="dropdown">NIC Number :<span style="color:red">*</span></label>
<select class="form-control" id="dropdown" name="company">
    <option value="" disabled selected>Select an option</option>
    <?php 
    $getEmp = mysqli_query($con,"SELECT nic FROM  employer");
    while ($resCom = mysqli_fetch_array($getEmp)) {
        ?>

    <option value="<?php echo $resCom['nic'] ?>"><?php echo $resCom['nic'] ?></option>

        <?php
    }
?>
        </select>
</select>
</div> -->

<!-- <div class="form-group col-md-5">
<label for="fullNameInitials">Full Name :</label>
                <select class="form-control" class="form-control" id="fullNameInitials" name="nameinitial"> 
               
                    <option value="" disabled selected>Select an option</option>
                    <?php 
                    $getEmp = mysqli_query($con,"SELECT full_name FROM  employer WHERE isAct ='1'");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                    <option value="<?php echo $resCom['full_name'] ?>"><?php echo $resCom['full_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>   
</div> -->

</div>
<button class="btn btn-success" onclick="downloadTableAsCSV()">Download Excell sheet <img src="ex.png" alt="Logo" class="logo"></button>

  
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
<div class="container">
        <table id="tableID" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Department</th>
                    <th>Employee Type</th>
                    <th>Employee Number</th>
                    <th>NIC</th>
                    <th>EPF</th>
                    <th>Full Name</th>
                    <th>Initial Name</th>
                    <th>Sex</th>
                    <th>Marital Status</th>
                    <th>Date Of Birth</th>
                    <th>Permanent Address</th>
                    <th>Current Address</th>
                    <th>Qualifications</th>
                    <th>Mobile Number</th>
                    <th>Land Number</th>
                    <th>Office Number</th>
                    <th>Date Of Join</th>
                    <th>Recruitment Type</th>
                    <th>Designation</th>
                    <th>Job Title</th>
                    <th>Grade</th>
                    <th>Last Promotion Date</th>
                    <th>Employee Status</th>
                    <th>Vehicle Number</th>
                    <th>Image</th>
                    <th>OT</th>
                    <th>Remark1</th>
                    <th>Remark2</th>
                    <th>Remark3</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getuser = mysqli_query($con, "SELECT empid, comp_num, department, emp_type, emp_num, nic, epf, full_name, initial_name, sex, marital_status, dob, permanat_address, current_address, qulifications, mobile, landnumber, office_number, doj, recruitment_type, designation, job_title, grade, last_promo, emp_status, vehicle_num, img, ot, remark1, remark2, remark3 
                                               FROM employer
                                               ORDER BY isAct DESC");
      
                if (!$getuser) {
                    echo "Error executing query: " . mysqli_error($con);
                } else {
                    while ($res_user = mysqli_fetch_array($getuser)) {
                        ?>
                        <tr>
                            <td><?php echo $res_user['comp_num']; ?></td>
                            <td><?php echo $res_user['department']; ?></td>
                            <td><?php echo $res_user['emp_type']; ?></td>
                            <td><?php echo $res_user['emp_num']; ?></td>
                            <td><?php echo $res_user['nic']; ?></td>
                            <td><?php echo $res_user['epf']; ?></td>
                            <td><?php echo $res_user['full_name']; ?></td>
                            <td><?php echo $res_user['initial_name']; ?></td>
                            <td><?php echo $res_user['sex']; ?></td>
                            <td><?php echo $res_user['marital_status']; ?></td>
                            <td><?php echo $res_user['dob']; ?></td>
                            <td><?php echo $res_user['permanat_address']; ?></td>
                            <td><?php echo $res_user['current_address']; ?></td>
                            <td><?php echo $res_user['qulifications']; ?></td>
                            <td><?php echo $res_user['mobile']; ?></td>
                            <td><?php echo $res_user['landnumber']; ?></td>
                            <td><?php echo $res_user['office_number']; ?></td>
                            <td><?php echo $res_user['doj']; ?></td>
                            <td><?php echo $res_user['recruitment_type']; ?></td>
                            <td><?php echo $res_user['designation']; ?></td>
                            <td><?php echo $res_user['job_title']; ?></td>
                            <td><?php echo $res_user['grade']; ?></td>
                            <td><?php echo $res_user['last_promo']; ?></td>
                            <td><?php echo $res_user['emp_status']; ?></td>
                            <td><?php echo $res_user['vehicle_num']; ?></td>
                            <td><?php echo $res_user['img']; ?></td>
                            <td><?php echo $res_user['ot']; ?></td>
                            <td><?php echo $res_user['remark1']; ?></td>
                            <td><?php echo $res_user['remark2']; ?></td>
                            <td><?php echo $res_user['remark3']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
</div>
</div>
</body>

</html>

    <!-- <button class="btn-print" onclick="window.print()">Print</button> -->
</div>


<script>
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