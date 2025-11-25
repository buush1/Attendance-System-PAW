<?php
// test_connection.php - Test database connection
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Database Connection</title>
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
        h2 {
            color: #722f37;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e8c8ce;
            padding-bottom: 10px;
        }
        .success {
            color: #10b981;
            font-weight: bold;
        }
        .error {
            color: #dc2626;
            font-weight: bold;
        }
        ul {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
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
        <?php
        echo "<h2>Testing Database Connection</h2>";

        try {
            require_once 'db_connect.php';
            
            // For Exercise 3, show the creation messages
            echo "<h3>Database Setup:</h3>";
            createDatabaseAndTables(true); // TRUE shows the green messages
            
            // Attempt to connect to database
            $conn = getDBConnection();
            
            if ($conn) {
                echo "<p class='success'>✓ Connection successful!</p>";
                
                // Display database info
                echo "<h3>Database Information:</h3>";
                echo "<ul>";
                echo "<li>Database Host: " . DB_HOST . "</li>";
                echo "<li>Database Name: " . DB_NAME . "</li>";
                echo "<li>PDO Driver: " . $conn->getAttribute(PDO::ATTR_DRIVER_NAME) . "</li>";
                echo "<li>Server Version: " . $conn->getAttribute(PDO::ATTR_SERVER_VERSION) . "</li>";
                echo "</ul>";
                
                // Show tables
                $tables = $conn->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
                echo "<h3>Tables Created:</h3>";
                echo "<ul>";
                foreach ($tables as $table) {
                    echo "<li>" . $table . "</li>";
                }
                echo "</ul>";
                
                $conn = null;
            } else {
                echo "<p class='error'>✗ Connection failed!</p>";
            }
            
        } catch (Exception $e) {
            echo "<p class='error'>✗ Connection failed: " . $e->getMessage() . "</p>";
            echo "<p>Check your config.php settings and ensure MySQL is running.</p>";
        }

        echo "<hr>";
        echo "<p>Exercise 3 - Database Connection Complete!</p>";
        ?>
    </div>
</body>
</html>