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
    $getuser = mysqli_query($con, "SELECT * FROM sub_company WHERE id='$user_id'");
    $res_user = mysqli_fetch_array($getuser);

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Division Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d0d9db;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url("black.jpg");       
        }
        .form-container {
            background-color: #daf4f5;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 30%;
            max-width: 1000px;
            overflow-y: auto;
            max-height: 90vh;
            position: relative;
            color:
        }
        .form-control {
            color: black;
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
        }
        .btn-primary:hover {
            background-color: #495057;
        }
        .btn-small {
            padding: 5px 10px;
            font-size: 0.875rem;
            width: 150px; /* Adjust the width as needed */
            display: block;
            margin: 20px auto 0; /* Center the button and add top margin */
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
</head>
<body>

<?php include 'submenubar.php';?>

    <div class="container form-container">
        <!-- <button class="back-button" onclick="window.history.back();">&larr;</button> -->
        <h2 class="text-center">Company Registration Form</h2><br><br>
            
        <form>
            <div class="form-group">
                <label for="companyNumber">Company Number</label>
                <input type="text" class="form-control" id="companyNumber" name="compnum" value="<?php echo $res_user['com_number']; ?>" readonly>
            </div><br>
            <div class="form-group">
                <label for="companyName">Company Name</label>
                <input type="text" class="form-control" id="companyName" name="compname" value="<?php echo $res_user['com_name']; ?>" readonly>
            </div><br>
            <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="Location" name="location" value="<?php echo $res_user['location']; ?>" readonly>
            </div><br>
        </form>
    </div>
</body>
</html>
<?php
}
?>