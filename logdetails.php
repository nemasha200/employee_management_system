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
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<style>
    .table {
        background-color: #32a9ad; /* Light cyan background for the table */
    }

    body {
        /* background-color: #daf4f5; */
        padding: 20px;
        position: relative;
        background: url("hey.jpg") ;
    }

    .text-success {
        color: black !important; /* Set font color to black */
    }

    .table-container {
        margin-left: 0;
    }

    @media (max-width: 767px) {
        .table-container {
            overflow-x: auto;
        }
    }

    .btn-back {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px 20px;
            background-color: #a62411;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #495057;
            color: white;
        }

    .table th,
    .table td {
        color: black; /* Set font color to black */
    }

    .header-container {
        position: relative;
        margin-bottom: 20px; /* Space between header and table */
    }

    .btn-view {
        background-color: green;
        border: none;
        color: white;
    }

    .btn-view:hover {
        background-color: darkgreen;
    }

    /* Set search bar background color to white */
    .dataTables_filter input {
        background-color: white !important;
    }

    /* New styles for button sizes */
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

    /* Alternating row colors */
    .table tbody tr:nth-child(odd) {
        background-color: gainsboro;
    }

    .table tbody tr:nth-child(even) {
        background-color: lemonchiffon;
    }

    /* Update button background color */
    .btn-update {
        background-color: #f5b82a;
        border: none;
        color: black;
    }

    .btn-update:hover {
        background-color: darkyellow;
    }

    /* Active button styles */
    .btn-active-active {
        background-color: #f53193;
    }

    .btn-active-inactive {
        background-color: black;
        color: white;
    }

</style>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Details</title>

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
<!-- <a href="menubar.php" class="btn-back">Back</a> -->
<!-- <?php include 'submenubar.php';?> -->

<?php include 'logout.php';?> 


    <div class="header-container">
    </div>
    
    <h1 class="text-success">Login Details</h1>

    <div class="table-container">
        <table id="tableID" class="table table-bordered ">
            <thead>
                <tr>
                    <th>title</th>
                    <th> first_name</th>
                    <th>last_name</th>
                    <th>department</th>
                    <th>nic</th>
                    <th>email</th>
                    <th>contact</th>
                    <th>type</th>
                    <th>username</th>
                    <th>password</th>
                    <th>con_password</th>
                   
            </thead>
            <tbody>
                <?php
               $getuser = mysqli_query($con, "SELECT admin_id, title, first_name, last_name, department, nic, email, contact, type, username, password,con_password FROM user");
                
               while ($res_user = mysqli_fetch_array($getuser)) {
                   
                    ?>
                    <tr>
                        <td><?php echo $res_user['title']; ?></td>
                        <td><?php echo $res_user['first_name']; ?></td>
                        <td><?php echo $res_user['last_name']; ?></td>
                        <td><?php echo $res_user['department']; ?></td>
                        <td><?php echo $res_user['nic']; ?></td>
                        <td><?php echo $res_user['email']; ?></td>
                        <td><?php echo $res_user['contact']; ?></td>
                        <td><?php echo $res_user['type']; ?></td>
                        <td><?php echo $res_user['username']; ?></td>
                        <td><?php echo $res_user['password']; ?></td>
                        <td><?php echo $res_user['con_password']; ?></td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php
}
?>