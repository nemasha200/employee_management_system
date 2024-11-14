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
    <meta charset="UTF-8">
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
            border-radius: 4px;
            border: none;
            color: white;
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
            background-color: #007bff;
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
            background-color: purple;
        }

        .btn-success {
    
    margin-top: 30px; /* Adjust this value to move the button further down */
}

    </style>
</head>
<body>

<?php include 'submenubar.php'; ?> 
<?php include 'logout.php'; ?> 


<div class="form-container">
    <h2><center>Employee Reports</center></h2>

    <button class="btn btn-all" onclick="window.location.href='emp.php'">All Deatils</button>


    <div class="form-row">

    <div class="form-group col-md-5">
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
</div>

    <div class="form-group col-md-3">
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
       

    
    <div class="form-group col-md-3">
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
</div>

<div class="form-group col-md-7">
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
</div>

</div>
  
    <button class="btn btn-get-report" onclick="window.location.href='emp.php'">Get Report</button>
   
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                    <th>Column 3</th>
                    <th>Column 4</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Data 1</td>
                    <td>Data 2</td>
                    <td>Data 3</td>
                    <td>Data 4</td>
                </tr>
               
            </tbody>
        </table>
    </div>

    <button class="btn btn-success" onclick="downloadTableAsCSV()">Download CSV</button>
    <button class="btn-print" onclick="window.print()">Print</button>
</div>

<script>
function downloadTableAsCSV() {
    let csv = [];
    const rows = document.querySelectorAll("table tr");

    for (let row of rows) {
        let rowData = [];
        for (let cell of row.querySelectorAll("th, td")) {
            rowData.push(cell.innerText.replace(/,/g, "")); // Remove commas to avoid CSV formatting issues
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