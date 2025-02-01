<?php 
session_start();

// Variable declaration
$Student_Id = "";
$username = "";
$email    = "";
$errors = array(); 
$_SESSION['success'] = "";

// Connect to database using PDO
try {
    $db = new PDO('mysql:host=localhost;dbname=dbms;', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // Receive all input values from the form
    $Student_Id = trim($_POST['Student_Id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_1 = trim($_POST['password_1']);
    $password_2 = trim($_POST['password_2']);
    $roomno = trim($_POST['roomno']);

    // Form validation: ensure that the form is correctly filled
    if (empty($Student_Id)) { array_push($errors, "Student_Id is required"); }
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }

    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // Register user if there are no errors in the form
    if (count($errors) == 0) {
        // Store the password as plain text
        $password = $password_1; // No hashing

        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO registration (Student_Id, username, email, password, roomno) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$Student_Id, $username, $email, $password, $roomno]);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: login.php');
        exit();
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $Student_Id = trim($_POST['Student_Id']);
    $password = trim($_POST['password']);

    if (empty($Student_Id)) {
        array_push($errors, "Student_Id is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        // Use prepared statements for login as well
        $query = "SELECT * FROM registration WHERE Student_Id=?";
        $stmt = $db->prepare($query);
        $stmt->execute([$Student_Id]);
        
        // Get result
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Verify password directly without hashing
            if ($password === $row['password']) { // Direct comparison for plain text password
                $_SESSION['username'] = $row['username'];
                $_SESSION['success'] = "You are now logged in";
                $_SESSION['Student_Id'] = $Student_Id;
                
                header('location: student_manage.php');
                exit();
            } else {
                array_push($errors, "Wrong Student_Id/password combination");
            }
        } else {
            array_push($errors, "Wrong Student_Id/password combination");
        }
    }
}
?>