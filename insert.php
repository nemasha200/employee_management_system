<?php
// Database connection settings
$servername = "localhost"; // Change if your DB server is hosted elsewhere
$username = "root";         // Your MySQL username (default for XAMPP is "root")
$password = "";             // Your MySQL password (default for XAMPP is empty)
$dbname = "inventory";  // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['gender'])) {
        $gender = $conn->real_escape_string($_POST['gender']); 

        
        $sql = "INSERT INTO users (gender) VALUES ('$gender')";

        if ($conn->query($sql) === TRUE) {
            header("Location: hey.php");;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "No gender selected!";
    }
}

// Close the database connection
$conn->close();
?>
