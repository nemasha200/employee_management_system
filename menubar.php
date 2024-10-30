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
            color: black; /* Set the default font color to black */
        }

        .container {
            margin-top: 30px;
            padding: 60px;
            border-radius: 20px;
            background-color: thistle; Background color for the container
            color: white;
        }

        .card {
            margin: 20px 0;
            background-color: whitesmoke; /* Change background to white */
            
        }

        .card-header {
            background-color: darkred;
            color: white;
        }

        .card-body {
            color: black; /* Change text color to black */
            text-align: center; /* Center text alignment */
            background-color: whitesmoke;
        }

        .card-body p {
            color: black; /* Ensure all paragraph text color is black */
            margin: 0; /* Remove default margin */
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
            margin-right: 0 px;
        }

        .logoemp {
            height: 30px;
            width: auto;
            margin-right: 0 px;
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
            background-color: red;
            color: black;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out;
            margin-bottom: 10px; /* Add space between buttons */
        }

        .sidebar a:hover {
            background-color: lightskyblue;
        }

        .sidebar .submenu a {
            padding-left: 40px;
        }

        .sidebar .card-body a:first-child {
            background-color: lightpink;
            color: black; /* If you want to change the text color */
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
        }

        .employee-system-section h5 {
            color: black; /* Change header color to black */
            margin-bottom: 20px;
            font-size: 1.5rem;
            border-bottom: 2px solid #f22e3b;
            padding-bottom: 10px;
        }

        .employee-system-section p {
            color: black; /* Change paragraph color to black */
        }

        .employee-system-section a {
            color: black;
            background-color: turquoise;
            text-decoration: none;
        }

        .employee-system-section a:hover {
            background-color: orange;
        }

        .employee-system-section {
            background-color: transparent;
        }

        .dashboard-btn {
            background-color: red;
            color: white;
        }

        .dashboard-btn:hover {
            background-color: #e0e0c0; /* Slightly darker cream */
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: darkred;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: darkorange;
        }

        .sidebar .card-header h5 a,
        .sidebar .card-header h5 button {
            color: black;
            display: block;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .sidebar .card-body a:first-child {
            background-color: #7a776d;
            color: black; /* If you want to change the text color */
        }
        .sidebar .card-body a:first-child:hover{
            background-color: maroon;
            color: black; /* If you want to change the text color */
        }

        .sidebar .card {
            border-radius: 20px; /* Round the corners */
            overflow: hidden; /* Hide overflow */
            margin-bottom: 10px; /* Add space between cards */
        }

        .sidebar .card-header {
            background-color: #202928; Set the background color for card headers
            border-bottom: none; /* Remove the border from the bottom */
            padding: 10px 20px; /* Add padding to card headers */
            border-radius: 10px 10px 0 0; /* Round the top corners */
        }

        .sidebar .card-body {
            /* background-color: lightgrey; Set the background color for card bodies */
            color: black; /* Set the text color for card bodies */
            padding: 20px; /* Add padding to card bodies */
            border-radius: 0 0 10px 10px; /* Round the bottom corners */
        }

        .sidebar .btn-link {
            color: black; /* Set the text color for button links */
        }

        .sidebar .btn-link:hover {
            color: black; /* Set the hover color for button links */
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
            background-color: #7a776d;
        }
        .card-body a.btn-link {
        background-color: #819994; /* Set button background to dark green */
        color: black; /* Set font color to black */
        }

        .card-body a.btn-link:hover {
        background-color: #495057; /* Darker shade of green on hover */
        color: black; /* Keep font color black on hover */
       }  

</style>
</head>

<body>

<?php include 'logout.php';?> 

    <?php
    $username = $_SESSION['username'];
    $admin_id = $_SESSION['admin_id'];

    $stmt = mysqli_query($con, "SELECT DISTINCT menu_id FROM user_priviledge WHERE username='$username'");
    ?>

    <div class="d-flex">
        <div class="sidebar p-3">
            <h4 class="text-center"><img src="menu-bar_3926749.png" alt="Logo" class="logo"> Menu bar</h4>

            <?php
            if (mysqli_num_rows($stmt) > 0) {
                while ($menu = mysqli_fetch_array($stmt)) {
                    $menu_id = $menu['menu_id'];
                    $getMain = mysqli_query($con, "SELECT * FROM mainmenu WHERE id='$menu_id'");
                    $mainMenu = mysqli_fetch_array($getMain);
                    ?>
                    <div class="card bg-black">
                        <div class="card-header" id="heading<?php echo $menu_id; ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-white collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $menu_id; ?>" aria-expanded="false" aria-controls="collapse<?php echo $menu_id; ?>">
                                    <?php echo $mainMenu['menu_name']; ?>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?php echo $menu_id; ?>" class="collapse" aria-labelledby="heading<?php echo $menu_id; ?>" data-parent=".sidebar">
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
                echo "No privileges found.";
            }
            ?>
        </div>

        <div class="content w-100">
            <h1 class="employee-system-header"><img src="raigam.png" alt="Logo" class="logo">        
            <b>Employee Registration System</b> </h1>
            
        </div>


            </div>


            <div class="container employee-system-section">
                <div class="row">
                    <div class="col-md-6" >

                        <div class="card text-black mb-3">
                        <d class="card animate__animated animate__zoomIn">
                            

                            <div class="card-header">
                           
                            <h4><center><img src="team.png" alt="Logo" class="logo">     Total of the Employees</center></h4>
                                
                            </div>
                            <div class="card-body">
                            <h2>450</h2>
                               
                            </div>
                            </d>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-black mb-3">
                        <d class="card animate__animated animate__zoomIn">

                            <div class="card-header"><h4><center><img src="inactive.png" alt="Logo" class="logo">  Total ActiveEmployees</center></h4>
                                <a href="employer.php">
                                    <!-- <button type="button" class="btn btn-sm btn-register"> Register</button> -->
                                </a>
                            </div>
                            <div class="card-body">
                                <h2>275</h2>
                               
                            </div>
                            </d>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="card text-black mb-3">
                        <d class="card animate__animated animate__zoomIn">

                            <div class="card-header"><h4><center><img src="emp.png" alt="Logo" class="logo">  Total Deactive Employees</center></h4>
                                <a href="employer.php">
                                    <!-- <button type="button" class="btn btn-sm btn-register"> Register</button> -->
                                </a>
                            </div>
                            <div class="card-body">
                                <h2>275</h2>
                               
                            </div>
                            </d>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="card text-black mb-3">
                        <d class="card animate__animated animate__zoomIn">

                            <div class="card-header"><h4><center><img src="promo.png" alt="Logo" class="logo">  Total Transfer Employees</center></h4>
                                <a href="employer.php">
                                    <!-- <button type="button" class="btn btn-sm btn-register"> Register</button> -->
                                </a>
                            </div>
                            <div class="card-body">
                                <h2>27</h2>
                               
                            </div>
                            </d>
                        </div>
                    </div>
                   
                    
                    
                </div>



                
            </div>
        </div>
    </div>
 
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
}
?>
