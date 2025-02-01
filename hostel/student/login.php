<?php 
include('server.php'); 

// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize variables
$Student_Id = "";
$password = "";
$errors = [];

// Form submission handling
if (isset($_POST['login_user'])) {
    // Receive input values from the form
    $Student_Id = trim($_POST['Student_Id']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($Student_Id)) {
        $errors[] = "Student ID is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // If there are no errors, proceed with login logic
    if (count($errors) == 0) {
        // Prepare and execute the query to fetch user by Student ID
        $query = "SELECT * FROM registration WHERE Student_Id = :student_id"; // Adjust table name as needed
        $stmt = $db->prepare($query); // Using PDO for prepared statement
        $stmt->bindParam(':student_id', $Student_Id);
        $stmt->execute();
        
        // Fetch user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and verify password
        if ($user && password_verify($password, $user['password'])) { // Correctly verify hashed password
            // Store user data in session variables
            $_SESSION['Student_Id'] = $user['Student_Id'];
            $_SESSION['username'] = $user['username']; // Assuming you have a username field

            // Redirect to student management page or dashboard
            header('Location: student_manage.php');
            exit(); // Ensure no further code is executed after redirect
        } else {
            // If credentials are incorrect, add an error message
            $errors[] = "Invalid Student ID or Password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Login Container */
        .login-container {
            background-color: #fff9e6; /* Light yellow background */
            max-width: 400px;
            width: 100%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-out;
        }

        /* Header */
        h2 {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            animation: slideIn 0.8s ease-out;
        }

        /* Input Group */
        .input-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 1rem;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input:focus {
            border-color: #007bff;
        }

        /* Button */
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Error Styling */
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        /* Table Layout */
        table {
            width: 100%;
        }

        /* Animations */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes slideIn {
            0% { transform: translateY(-10px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <table>
                <tr>
                    <td>
                        <div class="input-group">
                            <label>Student ID</label>
                            <input type="text" name="Student_Id" value="<?php echo htmlspecialchars($Student_Id); ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
                            <label>Password</label>
                            <input type="password" name="password">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" class="btn" name="login_user">Login</button>
                    </td>
                </tr>
            </table>
        </form>

        <p style="text-align: center; margin-top: 10px;">
            Not yet a member? <a href="register.php">Sign up</a>
        </p>
    </div>

</body>
</html>