<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Using PHP</title>

    <style>
 /* General styles */
/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f0e6f7; /* Light purple background */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Main container */
.maindiv {
    max-width: 800px;
    width: 100%;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    padding: 20px;
    animation: fadeIn 1s ease-in-out;
    transition: transform 0.3s;
}

.maindiv:hover {
    transform: scale(1.02); /* Slight zoom on hover */
}

/* Title styles */
.title h2 {
    text-align: center;
    color: #5a4d9e; /* Dark purple for title text */
}

/* Form section */
.divB {
    margin-top: 20px;
}

.divD p {
    font-size: 18px;
    color: #555;
}

/* Form styling */
.form {
    margin-top: 20px;
    padding: 15px;
    border-radius: 5px;
    background-color: #e9ecef;
    animation: slideIn 0.7s ease-in-out;
}

.input {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    transition: border-color 0.3s;
}

.input:focus {
    border-color: #5a4d9e;
}

/* Submit button */
.submit {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: none;
    background-color: #28a745;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.submit:hover {
    background-color: #218838;
}

/* Button styles */
button {
    padding: 10px 15px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    margin-right: 10px;
    transition: background-color 0.3s;
}

/* Logout button */
.logout {
    background-color: #dc3545;
    color: white;
}

.logout:hover {
    background-color: #c82333;
}

/* Back to homepage button */
.back-home {
    background-color: #5a4d9e; /* Dark purple */
    color: white;
}

.back-home:hover {
    background-color: #4e4291;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}


    </style>
</head>
<body>
    <div class="maindiv">
        <div class="divA">
            <div class="title">
                <h2>Update And Delete Your Data...</h2>
            </div>
            
            <div class="divB">
                <div class="divD">
                    <p>Click On Menu</p>

                    <?php
                    // Database connection using PDO
                    $dsn = 'mysql:host=localhost;dbname=dbms;charset=utf8';
                    $username = 'root';
                    $password = '';

                    try {
                        $connection = new PDO($dsn, $username, $password);
                        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Delete operation
                        if (isset($_GET['delete'])) {
                            $Student_Id = $_GET['delete'];
                            $stmtDelete = $connection->prepare("DELETE FROM registration WHERE Student_Id=?");
                            $stmtDelete->execute([$Student_Id]);
                        }

                        // Update operation
                        if (isset($_GET['submit'])) {
                            $Student_Id = $_GET['Student_Id'];
                            $username = $_GET['username'];
                            $email = $_GET['email'];
                            $password = $_GET['password'];
                            $roomno = $_GET['roomno'];

                            // Prepared statement for update
                            $stmt = $connection->prepare("UPDATE registration SET username=?, email=?, password=?, roomno=? WHERE Student_Id=?");
                            $stmt->execute([$username, $email, $password, $roomno, $Student_Id]);
                        }

                        // Display list of students
                        $query = $connection->query("SELECT * FROM registration");
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "<b><a href='update.php?update={$row['Student_Id']}'>{$row['Student_Id']}</a></b>";
                            echo " | <a href='update.php?delete={$row['Student_Id']}' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a><br />";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    ?>

                </div>

                <?php
                // Display update form for selected student
                if (isset($_GET['update'])) {
                    $update = $_GET['update'];
                    $stmt1 = $connection->prepare("SELECT * FROM registration WHERE Student_Id=?");
                    $stmt1->execute([$update]);

                    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        echo "<form class='form' method='get'>";
                        echo "<h2>Update Form</h2>";
                        echo "<hr/>";
                        echo "<input type='hidden' name='Student_Id' value='{$row1['Student_Id']}' />";
                        
                        // Form fields
                        echo "<label>Username:</label><br />";
                        echo "<input class='input' type='text' name='username' value='{$row1['username']}' /><br />";
                        
                        echo "<label>Email:</label><br />";
                        echo "<input class='input' type='text' name='email' value='{$row1['email']}' /><br />";
                        
                        echo "<label>Password:</label><br />";
                        echo "<input class='input' type='text' name='password' value='{$row1['password']}' /><br />";
                        
                        echo "<label>Room No:</label><br />";
                        echo "<input class='input' type='text' name='roomno' value='{$row1['roomno']}' /><br />";
                        
                        // Submit button
                        echo "<input class='submit' type='submit' name='submit' value='Update' />";
                        echo "</form>";
                    }
                }

                // Success message after update or delete
                if (isset($_GET['submit'])) {
                    echo '<div class="form" id="form3"><br><br><span>Data Updated Successfully!</span></div>';
                } elseif (isset($_GET['delete'])) {
                    echo '<div class="form" id="form3"><br><br><span>Data Deleted Successfully!</span></div>';
                }
                ?>
<br>
                <div class="clear"></div>
                <hr>
                <!-- Logout and Back to Homepage buttons -->
                <button class="logout" onclick="window.location.href='login.php';">Logout</button>
                <button class="back-home" onclick="window.location.href='student_manage.php';">Back to Homepage</button>
                
            </div>
        </div>
    </div>

    <?php
    // Close the connection by destroying the PDO object
    $connection = null;
    ?>
</body>
</html>