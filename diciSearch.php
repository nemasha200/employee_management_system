<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
    /* General styles */
    .mainContainer {
        width: 100vw;
        height: 100vh;
        display: flex;
        padding: 1rem;
        justify-content: center; /* Center content horizontally */
        align-items: flex-start; /* Align content to the top */
    }
    
    .container {
       padding: 20px;
       border-radius: 10px;
       margin-top: 10px; /* Reduce the gap from the top */
    }
    
    .table {

        height: 70%;
        background-color: ghostwhite;
        margin-left: 200px;
        position: relative;
        left: 200px;
    }
    
    .text-whit {
        margin-left: 600px;
        color: white;
    }

    body {
        margin: 0;
        padding: 0;
        background-image: url("black.jpg");   
    }

    .table th {
        background-color: darkgrey;
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
            color: white; 
            font-weight: bold;
            position: relative;
        left: 200px;
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
            left: 200px;
        }

       .dataTables_info{
            position: relative;
            left: 200px;
            color: white;
        }
        .btn-primary{
            background-color: blue;
        }

        .btn-danger{
            background-color: purple;
        }
</style>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Details</title>

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
<?php include 'submenubar.php'; ?>
<?php include 'logout.php'; ?>

<div class="mainContainer">
    <div class="container">
        <h3 class="text-whit">Diciplinary Details</h3>

        <table id="tableID" class="table table-striped table-bordered">
            <thead>
                <tr>
                     <th>Employee number</th>
                    <th>Name</th>
                   

                    <th>View</th>
                    <th>Update</th>
                </tr>
            </thead>
         <tbody>
                <?php
                // Initialize the search term
                $searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

                // Modify the query based on the search term
                if (!empty($searchTerm)) { 
                    $getuser = mysqli_query($con, "SELECT id, emp_num, name FROM  discipline
                                                   WHERE emp_num LIKE '%$searchTerm%' 
                                                   OR name LIKE '%$searchTerm%'");
                } else {
                    $getuser = mysqli_query($con, "SELECT id,  emp_num, name FROM  discipline");
                }

                while ($res_user = mysqli_fetch_array($getuser)) {
                    ?>
                    <tr>
                       
                        <td><?php echo $res_user['emp_num']; ?></td>

                        <td><?php echo $res_user['name']; ?></td>

                        <td>
                            <a href="diciView.php?user_id=<?php echo $res_user['id']; ?>" class="btn btn-danger" style="background-color: green">View</a>
                        </td>
                        <td>
                            <a href="diciUpdate.php?user_id=<?php echo $res_user['id']; ?>" class="btn btn-warning">Update</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
  </div>
</div>
</body>

</html>
<?php
}
?>
