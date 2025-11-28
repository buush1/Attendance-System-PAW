<?php
// add_student.php JSON version
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = trim($_POST['student_id']);
    $name = trim($_POST['name']);
    $group = trim($_POST['group']);
    
    // Validation
    $errors = [];
    if (empty($student_id)) $errors[] = "Student ID is required";
    if (empty($name)) $errors[] = "Name is required";
    if (empty($group)) $errors[] = "Group is required";
    
    if (empty($errors)) {
        // Load existing students from students.json
        $students = [];
        if (file_exists('students.json')) {
            $json_data = file_get_contents('students.json');
            $students = json_decode($json_data, true) ?: [];
        }
        
        // Add new student to array
        $students[] = [
            'student_id' => $student_id,
            'name' => $name,
            'group' => $group
        ];
        
        // Save back to students.json
        file_put_contents('students.json', json_encode($students, JSON_PRETTY_PRINT));
        
        $success_message = "Student added successfully!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
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
            max-width: 500px;
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
        <h1>Add Student</h1>
        
        <?php if (isset($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="group">Group:</label>
                <input type="text" id="group" name="group" required>
            </div>
            <button type="submit">Add Student</button>
        </form>
    </div>
</body>
</html>