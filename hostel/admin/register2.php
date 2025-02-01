<?php include('staffreg.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Registration</title>
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
            padding: 20px; /* Padding around header */
            text-align: center; /* Centered text */
            border-radius: 5px; /* Rounded corners */
            margin-bottom: 20px; /* Space below header */
        }

        form {
            background-color: white; /* White background for the form */
            padding: 20px; /* Padding inside the form */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            max-width: 500px; /* Maximum width of the form */
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
        input[type="date"],
        select {
            width: calc(100% - 22px); /* Full width inputs with padding adjustment */
            padding: 10px; /* Padding inside inputs */
            border-radius: 4px; /* Rounded corners */
            border: 1px solid #ccc; /* Light grey border */
            box-sizing: border-box; /* Include padding in width calculation */
        }

        button.btn {
            background-color: #4CAF50; /* Green background for buttons */
            color: white; /* White text for buttons */
            border: none; /* No border for buttons */
            padding: 10px; /* Padding inside buttons */
            border-radius: 4px; /* Rounded corners for buttons */
            cursor: pointer; /* Pointer cursor on hover */
            width: 100%; /* Full width button */
        }

        button.btn:hover {
            background-color: #45a049; 
        }

        .error {
            color: red; 
            margin-bottom: 15px; 
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Staff Registration</h2>
    </div>
    
    <form method="post" action="register2.php">

        <?php include('errors.php'); ?>

        <div class="input-group">
            <label>Staff Name</label>
            <input type="text" name="staffname" value="<?php echo $staffname; ?>">
        </div>
        
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        
        <div class="input-group">
            <label>Phone No.</label>
            <input type="text" name="phone_no">
        </div>
        
        <div class="input-group">
            <label>Registration Date</label>
            <input type="date" name="reg_date" value="<?php echo date("Y-m-d"); ?>">
        </div>

        <div class="input-group">
            <label for="department">Department</label>
    		<select id="department" name="department">
      			<option value="Electricity issue">Electricity issue</option>
      			<option value="Carpentry issue">Carpentry issue</option>
      			<option value="Leakage issue">Leakage issue</option>
      			<option value="Cleaning/housekeeping issue">Cleaning/housekeeping issue</option>
      			<option value="Mess food issue">Mess food issue</option>
      			<option value="Other issue">Other issue</option>
    		</select>
		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="reg2_user">Add to List</button>
		</div>

    </form>

</body>
</html>