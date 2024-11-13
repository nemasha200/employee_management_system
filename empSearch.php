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
        position: relative;
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
        position: relative;
        width: 20%;
        background-color: ghostwhite;
        left: 200px;
    }
    
    .text-whit {
        margin-left: 200px;
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
        <h3 class="text-whit">Employee Details</h3>

        <table id="tableID" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>NIC</th>
                    <th>EPF</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Job Title</th>
                    <th>View</th>
                    <th>Update</th>
                    <th>InActive</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getuser = mysqli_query($con, "SELECT empid, department, nic, epf, full_name, designation, job_title, isAct 
                                               FROM employer
                                               ORDER BY isAct DESC");

                if (!$getuser) {
                    echo "Error executing query: " . mysqli_error($con);
                } else {
                    while ($res_user = mysqli_fetch_array($getuser)) {
                        ?>
                        <tr>
                            <td><?php echo $res_user['department']; ?></td>
                            <td><?php echo $res_user['nic']; ?></td>
                            <td><?php echo $res_user['epf']; ?></td>
                            <td><?php echo $res_user['full_name']; ?></td>
                            <td><?php echo $res_user['designation']; ?></td>
                            <td><?php echo isset($res_user['job_title']) ? $res_user['job_title'] : 'N/A'; ?></td>
                            <td>
                                <a href="empView.php?user_id=<?php echo $res_user['empid']; ?>" class="btn btn-success">View</a>
                            </td>
                            <td>
                                <a href="empUpdate.php?user_id=<?php echo $res_user['empid']; ?>" class="btn btn-warning">Update</a>
                            </td>
                            <td>
                                <?php
                                if ($res_user['isAct'] == 1) {
                                    echo '<a href="toggleStatus.php?empid=' . $res_user['empid'] . '&status=0" class="btn btn-primary">Active</a>';
                                } else {
                                    echo '<a href="toggleStatus.php?empid=' . $res_user['empid'] . '&status=1" class="btn btn-danger">Deactive</a>';
                                }
                                ?>
                            </td>
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
<?php
}
?>
