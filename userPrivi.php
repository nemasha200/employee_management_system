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

<?php
include 'db_connect.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Privileges Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #dadce3;
            background-image: url("black.jpg");
            margin: 0;
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
            background-color: lavenderblush;
            padding: 30px;
            border-radius: 10px;
            border-color: black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin: auto;
            position: relative;
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

        .button-container {
            display: flex;
            justify-content: center;
        }

        .form-container {
            margin-top: 50px;
        }

        .checkbox-group label {
            margin-right: 20px;
            background-color: red;
        }

        .main-topic {
            font-weight: bold;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<?php include 'submenubar.php';?>

<?php include 'logout.php';?> 


    <div class="container form-container">


        <h2 class="text-center">Menubar User Permissions</h2>
        <form id="registrationForm" action="userpriviSave.php" method="POST">

            <a href="priviSearch.php">
                <button type="button" class="btn btn-primary btn-small">View Privileges</button>
            </a>

            <div class="form-group">
                <label for="selectUser">Select User:</label>
                <select class="form-control" id="selectUser" name="selectuser">
                    <?php
                    $getEmp = mysqli_query($con, "SELECT * FROM user");
                    while ($resUser = mysqli_fetch_array($getEmp)) {
                    ?>
                        <option value="<?php echo $resUser['username']?>">
                            <?php echo $resUser['username']?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <ul>

                <?php
                $getmenu = mysqli_query($con, "SELECT * FROM mainmenu WHERE isact='1'");
                //start loop
                $count = 0;
                $x = 1;

                while ($resMenu = mysqli_fetch_array($getmenu)) {
                    $menid = $resMenu['id'];
                ?>

                    <li class="slide-item">
                        <div class="main-topic">
                            <label>
                                <?php echo $resMenu['menu_name'] ?>
                            </label>
                        </div>

                        <ul style="list-style-type: none; padding-left: 20px;">
                            <?php
                            $getSub = mysqli_query($con, "SELECT * FROM submenu WHERE isact='1' AND mainmenu_id = $menid");

                            while ($resSub = mysqli_fetch_array($getSub)) {
                                $kenid = $resSub['id'];
                            ?>

                                <li>
                                    <label>
                                        <input type="checkbox" name="submenu<?php echo $x; ?>" value="<?php echo $resSub['id'] ?>">
                                        <input type="hidden" name="main<?php echo $x; ?>" value="<?php echo $resMenu['id'] ?>">
                                        <input type="hidden" name="sub<?php echo $x; ?>" value="<?php echo $resSub['id'] ?>">
                                        <?php echo $resSub['submenu_name'] . " / " . $resSub['pagename'] ?>
                                    </label>
                                </li>
                            <?php
                                $x++; // increment
                            }
                            ?>
                        </ul>
                    </li>

                <?php
                }
                ?>

            </ul>

            <div class="form-group">
                <label for="registrationDate">Registration Date</label>
                <input type="date" class="form-control" id="registrationDate" name="registrationDate" required>
            </div>

            <div class="form-group">
                <label for="registrationTime">Registration Time</label>
                <input type="time" class="form-control" id="registrationTime" name="registrationTime" required>
            </div>

            <input type="hidden" value="<?php echo $x; ?>" name="rowCount">

            <button type="submit" class="btn btn-primary btn-small">Submit</button>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Show SweetAlert2 notification
            Swal.fire({
                title: 'Success!',
                text: 'User privileges have been saved successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // After clicking OK, submit the form
                    this.submit();
                }
            });
        });
    </script>
</body>

</html>
<?php
}
?>
