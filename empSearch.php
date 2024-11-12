<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    ?>
    <?php
    // Include database connection
    include 'db_connect.php';

    // Check if database connection is successful
    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <style>
            /* General styles */
            .mainContainer {
                width: 100vw;
                height: 100vh;
                display: flex;
                padding: 1rem;
                justify-content: center;
                /* Center content horizontally */
                align-items: flex-start;
                /* Align content to the top */
            }

            .container {
                padding: 20px;
                border-radius: 10px;
                margin-top: 10px;
                /* Reduce the gap from the top */
            }

            .table {
                background-color: ghostwhite;
                height: 70%;
                margin-left: 100px;
            }


            body {
                margin: 0;
                padding: 0;
                background-image: url("black.jpg");
            }

            .table th {
                background-color: darkgrey;
                /* Set header background color */
                color: black;
            }

            .text-black {
                color: black !important;
            }

            .dataTables_filter input {
                background-color: white !important;
            }

            /* Button Sizes */
            .btn-small,
            .btn-medium,
            .btn-large {
                padding: 5px 15px;
                font-size: 1rem;
            }

            .form-inline {
                display: flex;
                justify-content: flex-end;
                margin-bottom: 15px;
            }

            /* Responsive Styles */

            /* For small devices (mobile, up to 600px) */
            @media (max-width: 600px) {
                .mainContainer {
                    padding: 0.5rem;
                    align-items: center;
                }

                .container {
                    width: 90%;
                    padding: 15px;
                    margin-top: 5px;
                }

                .table {
                    height: auto;
                }

                .btn-small,
                .btn-medium,
                .btn-large {
                    padding: 5px 10px;
                    font-size: 0.875rem;
                }
            }

            /* For tablets (600px to 768px) */
            @media (min-width: 600px) and (max-width: 768px) {
                .mainContainer {
                    padding: 1rem;
                    align-items: center;
                }

                .container {
                    width: 85%;
                    padding: 15px;
                    margin-top: 10px;
                }

                .table {
                    height: 60%;
                }

                .btn-small,
                .btn-medium,
                .btn-large {
                    padding: 5px 12px;
                    font-size: 0.9rem;
                }
            }

            /* For laptops and desktops (768px to 1024px) */
            @media (min-width: 768px) and (max-width: 1024px) {
                .container {
                    width: 80%;
                    padding: 20px;
                    margin-top: 15px;
                }

                .table {
                    height: 65%;
                }
            }

            /* For large desktops (above 1024px) */
            @media (min-width: 1024px) {
                .container {
                    width: 70%;
                    padding: 25px;
                    margin-top: 20px;
                }

                .table {
                    height: 70%;
                }
            }

            .text-whit {
                margin-left: 100px;
                color: white;
            }

            .pagination {
    justify-content: flex-end; /* Align pagination to the right */
    position: absolute; /* Position pagination relative to the container */
    bottom: 20px; /* Adjust the distance from the bottom */
    right: 20px; /* Adjust the distance from the right */
}

        </style>


        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee Details</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#tableID').DataTable({
                    searching: false
                });
            });
        </script>
    </head>

    <body>
        <!-- <div> -->
        <?php include 'submenubar.php'; ?>
        <!-- </div> -->
        <?php include 'logout.php'; ?>


        <!-- <div class="mainContainer"> -->
        <div class="container">
            <h3 class="text-whit">Employee Details</h3>

            <!-- Search form aligned to the right -->
            <form method="GET" action="" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="search" class="form-control" placeholder="Search Employee Details"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </form>

            <!-- Table -->
            <?php
            // Define the number of results per page
            $results_per_page = 5;

            // Determine the current page
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $page = max($page, 1); // Ensure the page is at least 1
        
            // Calculate the offset for the SQL query
            $offset = ($page - 1) * $results_per_page;

            // Retrieve the search term
            $searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

            // If search term is provided, use it to filter results
            if (!empty($searchTerm)) {
                $getuser = mysqli_query($con, "SELECT empid, department, nic, epf, full_name, designation, job_title, isAct 
                                   FROM employer
                                   WHERE empid LIKE '%$searchTerm%' 
                                      OR department LIKE '%$searchTerm%'
                                      OR nic LIKE '%$searchTerm%' 
                                      OR epf LIKE '%$searchTerm%' 
                                      OR full_name LIKE '%$searchTerm%' 
                                      OR designation LIKE '%$searchTerm%' 
                                      OR job_title LIKE '%$searchTerm%'
                                   ORDER BY isAct DESC
                                   LIMIT $results_per_page OFFSET $offset");
            } else {
                $getuser = mysqli_query($con, "SELECT empid, department, nic, epf, full_name, designation, job_title, isAct 
                                   FROM employer
                                   ORDER BY isAct ASC
                                   LIMIT $results_per_page OFFSET $offset");
            }

            // Check for errors
            if (!$getuser) {
                echo "Error executing query: " . mysqli_error($con);
            } else {
                echo '<table id="tableID" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>NIC</th>
                    <th>EPF</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Job Title</th>
                    <th>View</th>
                    <th>Update</th>
                    <th>InActive</th>
                </tr>
            </thead>
            <tbody>';

                while ($res_user = mysqli_fetch_array($getuser)) {
                    echo '<tr>
                <td>' . $res_user['department'] . '</td>
                <td>' . $res_user['nic'] . '</td>
                <td>' . $res_user['epf'] . '</td>
                <td>' . $res_user['full_name'] . '</td>
                <td>' . $res_user['designation'] . '</td>
                <td>' . (isset($res_user['job_title']) ? $res_user['job_title'] : 'N/A') . '</td>
                <td><a href="empView.php?user_id=' . $res_user['empid'] . '" class="btn btn-success">View</a></td>
                <td><a href="empUpdate.php?user_id=' . $res_user['empid'] . '" class="btn btn-warning">Update</a></td>
                <td>';

                    if ($res_user['isAct'] == 1) {
                        echo '<a href="toggleStatus.php?empid=' . $res_user['empid'] . '&status=0" class="btn btn-info">Active</a>';
                    } else {
                        echo '<a href="toggleStatus.php?empid=' . $res_user['empid'] . '&status=1" class="btn btn-danger">Deactive</a>';
                    }

                    echo '</td></tr>';  
                }

                echo '</tbody></table>';

                // Pagination logic
                $total_results_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM employer".
                    (!empty($searchTerm) ? "WHERE empid LIKE '%$searchTerm%' 
                                             OR department LIKE '%$searchTerm%' 
                                             OR nic LIKE '%$searchTerm%' 
                                             OR epf LIKE '%$searchTerm%' 
                                             OR full_name LIKE '%$searchTerm%' 
                                             OR designation LIKE '%$searchTerm%' 
                                             OR job_title LIKE '%$searchTerm%'" : ""));
                $total_results = mysqli_fetch_assoc($total_results_query)['total'];
                $total_pages = ceil($total_results / $results_per_page);

                echo '<nav aria-label="Page navigation">
            <ul class="pagination">';

                // Loop to display pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = ($i == $page) ? 'active' : '';
                    echo '<li class="page-item ' . $active . '">
                <a class="page-link" href="?page=' . $i . (!empty($searchTerm) ? '&search=' . urlencode($searchTerm) : '') . '">' . $i . '</a>
              </li>';
                }

                echo '  </ul>
          </nav>';
            }
            ?>

        </div>
        <!-- </div> -->
    </body>

    </html>
    <?php
}
?>