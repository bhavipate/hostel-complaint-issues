<?php 
session_start(); // Start session at the beginning of your script

// Check if there's a success message and display it
if (isset($_SESSION['success'])) {
    echo '<div style="color: green; text-align: center; margin-bottom: 20px;">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']); // Clear the message after displaying it
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #4CAF50;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>
</head>
<body>

<div class="sidebar">
  <a class="active" href="#home">Home</a>
  <a href="register2.php">Staff Registration</a>
  <a href="staffdetails.php">Staff Details</a>
  <a href="admin_studentdetail.php">Student Complaint Details</a>
  <a href="login2.php">Logout</a>
</div>

<div class="content">
  <h2>Welcome To Staff and Complaint Management Page</h2>
 
</div>
<p> <a href="a.php?logout='1'" style="color: red;">logout</a> </p>
</body>
</html>












