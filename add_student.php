<?php
include 'config.php';

$message = '';

if (isset($_POST['submit'])) {
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
        $sql = "INSERT INTO students (name, email, phone, dob, gender, address, department, cgpa, enrollment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssds", $name, $email, $phone, $dob, $gender, $address, $department, $cgpa, $enrollment_date);
        
        if (mysqli_stmt_execute($stmt)) {
            $message = "Student added successfully!";
            // Clear form data
            $_POST = array();
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
    <title>Add New Student</title>
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
    
    <h2>Add New Student</h2>
    
    <?php if ($message): ?>
        <div class="message <?= strpos($message, 'Error') !== false ? 'error' : 'success' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="phone" value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" name="dob" value="<?= isset($_POST['dob']) ? $_POST['dob'] : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Gender:</label>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Address:</label>
            <textarea name="address" rows="3" required><?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Department:</label>
            <input type="text" name="department" value="<?= isset($_POST['department']) ? htmlspecialchars($_POST['department']) : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>CGPA:</label>
            <input type="number" name="cgpa" step="0.01" min="0" max="4" value="<?= isset($_POST['cgpa']) ? $_POST['cgpa'] : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Enrollment Date:</label>
            <input type="date" name="enrollment_date" value="<?= isset($_POST['enrollment_date']) ? $_POST['enrollment_date'] : '' ?>" required>
        </div>
        
        <div class="form-group">
            <button type="submit" name="submit">Add Student</button>
        </div>
    </form>
</body>
</html> 