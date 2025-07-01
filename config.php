<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

// Create connection without database first
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the database
if (!mysqli_select_db($conn, $dbname)) {
    die("Database '$dbname' does not exist. Please run create_database.php first.");
}
?> 