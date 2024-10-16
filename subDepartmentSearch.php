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
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #343a40;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #495057;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>

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
<div class="mainContainer">
    <div class="container">
        <h1 class="text-black">Department Details</h1>
        <table id="tableID" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Department Number</th>
                    <th>Department Name</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getuser = mysqli_query($con, "SELECT sub_dep_id, dep_num , dep_name FROM sub_department");
                while ($res_user = mysqli_fetch_array($getuser)) {
                    ?>
                    <tr>
                        <td><?php echo $res_user[1]; ?></td>
                        <td><?php echo $res_user[2]; ?></td>
                       
                     
                        <td>
                            <a href="subDepartmentUpdate.php?user_id=<?php echo $res_user['sub_dep_id']; ?>" class="btn btn-warning">Update</a>
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