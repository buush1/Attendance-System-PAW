<?php
require_once 'db_connect.php';

try {
    $conn = getDBConnection();
    $stmt = $conn->query("SELECT * FROM students ORDER BY id DESC");
    $students = $stmt->fetchAll();
} catch (PDOException $e) {
    $error_message = "Error: " . $e->getMessage();
    $students = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>List Students</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fdf8fa 0%, #f8f0f2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        header {
            background: #722f37;
            padding: 20px 0;
            margin-bottom: 20px;
            text-align: center;
        }
        header h1 {
            color: white;
            margin: 0 0 15px 0;
            font-size: 28px;
        }
        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            padding: 0 20px;
        }
        nav {
  margin-top: 1rem;
}

nav a {
  color: rgba(255, 255, 255, 0.9);
  margin-right: 1.5rem;
  text-decoration: none;
  font-weight: 500;
  padding: 0.5rem 0;
  position: relative;
  transition: all 0.3s ease;
}

nav a:hover {
  color: white;
}

nav a::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: white;
  transition: width 0.3s ease;
}

nav a:hover::after {
  width: 100%;
}
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(114, 47, 55, 0.08);
            border: 1px solid #e8c8ce;
        }
        .container h1 {
            color: #722f37;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e8c8ce;
            padding-bottom: 10px;
        }
        .students-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .students-table th,
        .students-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .students-table th {
            background: #f8f0f2;
            color: #722f37;
            font-weight: 600;
        }
        .students-table tr:hover {
            background: #fdf8fa;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-edit {
            background: #f59e0b;
            color: white;
        }
        .btn-delete {
            background: #dc2626;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #718096;
        }
        .error {
            color: #dc2626;
            background: rgba(220, 38, 38, 0.1);
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #dc2626;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Attendance System</h1>
        <nav>
            <a href="index.html">Home</a>        
            <a href="add_student_db.php">Add Student (db)</a>     
            <a href="add_student.php">Add Student (jk)</a>        
            <a href="list_students.php">List Students</a>
            <a href="take_attendance.php">Take Attendance</a>
            <a href="create_session.php">Create Session</a>
            <a href="close_session.php">Close Session</a>
            <a href="test_connection.php">Database Connection</a>
        </nav>
    </header>

    <div class="container">
        <h1>Students List</h1>
        
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <?php if (empty($students)): ?>
            <div class="empty-state">
                <p>No students found in database.</p>
                <a href="add_student_db.php" class="btn" style="display: inline-block; margin-top: 10px; background: #722f37; color: white; padding: 10px 20px;">Add First Student</a>
            </div>
        <?php else: ?>
            <table class="students-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Matricule</th>
                        <th>Group</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($student['matricule']); ?></td>
                        <td><?php echo htmlspecialchars($student['group_id']); ?></td>
                        <td><?php echo $student['created_at']; ?></td>
                        <td class="action-buttons">
                            <a href="update_student.php?id=<?php echo $student['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="delete_student.php?id=<?php echo $student['id']; ?>" class="btn btn-delete" onclick="return confirm('Delete this student?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>