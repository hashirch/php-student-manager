<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = "Student deleted successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
} else {
    $message = "No student ID provided!";
}

// Redirect back to students list
header("Location: view_students.php?message=" . urlencode($message));
exit();
?> 