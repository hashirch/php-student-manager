<?php
/**
 * Sample Data Insertion Script
 * 
 * This script populates the students table with sample Pakistani student data
 * for testing the Student Management System. It includes 8 students with
 * realistic Pakistani names, addresses, and contact information.
 * 
 * Usage: Run this script once to add sample data to your database.
 * 
 * @author Student Management System
 * @version 1.0
 */

include 'config.php';

// Sample student data with Pakistani names and information
$sample_students = [
    [
        'name' => 'Ahmed Ali Khan',
        'email' => 'ahmed.ali@email.com',
        'phone' => '0300-123-4567',
        'dob' => '2000-05-15',
        'gender' => 'Male',
        'address' => 'House #123, Street 5, Gulberg III, Lahore, Punjab',
        'department' => 'Computer Science',
        'cgpa' => 3.75,
        'enrollment_date' => '2022-09-01'
    ],
    [
        'name' => 'Fatima Zahra',
        'email' => 'fatima.zahra@email.com',
        'phone' => '0301-234-5678',
        'dob' => '2001-03-20',
        'gender' => 'Female',
        'address' => 'Flat #45, Block 7, Clifton, Karachi, Sindh',
        'department' => 'Mathematics',
        'cgpa' => 3.90,
        'enrollment_date' => '2022-09-01'
    ],
    [
        'name' => 'Muhammad Hassan Raza',
        'email' => 'hassan.raza@email.com',
        'phone' => '0302-345-6789',
        'dob' => '1999-11-10',
        'gender' => 'Male',
        'address' => 'House #78, Street 12, F-8/1, Islamabad',
        'department' => 'Physics',
        'cgpa' => 3.60,
        'enrollment_date' => '2022-09-01'
    ],
    [
        'name' => 'Ayesha Siddiqui',
        'email' => 'ayesha.siddiqui@email.com',
        'phone' => '0303-456-7890',
        'dob' => '2000-08-25',
        'gender' => 'Female',
        'address' => 'House #234, Street 8, Model Town, Lahore, Punjab',
        'department' => 'Computer Science',
        'cgpa' => 3.85,
        'enrollment_date' => '2022-09-01'
    ],
    [
        'name' => 'Usman Malik',
        'email' => 'usman.malik@email.com',
        'phone' => '0304-567-8901',
        'dob' => '2001-01-30',
        'gender' => 'Male',
        'address' => 'Flat #12, Block 3, Defence Housing Authority, Karachi',
        'department' => 'Chemistry',
        'cgpa' => 3.70,
        'enrollment_date' => '2022-09-01'
    ],
    [
        'name' => 'Sana Javed',
        'email' => 'sana.javed@email.com',
        'phone' => '0305-678-9012',
        'dob' => '2000-12-05',
        'gender' => 'Female',
        'address' => 'House #56, Street 15, Satellite Town, Rawalpindi',
        'department' => 'Electrical Engineering',
        'cgpa' => 3.80,
        'enrollment_date' => '2022-09-01'
    ],
    [
        'name' => 'Bilal Ahmed',
        'email' => 'bilal.ahmed@email.com',
        'phone' => '0306-789-0123',
        'dob' => '1999-07-18',
        'gender' => 'Male',
        'address' => 'House #89, Street 3, Gulshan-e-Iqbal, Karachi',
        'department' => 'Mechanical Engineering',
        'cgpa' => 3.65,
        'enrollment_date' => '2022-09-01'
    ],
    [
        'name' => 'Zara Khan',
        'email' => 'zara.khan@email.com',
        'phone' => '0307-890-1234',
        'dob' => '2001-04-12',
        'gender' => 'Female',
        'address' => 'Flat #23, Block 5, Bahria Town, Lahore',
        'department' => 'Business Administration',
        'cgpa' => 3.95,
        'enrollment_date' => '2022-09-01'
    ]
];

// Insert sample data
$sql = "INSERT INTO students (name, email, phone, dob, gender, address, department, cgpa, enrollment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

$inserted = 0;
$errors = 0;

foreach ($sample_students as $student) {
    mysqli_stmt_bind_param($stmt, "sssssssds", 
        $student['name'], 
        $student['email'], 
        $student['phone'], 
        $student['dob'], 
        $student['gender'], 
        $student['address'], 
        $student['department'], 
        $student['cgpa'], 
        $student['enrollment_date']
    );
    
    if (mysqli_stmt_execute($stmt)) {
        $inserted++;
    } else {
        $errors++;
        echo "Error inserting " . $student['name'] . ": " . mysqli_error($conn) . "<br>";
    }
}

mysqli_stmt_close($stmt);

echo "Sample data insertion completed!<br>";
echo "Successfully inserted: $inserted students<br>";
echo "Errors: $errors<br>";
echo "<a href='view_students.php'>View Students</a>";
?> 