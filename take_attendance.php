<?php
// take_attendance.php - Exercise 2
date_default_timezone_set('UTC');
$today = date('Y-m-d');
$attendance_file = "attendance_$today.json";

// Check if attendance already taken for today
if (file_exists($attendance_file)) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Attendance Taken</title>
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
            .message {
                background: white;
                padding: 40px;
                border-radius: 12px;
                box-shadow: 0 8px 30px rgba(114, 47, 55, 0.08);
                text-align: center;
                border: 2px solid #e8c8ce;
                max-width: 500px;
                margin: 50px auto;
            }
            h1 {
                color: #dc2626;
                margin-bottom: 20px;
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
                <a href="index.html" class="nav-link">🚀 Main System</a>
            </div>
        </div>

        <div class="message">
            <h1>Attendance Already Taken</h1>
            <p>Attendance for today (<?php echo $today; ?>) has already been recorded.</p>
            <a href="add_student.php" class="nav-link" style="display: inline-block; margin-top: 20px;">Go to Add Students</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Load students from students.json
$students = [];
if (file_exists('students.json')) {
    $json_data = file_get_contents('students.json');
    $students = json_decode($json_data, true) ?: [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance = [];
    foreach ($_POST['attendance'] as $student_id => $status) {
        $attendance[] = [
            'student_id' => $student_id,
            'status' => $status
        ];
    }
    
    // Save attendance to today's file
    file_put_contents($attendance_file, json_encode($attendance, JSON_PRETTY_PRINT));
    $success_message = "Attendance saved for $today!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Take Attendance</title>
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
            max-width: 800px;
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
        .student-item {
            margin: 15px 0;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8f9fa;
        }
        .student-info {
            font-weight: 600;
            margin-bottom: 10px;
            color: #2d3748;
        }
        .attendance-options {
            display: flex;
            gap: 20px;
        }
        .radio-group {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        input[type="radio"] {
            transform: scale(1.2);
        }
        button {
            background: #722f37;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            width: 100%;
        }
        button:hover {
            background: #5a252b;
            transform: translateY(-2px);
        }
        .success {
            color: #10b981;
            background: rgba(16, 185, 129, 0.1);
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #10b981;
            margin-bottom: 20px;
            text-align: center;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #718096;
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
            <a href="index.html" class="nav-link">🚀 Main System</a>
        </div>
    </div>

    <div class="container">
        <h1>Take Attendance for <?php echo $today; ?></h1>
        
        <?php if (isset($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (empty($students)): ?>
            <div class="empty-state">
                <p>No students found. Please add students first.</p>
                <a href="add_student.php" class="nav-link" style="display: inline-block; margin-top: 10px;">Go to Add Students</a>
            </div>
        <?php else: ?>
            <form method="POST">
                <?php foreach ($students as $student): ?>
                    <div class="student-item">
                        <div class="student-info">
                            <?php echo $student['name']; ?> 
                            (ID: <?php echo $student['student_id']; ?>, Group: <?php echo $student['group']; ?>)
                        </div>
                        <div class="attendance-options">
                            <div class="radio-group">
                                <input type="radio" 
                                       id="present_<?php echo $student['student_id']; ?>" 
                                       name="attendance[<?php echo $student['student_id']; ?>]" 
                                       value="present" required>
                                <label for="present_<?php echo $student['student_id']; ?>">Present</label>
                            </div>
                            <div class="radio-group">
                                <input type="radio" 
                                       id="absent_<?php echo $student['student_id']; ?>" 
                                       name="attendance[<?php echo $student['student_id']; ?>]" 
                                       value="absent" required>
                                <label for="absent_<?php echo $student['student_id']; ?>">Absent</label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <button type="submit">Submit Attendance</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>