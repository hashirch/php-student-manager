<?php
include 'config.php';

$student = null;
$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
    
    if (!$student) {
        $message = "Student not found!";
    }
} else {
    $message = "No student ID provided!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .nav { margin-bottom: 20px; }
        .student-card { 
            border: 1px solid #ddd; 
            padding: 20px; 
            border-radius: 5px; 
            max-width: 600px; 
            margin: 20px 0;
        }
        .detail-row { 
            margin-bottom: 15px; 
            border-bottom: 1px solid #eee; 
            padding-bottom: 10px;
        }
        .label { 
            font-weight: bold; 
            color: #333; 
            display: inline-block; 
            width: 150px; 
        }
        .value { 
            color: #666; 
        }
        .message { 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px; 
            background-color: #f8d7da; 
            color: #721c24; 
        }
        .actions { 
            margin-top: 20px; 
        }
        .actions a { 
            margin-right: 15px; 
            text-decoration: none; 
            padding: 8px 15px; 
            border-radius: 3px; 
        }
        .edit-btn { 
            background-color: #007bff; 
            color: white; 
        }
        .back-btn { 
            background-color: #6c757d; 
            color: white; 
        }
    </style>
</head>
<body>
    <div class="nav">
        <a href="view_students.php">View Students</a> |
        <a href="add_student.php">Add Student</a>
    </div>
    
    <h2>Student Details</h2>
    
    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
        <a href="view_students.php">Back to Students List</a>
    <?php elseif ($student): ?>
        <div class="student-card">
            <div class="detail-row">
                <span class="label">Student ID:</span>
                <span class="value"><?= $student['id'] ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">Name:</span>
                <span class="value"><?= htmlspecialchars($student['name']) ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">Email:</span>
                <span class="value"><?= htmlspecialchars($student['email']) ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">Phone:</span>
                <span class="value"><?= htmlspecialchars($student['phone']) ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">Date of Birth:</span>
                <span class="value"><?= $student['dob'] ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">Gender:</span>
                <span class="value"><?= htmlspecialchars($student['gender']) ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">Address:</span>
                <span class="value"><?= nl2br(htmlspecialchars($student['address'])) ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">Department:</span>
                <span class="value"><?= htmlspecialchars($student['department']) ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">CGPA:</span>
                <span class="value"><?= $student['cgpa'] ?></span>
            </div>
            
            <div class="detail-row">
                <span class="label">Enrollment Date:</span>
                <span class="value"><?= $student['enrollment_date'] ?></span>
            </div>
            
            <div class="actions">
                <a href="edit_student.php?id=<?= $student['id'] ?>" class="edit-btn">Edit Student</a>
                <a href="view_students.php" class="back-btn">Back to List</a>
            </div>
        </div>
    <?php endif; ?>
</body>
</html> 