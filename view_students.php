<?php
include 'config.php';

// Search functionality
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$department_filter = isset($_GET['department']) ? $_GET['department'] : '';
$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$sort_order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Build query
$sql = "SELECT * FROM students WHERE 1=1";
$params = [];
$types = "";

if (!empty($search)) {
    $sql .= " AND (name LIKE ? OR email LIKE ? OR department LIKE ?)";
    $search_param = "%$search%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= "sss";
}

if (!empty($department_filter)) {
    $sql .= " AND department = ?";
    $params[] = $department_filter;
    $types .= "s";
}

$sql .= " ORDER BY $sort_by $sort_order";

// Prepare and execute query
$stmt = mysqli_prepare($conn, $sql);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Get unique departments for filter dropdown
$dept_result = mysqli_query($conn, "SELECT DISTINCT department FROM students ORDER BY department");
$departments = [];
while ($row = mysqli_fetch_assoc($dept_result)) {
    $departments[] = $row['department'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .nav { margin-bottom: 20px; }
        .filters { margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 5px; }
        .filters input, .filters select { padding: 5px; margin-right: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .actions a { margin-right: 10px; text-decoration: none; }
        .edit { color: #007bff; }
        .delete { color: #dc3545; }
        .view { color: #28a745; }
        .sort-links a { margin-right: 10px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="view_students.php">View Students</a> |
        <a href="add_student.php">Add Student</a>
    </div>
    
    <h2>Students List</h2>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="message <?= strpos($_GET['message'], 'Error') !== false ? 'error' : 'success' ?>">
            <?= htmlspecialchars($_GET['message']) ?>
        </div>
    <?php endif; ?>
    
    <!-- Search and Filter Form -->
    <div class="filters">
        <form method="GET">
            <input type="text" name="search" placeholder="Search by name, email, or department" 
                   value="<?= htmlspecialchars($search) ?>" style="width: 300px;">
            
            <select name="department">
                <option value="">All Departments</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?= $dept ?>" <?= $department_filter == $dept ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dept) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit">Search/Filter</button>
            <a href="view_students.php">Clear</a>
        </form>
    </div>
    
    <!-- Sort Options -->
    <div class="sort-links">
        Sort by: 
        <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'name', 'order' => $sort_by == 'name' && $sort_order == 'ASC' ? 'DESC' : 'ASC'])) ?>">Name</a>
        <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'cgpa', 'order' => $sort_by == 'cgpa' && $sort_order == 'ASC' ? 'DESC' : 'ASC'])) ?>">CGPA</a>
        <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'enrollment_date', 'order' => $sort_by == 'enrollment_date' && $sort_order == 'ASC' ? 'DESC' : 'ASC'])) ?>">Enrollment Date</a>
    </div>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Department</th>
            <th>CGPA</th>
            <th>Enrollment Date</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><a href="student_details.php?id=<?= $row['id'] ?>" class="view"><?= htmlspecialchars($row['name']) ?></a></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['department']) ?></td>
                <td><?= $row['cgpa'] ?></td>
                <td><?= $row['enrollment_date'] ?></td>
                <td class="actions">
                    <a href="edit_student.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                    <a href="delete_student.php?id=<?= $row['id'] ?>" class="delete" 
                       onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        
        <?php if (mysqli_num_rows($result) == 0): ?>
            <tr>
                <td colspan="8" style="text-align: center;">No students found.</td>
            </tr>
        <?php endif; ?>
    </table>
    
    <br>
    <a href="add_student.php">➕ Add New Student</a>
</body>
</html> 