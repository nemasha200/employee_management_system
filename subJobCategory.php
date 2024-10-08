<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();
 

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}else{
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
            background-image: url("img1.jpg");
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
            position: relative; /* Added to position the back button */
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
        }
        .btn-primary:hover {
            background-color: #495057;
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
    </style>
</head>
<body>

<?php include 'submenubar.php';?>

    <div class="container form-container">
        <h2 class="text-center">Job Category Registration Form</h2>
        <a href="subJobSearch.php">
            <button type="button" class="btn btn-primary btn-small">View Job category Deatils</button>
        </a><br><br>
        <form id="registrationForm" method="POST" action="subJobSave.php">
            <div class="form-group">
                <label for="departmentNumber">Job Category Number</label>
                <input type="text" class="form-control" id="jobnum" name="jobnum" placeholder="Enter job Category number">
            </div><br>
            <div class="form-group">
                <label for="departmentName">Job Category Name</label>
                <input type="text" class="form-control" id="jobname" name="jobname" placeholder="Enter job Category name">
            </div><br>
            <button type="submit" class="btn btn-primary btn-small">Submit</button>
        </form>
    </div>

    


</body>
</html>

<?php
}
?>
            
