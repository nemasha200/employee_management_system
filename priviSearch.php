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

<?php
include 'db_connect.php';
?>

<head>
    <style>

        .MainContainer{
            width: 100vw;
            height: 100vh;
            display: flex;
            position: relative;
           

        }

        .Container{
           padding: 20px;
           border-radius: 10px;
           /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }
        .table {
            background-color: burlywood; 
        }

        body {
            background-image: url("img1.jpg");
            padding: 20px;
            position: relative;
        }

        .text-black {
            color: black !important; 
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
        
   

    /* Set search bar background color to white */
    .dataTables_filter input {
        background-color: white !important;
        color: white;
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
    .btn-delete {
    background-color: green;
    color: white;
    border: none;
    padding: 5px 15px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-delete:hover {
    background-color: darkgreen;
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
<!-- <?php include 'submenubar.php';?> -->
<?php include 'logout.php';?>


    <div class="MainContainer">

    <div class="container mt-5">
        <h1 class="text-black">Privileges Details</h1>
        <table id="tableID" class="table table-striped table-bordered">
            <thead>
                <tr>

                    <th>username</th>
                    <th>user type</th>

                    

                    
                    

                    <th>View</th>
                    <th>Update</th>
                    <th>Delete</th>



                
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $getuser = mysqli_query($con, "SELECT admin_id, title, first_name, last_name, department, nic, email, contact, type, username, password, con_password FROM user");


                while ($res_user = mysqli_fetch_array($getuser)) {
                    ?>
                    <tr>
                        <td><?php echo $res_user[9]; ?></td>
                        <td><?php echo $res_user[8]; ?></td>

                       

                        

                        
                        
                        <td>
                            <a href="priviView.php?user_id=<?php echo $res_user['admin_id']; ?>" class="btn btn-warning">View</a>
                        </td>
                        <td>
                            <a href="userpriviUpdate.php?user_id=<?php echo $res_user['admin_id']; ?>" class="btn btn-danger">Update</a>
                        </td>
                        <td>
                            <a href="priviDelete.php?user_id=<?php echo $res_user['admin_id']; ?>" class="btn btn-warning">Delete</a>
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