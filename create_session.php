<?php
require_once 'db_connect.php';

$success_message = '';
$error_message = '';
$session_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = trim($_POST['course_id']);
    $group_id = trim($_POST['group_id']);
    $opened_by = trim($_POST['opened_by']);
    $date = date('Y-m-d');
    
    try {
        $conn = getDBConnection();
        $sql = "INSERT INTO attendance_sessions (course_id, group_id, date, opened_by, status) VALUES (?, ?, ?, ?, 'open')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$course_id, $group_id, $date, $opened_by]);
        
        $session_id = $conn->lastInsertId();
        $success_message = "Session created successfully! Session ID: " . $session_id;
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Session</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fdf8fa 0%, #f8f0f2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .nav-bar {
            background: #722f37;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding: 0 20px;
        }
        .nav-link {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            background: rgba(255,255,255,0.2);
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.3);
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(114, 47, 55, 0.08);
            border: 1px solid #e8c8ce;
        }
        h1 {
            color: #722f37;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e8c8ce;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #2d3748;
            font-weight: 500;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #722f37;
            box-shadow: 0 0 0 3px rgba(114, 47, 55, 0.1);
        }
        button {
            background: #722f37;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        button:hover {
            background: #5a252b;
            transform: translateY(-2px);
        }
        .success {
            color: #10b981;
            background: rgba(16, 185, 129, 0.1);
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #10b981;
            margin-bottom: 20px;
            text-align: center;
        }
        .error {
            color: #dc2626;
            background: rgba(220, 38, 38, 0.1);
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #dc2626;
            margin-bottom: 20px;
        }
        .session-id {
            background: #f0f9ff;
            border: 2px solid #0ea5e9;
            color: #0369a1;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <!-- NAVIGATION BAR -->
    <div class="nav-bar">
        <div class="nav-container">
            <a href="menu.php" class="nav-link">🏠 Menu</a>
            <a href="add_student.php" class="nav-link">➕ Add Student (JSON)</a>
            <a href="take_attendance.php" class="nav-link">📝 Take Attendance</a>
            <a href="add_student_db.php" class="nav-link">➕ Add Student (DB)</a>
            <a href="list_students.php" class="nav-link">📋 List Students</a>
            <a href="create_session.php" class="nav-link">🎯 Create Session</a>
            <a href="close_session.php" class="nav-link">🔒 Close Session</a>
            <a href="index.html" class="nav-link">🚀 Main System</a>
        </div>
    </div>

    <div class="container">
        <h1>Create Attendance Session</h1>
        
        <?php if ($success_message): ?>
            <div class="success"><?php echo $success_message; ?></div>
            <?php if ($session_id): ?>
                <div class="session-id">Session ID: <?php echo $session_id; ?></div>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="course_id">Course ID:</label>
                <input type="text" id="course_id" name="course_id" required>
            </div>
            <div class="form-group">
                <label for="group_id">Group ID:</label>
                <input type="text" id="group_id" name="group_id" required>
            </div>
            <div class="form-group">
                <label for="opened_by">Professor ID:</label>
                <input type="text" id="opened_by" name="opened_by" required>
            </div>
            <button type="submit">Create Session</button>
        </form>
    </div>
</body>
</html>