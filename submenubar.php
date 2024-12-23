<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu with Toggle Sub-Items</title>
    <style>
        .card {
            background-color: white;
            color: black;
        }

        .sidebar {

            background-color: #838485;
            color: black;
            padding-top: 20px;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            max-height: 100vh; /* Set maximum height to full viewport */
            overflow-y: auto; /* Enables vertical scrollbar */
        }

        .sidebar h4 {
            padding-bottom: 20px;
            font-size: 1.25rem;
            text-transform: uppercase;
            border-bottom: 1px solid #495057;
            margin-bottom: 20px;
            color: black;
            text-align: center;
        }

        .sidebar a {
            background-color: #1090a7;
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
            background-color: mediumpurple;
        }

        .submenu {
            display: none;
            background-color: lightpink;
        }

        .sidebar .submenu a {
            padding-left: 20px;
        }

        .logo {
            width: 30px;
            height: auto;
            display: inline-block;
            margin-right: 10px;
        }

        .card-header button {
            background-color: slategray;
            color: black;
            width: 100%;
            text-align: left;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .dashboard-btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .dashboard-btn {
            background-color: #e64784;
            color: black;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            overflow-x: auto;
        }
    </style>
</head>

<body>
<?php include 'logout.php';?> 

<?php
$username = $_SESSION['username'];

$stmt = mysqli_query($con, "SELECT DISTINCT menu_id FROM user_priviledge WHERE username='$username'");
?>

<div class="sidebar p-3">
    <h4 class="text-center"> Menu bar <img src="menu-bar_3926749.png" alt="Logo" class="logo"></h4>

    <div class="dashboard-btn-container">
        <a href="menubar.php" class="dashboard-btn">Go Dashboard</a>
    </div>

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

</body>
</html>
<?php
}
?>
