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

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $getuser = mysqli_query($con, "SELECT * FROM discipline WHERE id='$user_id'");
    $res_user = mysqli_fetch_array($getuser);

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinary Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: #dadce3;
            background-image: url("black.jpg");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            display: flex;
            width: 100%;
            height: 100%;
        }

        
        .form-container {
            margin-left: 250px; /* Adjusted for sidebar width */
            padding: 30px;
            background-color: lightblue;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px); /* Adjust width for sidebar */
            max-width: 800px;
            margin: auto;
        }

        .form-control {
            color: white;
            background-color: #343a40;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        .form-group label {
            color: #343a40;
        }

        .btn-primary {
            background-color: #a62411;
            border: none;
            display: block;
            margin: 0 auto;
        }

        .btn-primary:hover {
            background-color: #c82333;
        }

        .btn-small {
            padding: 5px 10px;
            font-size: 0.875rem;
            width: 150px;
            display: block;
            margin: 20px auto 0;
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

        #fullNameInitials,
        #emp,
        #reason,
        #remark{
            color: black;
            background-color: white;
        }
    </style>
</head>
<body>
    
<?php include 'submenubar.php';?>

<div class="container form-container">
            <h2 class="text-center">Disciplinary Actions Form</h2>
            
            <form id="registrationForm" method="POST" action="diciSave.php" enctype="multipart/form-data">

            
            <div class="form-row">

            <div class="form-group col-md-8">
                            <label for="fullNameInitials">Name with Initials :</label>
                            <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" value="<?php echo $res_user['name']; ?>" readonly>
            </div>
            
            <div class="form-group col-md-4">
                    <label for="emp">Employee Number :</label>
                    <input type="text"  class="form-control" id="emp" name="empnumber" value="<?php echo $res_user['emp_num']; ?>" readonly>
                </div> 

           

            


            </div>

            <div class="form-row">
            
            <div class="form-group col-md-12">
                            <label for="fullNameInitials">Disciplinary issue :</label>
                            <input type="text" class="form-control" id="fullNameInitials" name="reason" value="<?php echo $res_user['reason']; ?>" readonly>
            </div>
</div>

<div class="form-row">
<div class="form-group col-md-12">
                            <label for="fullNameInitials">Disciplinary Action :</label>
                            <input type="text" class="form-control" id="fullNameInitials" name="reason1" value="<?php echo $res_user['action']; ?>" readonly>
            </div>
</div>

<div class="form-group col-md-12">
    <label for="photo">Image</label>
    <?php
    if (!empty($res_user['img'])) {
        echo '<div><img src="dici/' . $res_user['img'] . '" alt="Employee Photo" class="img-fluid" style="max-width: 400px; max-height: 300px;" /></div>';
    } else {
        echo '<div>No photo uploaded.</div>';
    }
    ?>
</div>

                <div class="form-group">
                    <label for="remark">Remark :</label>
                    <input type="text" class="form-control" id="remark" name="remark" rows="2" value="<?php echo $res_user['remark']; ?>" readonly>

                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</html>

<?php
  }
?>