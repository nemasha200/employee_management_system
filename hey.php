<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radio Button Example</title>
</head>
<body>

    <h2>Select Your Gender</h2>
    <form action="insert.php" method="post">
        <label for="male">Male</label>
        <input type="radio" id="male" name="gender" value="Male"><br>

        <label for="female">Female</label>
        <input type="radio" id="female" name="gender" value="Female"><br>

        <label for="other">Other</label>
        <input type="radio" id="other" name="gender" value="Other"><br><br>

        <input type="submit" value="Submit">
    </form>

</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Dropdown</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #selectionDisplay {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <form id="myForm">
            <!-- Wrap label and dropdown inside a div -->
            <div id="dropdownDiv">
                <div class="form-group">
                    <label for="dropdown">Select Type:</label>
                    <select class="form-control" id="dropdown" name="type">
                        <option value="" disabled selected>Select an option</option>
                        <option value="RMS">RMS</option>
                        <option value="DLS">DLS</option>
                        <option value="RWS">RWS</option>
                        <option value="TMS">TMS</option>
                    </select>
                </div>
            </div>
            <div id="selectionDisplay">
                <h4 id="selectedValue"></h4>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('dropdown').addEventListener('change', function() {
            var selected = this.options[this.selectedIndex].text;
            document.getElementById('selectedValue').innerText = selected;
            
            // Show the h4 and hide the dropdown and label
            document.getElementById('selectionDisplay').style.display = 'block';
            document.getElementById('dropdownDiv').style.display = 'none';
        });
    </script>
</body>
</html>
