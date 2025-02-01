<?php 
include('server.php'); 

// Initialize variables
$Student_Id = "";
$username = "";
$email = "";
$roomno = "";
$errors = [];

// Form submission handling
if (isset($_POST['reg_user'])) {
    // Receive input values from the form
    $Student_Id = trim($_POST['Student_Id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $roomno = trim($_POST['roomno']);

    // Validate inputs
    if (empty($Student_Id)) {
        $errors[] = "Student ID is required";
    }
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($password_1)) {
        $errors[] = "Password is required";
    }
    if ($password_1 !== $password_2) {
        $errors[] = "Passwords do not match";
    }
    if (empty($roomno)) {
        $errors[] = "Room number is required";
    }

    // Check for existing Student ID in the database
    if (count($errors) == 0) {
        // Prepare and execute a query to check if Student ID already exists
        $query_check = "SELECT * FROM registration WHERE Student_Id = :student_id LIMIT 1";
        $stmt_check = $db->prepare($query_check);
        $stmt_check->bindParam(':student_id', $Student_Id);
        $stmt_check->execute();

        // If a record is found, add an error message
        if ($stmt_check->rowCount() > 0) {
            $errors[] = "Student ID already exists";
        }
    }

    // If there are no errors, proceed with registration
    if (count($errors) == 0) {
        // Use prepared statements to insert data into the database
        try {
            $query = "INSERT INTO registration (Student_Id, username, email, password, roomno) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            // Assuming password hashing is needed here; otherwise, use plain text
            $stmt->execute([$Student_Id, $username, $email, password_hash($password_1, PASSWORD_DEFAULT), $roomno]);

            // Redirect or show success message after registration
            header('location: login.php'); // Redirect to a success page
            exit();
        } catch (PDOException $e) {
            array_push($errors, "Registration failed: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
			margin: 0;
			padding: 20px;
		}

		.header {
			background-color: #4CAF50; /* Green background */
			color: white; /* White text */
			padding: 10px 20px; /* Padding around header */
			text-align: center; /* Centered text */
		}

		form {
			background-color: white; /* White background for the form */
			padding: 20px; /* Padding inside the form */
			border-radius: 5px; /* Rounded corners */
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
			max-width: 600px; /* Maximum width of the form */
			margin: auto; /* Center the form horizontally */
		}

		.input-group {
			margin-bottom: 15px; /* Space between input groups */
		}

		label {
			display: block; /* Block display for labels */
			margin-bottom: 5px; /* Space below labels */
			font-weight: bold; /* Bold labels */
		}

		input[type="text"],
		input[type="email"],
		input[type="password"],
		select {
			width: 100%; /* Full width inputs */
			padding: 10px; /* Padding inside inputs */
			border: 1px solid #ccc; /* Light grey border */
			border-radius: 4px; /* Rounded corners */
			box-sizing: border-box; /* Include padding in width calculation */
		}

		button.btn {
			background-color: #4CAF50; /* Green background for buttons */
			color: white; /* White text for buttons */
			border: none; /* No border for buttons */
			padding: 10px 15px; /* Padding inside buttons */
			border-radius: 4px; /* Rounded corners for buttons */
			cursor: pointer; /* Pointer cursor on hover */
		}

		button.btn:hover {
			background-color: #45a049; /* Darker green on hover */
		}

		p {
			text-align: center; /* Centered logout link paragraph */
		}

		.error {
            color: red; /* Red color for error messages */
            margin-bottom: 15px; /* Space below error messages */
            text-align: center;
            font-weight: bold;
        }
		
	</style>
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

        <!-- Display any form errors -->
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

		<div class="input-group">
			<label>Student Id</label>
			<input type="text" name="Student_Id" value="<?php echo $Student_Id; ?>">
		</div>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>

        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>

        <div class="input-group">
            <label>Room No.</label>
            <input type="text" name="roomno" value="<?php echo $roomno; ?>">
        </div>

        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>

        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>

	</form>
</body>
</html>