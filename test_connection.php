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
        h3 {
            color: #722f37;
            margin-top: 25px;
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
        hr {
            border: none;
            border-top: 2px solid #e8c8ce;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <!-- UPDATED NAVIGATION BAR -->
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
            <a href="test_connection.php">Database connection</a>
        </nav>
    </header>

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

        ?>
    </div>
</body>
</html>