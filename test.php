<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Status Form</title>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="form-group col-md-6">
        <label for="recruitmentType">Employee Status:</label>
        <select class="form-control" id="recruitmentType" name="recruitmentType">
            <option value="" disabled selected>Select an option</option>
            <option value="permanent">Permanent</option>
            <option value="ftc">FTC</option>
            <option value="casual">Casual</option>
            <option value="consultant">Consultant</option>
        </select>
    </div>

    <!-- Container for dynamically added FTC rows -->
    <div id="ftcFieldsContainer" style="display: none;">
        <h5>FTC Fields</h5>
        <!-- Placeholder for dynamic FTC fields -->
    </div>

    <!-- Button to add more FTC rows -->
    <button type="button" class="btn btn-primary" id="addFtcRow" style="display:none;">Add FTC Row</button>

   
</div>

<!-- jQuery Script -->
<script>
    $(document).ready(function() {
        var ftcCounter = 1;  // To keep track of FTC rows

        // Show FTC fields and Add button when FTC is selected
        $('#recruitmentType').change(function() {
            var selectedStatus = $(this).val();

            if (selectedStatus === "ftc") {
                $('#ftcFieldsContainer').show();
                $('#addFtcRow').show();
                addFtcRow(); // Add the first row (FTC1)
            } else {
                $('#ftcFieldsContainer').hide();
                $('#addFtcRow').hide();
                $('#ftcFieldsContainer').empty();  // Clear the FTC fields when not FTC
                ftcCounter = 1;  // Reset counter
            }
        });

        // Function to dynamically add FTC rows
        function addFtcRow() {
            var rowHtml = `
                <div class="form-row" id="ftcRow${ftcCounter}">
                    <h6 class="col-md-12">FTC${ftcCounter}</h6>
                    <div class="form-group col-md-4">
                        <label for="fromDate${ftcCounter}">From Date:</label>
                        <input type="date" class="form-control" id="fromDate${ftcCounter}" name="fromDate${ftcCounter}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="toDate${ftcCounter}">To Date:</label>
                        <input type="date" class="form-control" id="toDate${ftcCounter}" name="toDate${ftcCounter}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="epf${ftcCounter}">EPF Number:</label>
                        <input type="text" class="form-control" id="epf${ftcCounter}" name="epf${ftcCounter}">
                    </div>
                </div>`;
            
            $('#ftcFieldsContainer').append(rowHtml);  // Add the new row
            ftcCounter++;  // Increment counter for next row
        }

        // Button click event to add more FTC rows
        $('#addFtcRow').click(function() {
            addFtcRow();
        });
    });
</script>

</body>
</html>
