<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* General styling */
body {
  margin: 0;
  font-family: "Lato", sans-serif;
  background-color: #f3e5f5; /* Light purple background */
}

/* Sidebar styling */
.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #b39ddb; /* Light purple color for sidebar */
  position: fixed;
  height: 100%;
  overflow: auto;
  transition: width 0.3s ease;
}

/* Sidebar links styling */
.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s ease, color 0.3s ease;
}

/* Active link and hover effects */
.sidebar a.active {
  background-color: #7e57c2; /* Deep purple for active link */
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #9575cd; /* Slightly darker purple on hover */
  color: white;
}

/* Content styling */
.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 100vh;
  animation: fadeIn 0.8s ease;
}

/* Responsive styling for screens under 700px */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {
    float: left;
  }
  .content {
    margin-left: 0;
  }
}

/* Responsive styling for screens under 400px */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

/* Animation for sidebar and content */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

</style>
</head>
<body>

<div class="sidebar">
  <a class="active" href="#home">Home</a>
  <a href="update.php">Update Details</a>
  <a href="main.php">Complaint Registration</a>
  <a href="login.php">Logout</a>
</div>


  <br><br><br>
  <center>
  <h2>Welcome to the Hostel Complaint Management Page</h2>
  </center>




</body>
</html>