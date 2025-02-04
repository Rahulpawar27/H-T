<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Personal Details
    $full_name = $_POST["full_name"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    
    // Health and Fitness Details
    $height = $_POST["height"];
    $weight = $_POST["weight"];
    $goal = $_POST["goal"];
    
    // Contact Details
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    
    // Prepare and bind SQL statement for form data insertion
    $stmt = $conn->prepare("INSERT INTO data (full_name, dob, gender, height, weight, goal, email, mobile) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $full_name, $dob, $gender, $height, $weight, $goal, $email, $mobile);
    
    if ($stmt->execute() !== TRUE) {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    
    // Redirect to dashboard
    header("Location: dashboard.html");
    exit;
}

// Close connection
$conn->close();
?>