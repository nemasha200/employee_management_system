<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();
 

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}else{
?>
<?php 
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
.table {
            background-color: #32a9ad; /* Light cyan background for the table */
            position: relative;
            left: 175px;
        }
        
        .mainContainer {
            background-color: #b7ebed;
            width: 100vw;
            height: 100vh;
            display: flex;
            
        }
        
        .container {
           background-color: #b7ebed;
           padding: 20px;
           border-radius: 10px;
           /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        body {
            background-color: red; /* Red background color */
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .text-black {
            color: black !important; /* Set font color to black */
            margin-left: 600px;
        }
        .dataTables_length{
            position: relative;
            left: 200px;
        }
         .dataTables_filter{
            position: relative;
            left: 170px;
        }
        .dataTables_info{
            position: relative;
            left: 170px;
        }
        .dataTables_paginate{
            position: relative;
            left: 200px;
        }


       
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Details</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tableID').DataTable({
                searching: true
            });
        });
    </script>
</head>

<body>

<?php include 'submenubar.php';?>

<?php include 'logout.php';?> 

    <div class="mainContainer">
    <div class="container mt-5">
        <!-- <button class="back-button" onclick="window.history.back();">&larr;</button> -->
        <h1 class="text-black">Company Details</h1>
        <table id="tableID" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Company number</th>
                    <th>Company name</th>
                    <th>Location</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getuser = mysqli_query($con, "SELECT id, com_number, com_name, location FROM sub_company");
                while ($res_user = mysqli_fetch_array($getuser)) {
                    ?>
                    <tr>
                        <td><?php echo $res_user[1]; ?></td>
                        <td><?php echo $res_user[2]; ?></td>
                        <td><?php echo $res_user[3]; ?></td>
                        
                       
                        <td>
                            <a href="subcompanyUpdate.php?user_id=<?php echo $res_user['id']; ?>" class="btn btn-warning">Update</a>
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