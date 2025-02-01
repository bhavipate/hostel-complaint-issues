<?php 
session_start();

// Variable declaration
$id = ""; // Initialize $id to an empty string
$password = "";
$errors = []; // Initialize the errors array
$_SESSION['success'] = "";

// Connect to database using PDO
try {
    $db1 = new PDO('mysql:host=localhost;dbname=dbms;', 'root', '');
    $db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_POST['login_user1'])) {
    // Use $db1 for database operations
    $id = trim($_POST['id']);
    $password = trim($_POST['password']);

    // Validation checks
    if (empty($id)) {
        array_push($errors, "Admin ID is required.");
    }
    if (empty($password)) {
        array_push($errors, "Password is required.");
    }

    // If there are no errors, proceed with login logic
    if (count($errors) == 0) {
        // Prepare and execute the query to fetch user by ID
        $query = "SELECT * FROM admin WHERE id = :id"; // Use a prepared statement
        $stmt = $db1->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch user data

            // Check if the provided password matches the stored plain text password
            if ($user['password'] === $password) { // Compare plain text passwords
                $_SESSION['id'] = $user['id']; // Store Admin ID in session
                $_SESSION['username'] = $user['username']; // Assuming you have a username field
                
                $_SESSION['success'] = "You are now logged in";
                header('Location: admin_manage.php'); // Redirect after successful login
                exit(); // Ensure no further code is executed after redirect
            } else {
                array_push($errors, "Wrong Admin ID/password combination");
            }
        } else {
            array_push($errors, "Wrong Admin ID/password combination");
        }
    }
}
?>