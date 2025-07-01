# 🎓 Student Management System

A comprehensive **PHP CRUD application** for managing student records with advanced search, filter, and sort functionality. Built with modern PHP practices and security features.

![PHP](https://img.shields.io/badge/PHP-7.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-8.0+-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)

## ✨ Features

### 🗄️ **Database Structure**
- **Database**: `student_db`
- **Table**: `students` with 10 comprehensive attributes:
  - `id` (Primary Key, Auto-increment)
  - `name` (VARCHAR)
  - `email` (VARCHAR, Unique)
  - `phone` (VARCHAR)
  - `dob` (DATE)
  - `gender` (ENUM: 'Male', 'Female', 'Other')
  - `address` (TEXT)
  - `department` (VARCHAR)
  - `cgpa` (DECIMAL)
  - `enrollment_date` (DATE)

### 🔧 **Core CRUD Operations**
- ✅ **Create**: Add new students with comprehensive form validation
- ✅ **Read**: Display all students with advanced search and filter options
- ✅ **Update**: Edit existing student records with real-time validation
- ✅ **Delete**: Remove students with confirmation dialog

### 🚀 **Advanced Features**
- 🔍 **Smart Search**: Search by name, email, or department
- 🏢 **Department Filter**: Filter students by department dropdown
- 📊 **Multi-Sort**: Sort by name, CGPA, or enrollment date (ASC/DESC)
- ✅ **Input Validation**: Comprehensive validation for all fields
- 👤 **Student Details**: Detailed view of individual student records
- 🎨 **Responsive Design**: Clean, modern interface

### 🔒 **Security Features**
- 🛡️ **SQL Injection Protection**: All queries use prepared statements
- 🧹 **XSS Prevention**: Output properly escaped with `htmlspecialchars()`
- ✅ **Input Validation**: Server-side validation for all user inputs
- 🔐 **Unique Constraints**: Email addresses are unique to prevent duplicates
- 🚫 **Error Handling**: Comprehensive error handling and user feedback

## 🛠️ Technology Stack

- **Backend**: PHP 7.0+
- **Database**: MySQL 5.7+
- **Server**: Apache (XAMPP)
- **Frontend**: HTML5, CSS3, JavaScript
- **Security**: Prepared Statements, Input Validation, XSS Protection

## 📦 Installation

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL)
- PHP 7.0 or higher
- MySQL 5.7 or higher

### Quick Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/student-management-system.git
   cd student-management-system
   ```

2. **Start XAMPP**
   - Start Apache and MySQL services
   - Ensure both services are running

3. **Create Database**
   ```bash
   # Navigate to your project directory
   cd C:\xampp\htdocs\your-project-folder
   
   # Run the database creation script
   php create_database.php
   ```

4. **Add Sample Data (Optional)**
   ```bash
   # Add Pakistani student sample data
   php sample_data.php
   ```

5. **Access the Application**
   ```
   http://localhost/your-project-folder/
   ```

## 📁 Project Structure

```
student-management-system/
├── 📄 index.php              # Main entry point
├── ⚙️ config.php             # Database configuration
├── 🗄️ create_database.php    # Database & table creation
├── 📊 sample_data.php        # Sample Pakistani student data
├── ➕ add_student.php        # Add new student form
├── 📋 view_students.php      # Main students list (search/filter/sort)
├── ✏️ edit_student.php       # Edit student form
├── 🗑️ delete_student.php     # Delete student functionality
├── 👤 student_details.php    # Detailed student view
└── 📖 README.md             # Project documentation
```

## 🎯 Usage Guide

### Adding a Student
1. Click **"Add Student"** link
2. Fill in all required fields with valid data
3. Submit the form
4. System validates:
   - Required fields
   - Valid email format
   - CGPA range (0-4)
   - Unique email addresses

### Managing Students
- **View All**: Main page displays all students in a responsive table
- **Search**: Use search bar to find students by name, email, or department
- **Filter**: Use department dropdown to filter by specific department
- **Sort**: Click column headers to sort by different fields

### Student Operations
- **Edit**: Click "Edit" link to modify student information
- **Delete**: Click "Delete" with confirmation dialog
- **View Details**: Click student name for complete information

## 🌟 Sample Data

The system includes sample data with **Pakistani student information**:
- **Names**: Ahmed Ali Khan, Fatima Zahra, Muhammad Hassan Raza, etc.
- **Cities**: Lahore, Karachi, Islamabad, Rawalpindi
- **Departments**: Computer Science, Mathematics, Physics, Engineering, Business
- **Phone Numbers**: Pakistani format (03xx-xxx-xxxx)

## 🔧 Configuration

### Database Settings
Edit `config.php` to modify database connection:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";
```

### Customization
- **Add Fields**: Modify table structure in `create_database.php`
- **Styling**: Update CSS in each file's `<style>` section
- **Validation**: Modify validation logic in form files

## 🐛 Troubleshooting

### Common Issues

| Issue | Solution |
|-------|----------|
| Database Connection Error | Ensure MySQL is running in XAMPP |
| Table Not Found | Run `create_database.php` first |
| Permission Errors | Check XAMPP and file permissions |
| Email Already Exists | Use a different email address |

### Error Messages
- **"Email already exists"**: Try a different email address
- **"Validation errors"**: Check all required fields and format requirements
- **"Student not found"**: Invalid student ID or deleted record

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Student Management System**
- **Version**: 1.0
- **Language**: PHP
- **Database**: MySQL

## 🙏 Acknowledgments

- Built for educational purposes
- Demonstrates modern PHP development practices
- Includes comprehensive security features
- Features Pakistani student data for local relevance

---

⭐ **Star this repository if you find it helpful!**"# PHP_student_DB" 
"# PHP_student_DB" 
"# PHP_student_DB" 
# PHP_student_DB
