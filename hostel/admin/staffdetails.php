<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;    
        }
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
    <a href="admin_studentdetail.php">Student Complaint Details</a>
    <a href="staffdetails.php">Staff Details</a> 
</div>

<div class="content">

<?php
session_start();

// Database connection using PDO
try {
    $conn = new PDO('mysql:host=localhost;dbname=dbms;', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Delete operation for staff
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $stmtDelete = $conn->prepare("DELETE FROM staff WHERE Staff_id = ?");
    if ($stmtDelete->execute([$id])) {
        echo "<script>alert('Staff member deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting staff member');</script>";
    }
}

// Fetch staff members
$query = "SELECT * FROM staff";
$stmt = $conn->prepare($query);
$stmt->execute();

echo '
<div class="ts-main-content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Staff Members Table</h2>
            <div class="panel panel-default">
              <div class="panel-heading">Staff Members</div>
              <div class="panel-body">
                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th> <!-- Added ID column -->
                          <th>Staff Name</th>
                          <th>Email</th>
                          <th>Phone No</th>
                          <th>Registration Date</th>
                          <th>Department</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row['Staff_id'] . '</td>'; 
    echo '<td>' . $row['staffname'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['phone_no'] . '</td>';
    echo '<td>' . $row['reg_date'] . '</td>';
    echo '<td>' . $row['department'] . '</td>';
    echo "<td><a href='staffdetails.php?del=".$row['Staff_id']."' onClick=\"javascript:return confirm('Are you sure you want to delete this?');\">Remove</a></td>";
    echo '</tr>';
}

echo '
                  </tbody>
                </table>';

?>

<p><a href="a.php?logout='1'" style="color: red;">Logout</a></p>

</body>
</html>