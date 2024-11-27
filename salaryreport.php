<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}

include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Reports Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            background-color: darkgrey;
            margin: 0;
            background-image: url("black.jpg");
        }

        .form-container {
            background-color: whitesmoke;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1800px;
            margin: 80px auto;
            margin-left: 100px;
            margin-right: 15px;
        }

        .form-container h2 {
            text-align: center;
        }

        table {
            width: 10%;
            border-collapse: collapse;
        }

        th {
            background-color: #be9fce;
            color: white;
        }

        .btn-all {
            background-color: #007bff;
            color: white;
        }

        .btn {
            /* margin: 10px; */
            padding: 8px;
        }

        .btn-primary {
            padding: 10px 20px;
            border-radius: 45px;
            height: 50px; /* Adjust the height as needed */
            margin: 10px 5px;
            background-color: #bf2128;
        }

        .btn-success {
            margin-left: 100px;
            margin: 10px;
        }

        .btn-all {
            margin-left: 700px;
        }

        sbutton {
            border-radius: 45px;
            margin: 10px 5px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #2c71f2;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        cbutton {
            border-radius: 45px;
            margin: 10px 5px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: purple;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

    </style>
</head>

<body>

<!-- <?php include 'submenubar.php'; ?>  -->
<?php include 'dashboard.php'; ?> 

<div class="form-container">
    <h2>Salary Reports</h2>

    <div class="form-row">
       
    <div class="form-group col-md-4">
            <label for="company">Company:</label>
            <select class="form-control" id="company_num" name="company_num">
                <option value="">Select an option</option>
                <?php
                $companies = mysqli_query($con, "SELECT * FROM sub_company");
                while ($row = mysqli_fetch_assoc($companies)) {
                    echo "<option value='{$row['com_number']}/{$row['com_name']}'>{$row['com_number']}/{$row['com_name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="department">Department:</label>
            <select class="form-control" id="department" name="department">
                <option value="">Select an option</option>
                <?php
                $departments = mysqli_query($con, "SELECT * FROM sub_department");
                while ($row = mysqli_fetch_assoc($departments)) {
                    echo "<option value='{$row['dep_name']}'>{$row['dep_name']}</option>";
                }
                ?>
            </select>
        </div>
    </div>



    <div class="form-row">
        <button class="btn btn-primary" id="filterBtn">Generate Report</button>
        <button class="btn btn-success" onclick="downloadSelectedRows()">Download Excell sheet<img src="ex.png" alt="Logo" style="width: 25px; height: auto;"></button>
    </div>

    <div class="table-responsive mt-4">
        <table id="tableID" class="table table-striped table-bordered">
            
            <thead>
                <tr>
                   <th>Select</th>
                    <th>Full Name</th>
                    <th>Company</th>
                    <th>Department</th>
                    <th>EPF Number</th>
                    <th>Basic</th>
                    <th>Budgetory Relief Allowance</th>
                    <th>fa_travelling_amount</th>
                    <th> Other amount</th>
                    <th>fa_retravel_amount</th>
                    <th>fa_vehicle_amount</th>
                    <th>fa_fual_amount</th>
                    <th>fa_logging_amount</th>
                    <th>fa_attendance_amount</th>
                    <th>fa_travel_exp_amount</th>
                    <th>fa_pettah_amount</th>
                    <th>fa_bakery_amount</th>
                    <th>fa_insentive_amount</th>
                    <th>fd_welfare_amount</th>
                    <th>fd_medical_amount</th>
                    <th>fd_other1</th>
                    <th>fd_other2</th>
                    <th>fd_other3</th>
                    <th>Payment</th>
                    <th>Account Number</th>
                    <th>Bank Name</th> 
                    <th>Branch Name</th>
                </tr>
            </thead>
            <tbody id="reportBody"></tbody>
        </table>
    </div>

    <sbutton id="selectAll">Select All Rows</sbutton>
    <cbutton id="clearAll">Clear All Rows</cbutton>
</div>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        const dataTable = $('#tableID').DataTable();

        // Generate report with filters
        $('#filterBtn').click(function () {
            const company_num = $('#company_num').val();
            const department = $('#department').val();

            $.ajax({
                url: 'fetch_filtered_salary.php',
                method: 'POST',
                data: { company_num, department},
                success: function (data) {
                    dataTable.clear().draw();
                    dataTable.rows.add($(data)).draw(); // Add new rows
                },
                error: function () {
                    Swal.fire('Error', 'Failed to fetch data.', 'error');
                }
            });
        });

        // Select/Deselect all rows
        $('#selectAll').on('click', function () {
            $('#tableID tbody input[type="checkbox"]').prop('checked', true);
        });

        $('#clearAll').on('click', function () {
            $('#tableID tbody input[type="checkbox"]').prop('checked', false);
        });

        // Synchronize row checkboxes with "Select All"
        $('#tableID').on('change', 'tbody input[type="checkbox"]', function () {
            const allChecked = $('#tableID tbody input[type="checkbox"]').length === $('#tableID tbody input[type="checkbox"]:checked').length;
            $('#selectAll').prop('checked', allChecked);
        });
    });

    // Download selected rows as CSV
    function downloadSelectedRows() {
        let csv = [];
        csv.push(
            Array.from($('#tableID thead th')).map((th) => $(th).text()).join(',')
        );

        $('#tableID tbody tr').each(function () {
            const row = $(this);
            if (row.find('input[type="checkbox"]').is(':checked')) {
                csv.push(
                    Array.from(row.find('td')).map((td) => $(td).text().trim().replace(/,/g, '')).join(',')
                );
            }
        });

        if (csv.length > 1) {
            const csvBlob = new Blob([csv.join('\n')], { type: 'text/csv' });
            const url = URL.createObjectURL(csvBlob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'selected_salary_report.csv';
            a.click();
        } else {
            Swal.fire('Info', 'No rows selected.', 'info');
        }
    }
</script>


</body>
</html>
