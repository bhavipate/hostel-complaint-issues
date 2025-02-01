<?php include('adminlogin.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
     
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f5; /* Light gray background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

      
        .login-container {
            background-color: #fff9e6; /* Light yellow background for form */
            max-width: 400px;
            width: 100%;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); 
            animation: fadeIn 1s ease-out;
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 20px;
            animation: slideDown 1s ease-out;
        }

        /* Input and Button Styles */
        .input-group {
            margin: 15px 0;
            text-align: left;
        }

        label {
            font-size: 1rem;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .btn-info {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s ease-in-out;
            width: 100%;
        }

        .btn-info:hover {
            background-color: #0056b3;
            transform: scale(1.05); 
        }

        /* Animations */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes slideDown {
            0% { transform: translateY(-20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

    <!-- Centered Login Container -->
    <div class="login-container">
        <h2>Admin Login</h2>

        <?php include('errors.php'); ?>

        <form method="post" action="">
            <div class="input-group">
                <label>Admin Id</label>
                <input type="text" name="id" value="<?php echo $id; ?>"> <!-- Retain value for user input -->
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-info" name="login_user1">Login</button>
            </div>
        </form>
    </div>

</body>
</html>