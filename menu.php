<?php
// menu.php - Main Menu for all exercises
?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance System - Main Menu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fdf8fa 0%, #f8f0f2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(114, 47, 55, 0.08);
            border: 1px solid #e8c8ce;
        }
        h1 {
            color: #722f37;
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #e8c8ce;
            padding-bottom: 15px;
        }
        .section {
            margin: 30px 0;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #722f37;
        }
        .section h2 {
            color: #722f37;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }
        .button-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 12px;
        }
        .nav-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: #722f37;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        .nav-btn:hover {
            background: #5a252b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(114, 47, 55, 0.3);
        }
        .section-info {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Attendance System - Main Menu</h1>
        
        <!-- Student Management -->
        <div class="section">
            <h2>👥 Student Management</h2>
            <p class="section-info">Add and manage student records</p>
            <div class="button-grid">
                <a href="add_student.php" class="nav-btn">
                    <span>➕</span> Add Student (JSON)
                </a>
                <a href="add_student_db.php" class="nav-btn">
                    <span>➕</span> Add Student (Database)
                </a>
                <a href="list_students.php" class="nav-btn">
                    <span>📋</span> View All Students
                </a>
            </div>
        </div>
        
        <!-- Attendance System -->
        <div class="section">
            <h2>📝 Attendance Tracking</h2>
            <p class="section-info">Take and manage student attendance</p>
            <div class="button-grid">
                <a href="take_attendance.php" class="nav-btn">
                    <span>📝</span> Take Attendance
                </a>
                <a href="create_session.php" class="nav-btn">
                    <span>🎯</span> Create Session
                </a>
                <a href="close_session.php" class="nav-btn">
                    <span>🔒</span> Close Session
                </a>
            </div>
        </div>
        
        <!-- Database Management -->
        <div class="section">
            <h2>🗄️ Database Management</h2>
            <p class="section-info">Database configuration and testing</p>
            <div class="button-grid">
                <a href="test_connection.php" class="nav-btn">
                    <span>🔧</span> Test Database Connection
                </a>
            </div>
        </div>
        
        <!-- Main Application -->
        <div class="section">
            <h2>🚀 Main Application</h2>
            <p class="section-info">Complete attendance system</p>
            <div class="button-grid">
                <a href="index.html" class="nav-btn">
                    <span>🚀</span> Launch Main System
                </a>
            </div>
        </div>
    </div>
</body>
</html>