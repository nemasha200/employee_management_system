<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
?>
<?php 
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
    .mainContainer {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center; /* Center content horizontally */
        align-items: flex-start; /* Align content to the top */
    }
    
    .container {
       padding: 20px;
       border-radius: 10px;
       margin-top: 10px; /* Reduce the gap from the top */
    }
    .table {
        background-color: #32a9ad;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: gainsboro;
    }

    .text-black {
        color: black !important;
    }

    .btn-view {
        background-color: green;
        border: none;
        color: white;
    }

    .btn-view:hover {
        background-color: darkgreen;
    }

    .dataTables_filter input {
        background-color: white !important;
    }

    .btn-small {
        padding: 5px 15px;
        font-size: 1rem;
    }

    .btn-medium {
        padding: 5px 15px;
        font-size: 1rem;
    }

    .btn-large {
        padding: 5px 15px;
        font-size: 1rem;
    }

    .form-inline {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 15px;
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
            searching: false // Disable default searching, as we're handling it server-side
        });
    });
</script>
</head>

<body>

<?php include 'submenubar.php';?>
<?php include 'logout.php';?>

<div class="mainContainer">
    <div class="container">
        <h1 class="text-black">Clearance Details</h1>
        
        <!-- Search form aligned to the right -->
        <form method="GET" action="" class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="search" class="form-control" placeholder="Search Employee Details" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>

        <!-- Table -->
        <table id="tableID" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Emp number</th>
                    <th>Emp type</th>
                    <th>Company</th>

                    <th>Department</th>
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
                    $getuser = mysqli_query($con, "SELECT id, emp_num, emptype ,company_num, section , fullname   FROM clearance 
                                                   WHERE emp_num LIKE '%$searchTerm%' 
                                                   OR emptype LIKE '%$searchTerm%' 

                                                   OR name LIKE '%$searchTerm%' 
                                                   OR company_num LIKE '%$searchTerm%' 
                                                   OR department LIKE '%$searchTerm%'");
                } else {
                    $getuser = mysqli_query($con, "SELECT id,  emp_num, emptype , company_num, section , fullname FROM clearance");
                }

                while ($res_user = mysqli_fetch_array($getuser)) {
                    ?>
                    <tr>
                        <td><?php echo $res_user['emp_num']; ?></td>
                        <td><?php echo $res_user['emptype']; ?></td>
                        <td><?php echo $res_user['company_num']; ?></td>

                        <td><?php echo $res_user['section']; ?></td>
                        <td><?php echo $res_user['fullname']; ?></td>
                        <td>
                            <a href=".php?user_id=<?php echo $res_user['id']; ?>" class="btn btn-danger">View</a>
                        </td>
                        <td>
                            <a href=".php?user_id=<?php echo $res_user['id']; ?>" class="btn btn-warning">Update</a>
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
