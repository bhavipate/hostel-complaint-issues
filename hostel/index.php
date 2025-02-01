<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Complaint Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Global Styles */
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

        /* Container Styles */
        .container-box {
            background-color: #fff9e6; /* Light yellow background for container */
            max-width: 600px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
            text-align: center;
            animation: fadeIn 1s ease-out;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 2rem;
            color: #333; /* Darker text color for header */
            animation: slideIn 1s ease-out;
        }

        /* Table Styles */
        table {
            margin: auto;
            width: 100%;
        }

        td {
            padding: 20px;
            text-align: center;
        }

        /* Button Styles */
        .button {
            background-color: #007bff; /* Bootstrap primary color */
            border: none;
            color: white;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s ease-in-out;
        }

        .button:hover {
            background-color: #0056b3; /* Darker shade of primary color */
            transform: scale(1.1); /* Slight scaling effect on hover */
        }

        /* Animations */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes slideIn {
            0% { transform: translateY(-20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* Media Queries for smaller screens */
        @media (max-width: 767px) {
            h2 {
                font-size: 1.8rem;
            }
            .button {
                padding: 12px 25px;
            }
        }
    </style>

</head>
<body>

    <!-- Centered Container -->
    <div class="container-box">
        <div class="header">
       <h1> Welcome To The Hostel Complain Management System</h1>
            <h2>Are You a?</h2>
        </div>
        <table>
         
            <tr>
                <form>
                    <td>
                        <button class="button" type="submit" formaction="student/login.php">Student</button>
                    </td>
                    <td>
                        <button class="button" type="submit" formaction="admin/login2.php">Admin</button>
                    </td>
                </form>
            </tr>
        </table>
    </div>
    
</body>
</html>
