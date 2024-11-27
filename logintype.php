<?php 
 error_reporting(E_ALL ^ E_NOTICE); 
 session_start(); //to ensure you are using same session
 session_destroy(); //destroy the session

 ?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Types</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('blue.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }
        .headline {
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
            color: black;
        }
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        .login-card {
            background: transparent;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 10px 0;
            width: 80%;
            max-width: 400px;
        }
        .login-card img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
        }
        .login-card button {
            margin-top: 10px;
            width: 30%; /* Smaller width */
            background-color: black; /* Custom background color */
            border: none; /* Remove border */
            color: white; /* Text color */
            font-size: 0.875rem; /* Smaller font size */
            padding: 10px; /* Smaller padding */
        }
        .login-card button:hover {
            background-color: grey; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <div class="headline">Employee Registration System</div>
    <div class="login-container">
        
        <div class="login-card">
            <img src="super.png" alt="Admin Login">
            <button class="btn" onclick="navigateTo('userlogin.php')">Goto Login </button>
        </div>
    </div>
    <script>
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
