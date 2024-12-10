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
    <title>Employee Registration System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"> <!-- Animate.css -->

    <style>
        body {
            background-image: url("img1.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            color: black;
        }

        .container {
            padding: 60px;
            border-radius: 20px;
            background-color: transparent;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: initial;
            margin-left: 400px;
        }

        .card {
            margin: 20px 0;
            background-color: whitesmoke;
        }

        .card-header {
            background-color: #495057;
            color: white;
        }

        .card-body {
            color: black;
            text-align: center;
            background-color: whitesmoke;
        }

        .card-body p {
            color: black;
            margin: 0;
        }

        .buttons-right {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .buttons-right a {
            margin-left: 10px;
        }

        .btn-go-subform {
            background-color: black;
            border-color: black;
        }

        .btn-go-subform:hover {
            background-color: #d6c9cc;
            border-color: #495057;
            color: black;
        }

        .bg-black {
            background-color: black !important;
        }

        .logo {
            height: 35px;
            width: auto;
        }

        .logoemp {
            height: 30px;
            width: auto;
        }

        .btn-register {
            border-radius: 10px;
            background-color: #7a776d;
            color: black;
            border-color: black;
        }

        .btn-register:hover {
            background-color: black;
            border-color: black;
        }

        .sidebar {
            height: 100vh;
            background-color: gray;
            padding-top: 20px;
            position: fixed;
            width: 250px;
            max-height: 100vh; /* Set maximum height to full viewport */
            overflow-y: auto; /* Enables vertical scrollbar */
        }

        .sidebar h4 {
            padding-bottom: 20px;
            font-size: 1.25rem;
            text-transform: uppercase;
            border-bottom: 1px solid #495057;
            margin-bottom: 20px;
            border-color: black;
        }

        .sidebar a {
            background-color: #716c8c;
            color: black;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: gray ;
        }

        .sidebar .submenu a {
            padding-left: 40px;
        }

        .sidebar .card-body a:first-child {
            background-color:  #92152e;
            color: black;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .employee-system-header {
            font-size: 2rem;
            text-align: center;
            background-color: black;
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 15px;
            position: relative;
            border-radius: 0px;
        }

        .employee-system-section h5 {
            color: black;
            margin-bottom: 20px;
            font-size: 1.5rem;
            border-bottom: 2px solid #f22e3b;
            padding-bottom: 10px;
        }

        .employee-system-section p {
            color: black;
        }

        .employee-system-section a {
            color: black;
            background-color: turquoise;
            text-decoration: none;
        }

       

       
        

        .logout-button {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }

        .logout-button:hover {
            background-color: #c82333;
            color: white;
        }

        .text {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 0.9rem;
            left: 120px; 
        }

    </style>
</head>

<body>

<?php include 'logout.php'; ?>

<?php
    // Get session variables for user authentication and privileges
    $username = $_SESSION['username'];
    $admin_id = $_SESSION['admin_id'];                    


    // Fetch user privileges from the database
    $stmt = mysqli_query($con, "SELECT DISTINCT menu_id FROM user_priviledge WHERE username='$username'");
?>

<!-- Sidebar Menu -->
<div class="d-flex">
    <div class="sidebar p-3">
        <h4 class="text-center"><img src="menu-bar_3926749.png" alt="Logo" class="logo"> Menu bar</h4>

        <?php
        // Check if user has any menu privileges
        if (mysqli_num_rows($stmt) > 0) {
            while ($menu = mysqli_fetch_array($stmt)) {
                $menu_id = $menu['menu_id'];
                $getMain = mysqli_query($con, "SELECT * FROM mainmenu WHERE id='$menu_id'");
                $mainMenu = mysqli_fetch_array($getMain);
        ?>
        <!-- Display main menu -->
        <div class="card bg-black">
            <div class="card-header" id="heading<?php echo $menu_id; ?>">
                <h5 class="mb-0">
                    <button class="btn btn-link text-white collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $menu_id; ?>" aria-expanded="false">
                        <?php echo $mainMenu['menu_name']; ?>
                    </button>
                </h5>
            </div>
            <!-- Submenu items -->
            <div id="collapse<?php echo $menu_id; ?>" class="collapse">
                <div class="card-body">
                    <?php
                    $getSub = mysqli_query($con, "SELECT * FROM submenu WHERE mainmenu_id='$menu_id' AND id IN (SELECT submenu_id FROM user_priviledge WHERE username='$username')");
                    while ($subMenu = mysqli_fetch_array($getSub)) {
                    ?>
                    <a href="<?php echo $subMenu['pagename']; ?>" class="btn btn-link text-white">
                        <?php echo $subMenu['submenu_name']; ?>
                    </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "No privileges found."; // Message if no privileges
        }
        ?>
    </div>

    <!-- Main Content -->
    <div class="content w-100">
        <h1 class="employee-system-header">
            <a href="userlogin.php" class="logout-button">Logout</a>
            <img src="raigam.png" alt="Logo" class="logo">
            <b>Employee Registration System</b>
        </h1>
    </div>
</div> 

<!-- Dashboard statistics -->                                             
<div class="container employee-system-section">
    <div class="row">
        <!-- Total Employees -->
        <div class="col-md-6">
            <div class="card text-black mb-3">
                <div class="card animate__animated animate__zoomIn">
                    <div class="card-header">
                        <h4><center>Total Employees</center></h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $dash_query = "SELECT * FROM employer";
                        $dash_query_run = mysqli_query($con, $dash_query);
                        echo '<h2>' . mysqli_num_rows($dash_query_run) . '</h2>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Active Employees -->
        <div class="col-md-6">
            <div class="card text-black mb-3">
                <div class="card animate__animated animate__zoomIn">
                    <div class="card-header">
                        <h4><center>Total Active Employees</center></h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $dash_active_query = "SELECT * FROM employer WHERE isAct ='1'";
                        $dash_active_query_run = mysqli_query($con, $dash_active_query);
                        echo '<h2>' . mysqli_num_rows($dash_active_query_run) . '</h2>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="text">
    <span> Copyright © 2024 Designed by <a href="#"> RAIGAM IT Department </a> All rights reserved.</span>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
}
?>
