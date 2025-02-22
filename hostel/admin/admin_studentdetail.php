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
  <a href="staffdetails.php">Staff Details</a> 
  <a href="admin_studentdetail.php">Student Complaint Details</a>
  
</div>

<div class="content">

<?php
if(isset($_GET['del']))
{
  $id=intval($_GET['del']);
  $adn="delete from complaints where Student_Id=?";
    $stmt= $mysqli->prepare($adn);
    $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();    
        echo "<script>alert('Data Deleted');</script>" ;
}
?>

<?php
$conn = mysqli_connect("localhost", "root", "", "dbms");
$query = "
    SELECT aa.Student_Id AS Student_Id, aa.roomno, aa.phoneno, aa.complaint_date , aa.complaint_type, aa.description, bb.staffname
    FROM complaints AS aa 
    INNER JOIN staff AS bb
    ON aa.complaint_type = bb.department ";
$result = mysqli_query($conn, $query) or die( mysqli_error($conn));

echo '
<div class="ts-main-content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Student Complaints Table</h2>
            <div class="panel panel-default">
              <div class="panel-heading">Student Complaints</div>
              <div class="panel-body">
                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Student Id</th>
                          <th>Room No</th>
                          <th>Phone No</th>
                          <th>Complaint Date</th>
                          <th>Complaint Type</th>
                          <th>Description</th>
                          <th>Staff Name</th>
                          <th>Action</th>
                          </tr>
                  </thead>
                  
                  <tbody>';
                


while($row = mysqli_fetch_array($result)) {
  echo '<td>'.$row['Student_Id'].'</td>';
    echo '<td>'.$row['roomno'].'</td>';
    echo '<td>'.$row['phoneno'].'</td>';
    echo '<td>'.$row['complaint_date'].'</td>';
    echo '<td>'.$row['complaint_type'].'</td>';
    echo '<td>'.$row['description'].'</td>';
    echo '<td>'.$row['staffname'].'</td>';
    echo "<td><a href='delete.php?id=".$row['Student_Id']."' onClick=\"javascript:return confirm('are you sure you want to delete this?');\">Remove</a></td><tr>";
   
  
}
echo '
        </tbody>
    </table>';
?>
</div>
<p> <a href="a.php?logout='1'" style="color: red;">Logout</a> </p>

</body>
</html>