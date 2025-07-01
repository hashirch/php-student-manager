<?php
include 'config.php';

$message = '';
$student = null;

// Fetch student data
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
}

// Handle form submission
if (isset($_POST['update']) && $student) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = trim($_POST['address']);
    $department = trim($_POST['department']);
    $cgpa = $_POST['cgpa'];
    $enrollment_date = $_POST['enrollment_date'];
    
    // Validation
    $errors = [];
    
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
    if (empty($phone)) $errors[] = "Phone is required";
    if (empty($dob)) $errors[] = "Date of birth is required";
    if (empty($gender)) $errors[] = "Gender is required";
    if (empty($address)) $errors[] = "Address is required";
    if (empty($department)) $errors[] = "Department is required";
    if ($cgpa < 0 || $cgpa > 4) $errors[] = "CGPA must be between 0 and 4";
    if (empty($enrollment_date)) $errors[] = "Enrollment date is required";
    
    if (empty($errors)) {
        $sql = "UPDATE students SET name=?, email=?, phone=?, dob=?, gender=?, address=?, department=?, cgpa=?, enrollment_date=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssdsi", $name, $email, $phone, $dob, $gender, $address, $department, $cgpa, $enrollment_date, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            $message = "Student updated successfully!";
            // Update the student array with new values
            $student = array_merge($student, $_POST);
        } else {
            if (mysqli_errno($conn) == 1062) {
                $message = "Error: Email already exists!";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "Validation errors: " . implode(", ", $errors);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 120px; }
        input, select, textarea { padding: 5px; width: 200px; }
        .message { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .nav { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="view_students.php">View Students</a> |
        <a href="add_student.php">Add Student</a>
    </div>
    
    <h2>Edit Student</h2>
    
    <?php if ($message): ?>
        <div class="message <?= strpos($message, 'Error') !== false ? 'error' : 'success' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>
    
    <?php if ($student): ?>
        <form method="POST">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="dob" value="<?= $student['dob'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male" <?= $student['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $student['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= $student['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Address:</label>
                <textarea name="address" rows="3" required><?= htmlspecialchars($student['address']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Department:</label>
                <input type="text" name="department" value="<?= htmlspecialchars($student['department']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>CGPA:</label>
                <input type="number" name="cgpa" step="0.01" min="0" max="4" value="<?= $student['cgpa'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Enrollment Date:</label>
                <input type="date" name="enrollment_date" value="<?= $student['enrollment_date'] ?>" required>
            </div>
            
            <div class="form-group">
                <button type="submit" name="update">Update Student</button>
                <a href="view_students.php">Cancel</a>
            </div>
        </form>
    <?php else: ?>
        <p>Student not found!</p>
        <a href="view_students.php">Back to Students List</a>
    <?php endif; ?>
</body>
</html> 