<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url("777.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
    }
    .login-container {
      width: 400px; 
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: rgba(0, 0, 0, 0.5); 
      color: white; 
    }
    .login-container h2 {
      margin-bottom: 20px;
      color: white; 
    }
    .form-group label {
      font-weight: 600;
      color: white; 
    }
    .form-control {
      background-color: rgba(255, 255, 255, 0.2); 
      color: white;
    }
    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.7); 
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    .login-link {
      margin-top: 15px;
      display: block;
      color: white; 
    }
    .logo {
      display: block;
      margin: 0 auto 20px; 
      width: 100px; 
      height: auto; 
    }
    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      background-color: #343a40;
      color: white;
      border: none;
      padding: 10px 15px;
      font-size: 0.875rem;
      border-radius: 5px;
      cursor: pointer;
    }
    .back-button:hover {
      background-color: #0056b3;
    }

    .text {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 0.9rem;
            left: 0px; /* Adjust this value as needed */
        } 
  </style>
</head>
<body>


  <div class="login-container">
    <button class="back-button" onclick="window.history.back();">&larr;</button>

    <img src="raigam.png" alt="Logo" class="logo">
    <h2 class="text-center">Login Page</h2>
    
    <form id="loginForm" method="POST" action="userlogSubmit.php">
      <div class="form-group">
        <label for="username">User Name:</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password" required>
      </div>
      <div class="form-group">
        <label for="type">Type:</label>
        <select class="form-control" id="type" name="type" required>
          <option value="" disabled selected>Select user type</option>
          <option value="Admin">Admin</option>
          <option value="Super Admin">Super Admin</option>
          <option value="User">User</option>
        </select>
      </div>
      <input type="submit" value="Login to System" class="btn btn-primary btn-block">
      <a href="user.php" class="login-link">Don't have an account? Register here</a>
    </form>
  </div>
  <div class="text">
        <span> Copyright © 2024 Designed by <a href="#"> RAIGAM IT Department </a> All rights reserved.</span>
    </div>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      <?php
      if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
          echo "Swal.fire({
            icon: 'success',
            title: 'Login Successful!',
            text: 'Redirecting to the dashboard...',
            showConfirmButton: false,
            timer: 1500
          }).then(() => {
            window.location.href = 'menubar.php';
          });";
        } else if ($_GET['status'] == 'error') {
          echo "Swal.fire({
            icon: 'error',
            title: 'Login Failed!',
            text: 'Invalid username, password, or type.',
            showConfirmButton: false,
            timer: 1500
          });";
        }
      }
      ?>
    });
  </script>

</body>
</html>
