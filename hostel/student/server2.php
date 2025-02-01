<?php 
session_start();

$Student_Id = "";
$roomno = "";
$errors = array(); 
$_SESSION['success'] = "";

try {
    $db1 = new PDO('mysql:host=localhost;dbname=dbms;', 'root', '');
    $db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// REGISTER USER
if (isset($_POST['sub_user'])) {
    // Receive all input values from the form
    $complaint_date = $_POST['complaint_date'];
    $Student_Id = $_POST['Student_Id'];
    $phoneno = $_POST['phoneno'];
    $roomno = $_POST['roomno'];
    $complaint_type = $_POST['complaint_type'];
    $description = $_POST['description'];

    // Form validation: ensure that the form is correctly filled
    if (empty($Student_Id)) { array_push($errors, "Student ID is required"); }
    if (empty($complaint_type)) { array_push($errors, "Complaint type is required"); }
    if (empty($roomno)) { array_push($errors, "Room number is required"); }
    if (empty($complaint_date)) { array_push($errors, "Date is required"); }

    // Check if Student ID exists in registration table
    if (count($errors) == 0) {
        $checkStudentQuery = "SELECT * FROM registration WHERE Student_Id = :student_id";
        $checkStmt = $db1->prepare($checkStudentQuery);
        $checkStmt->bindParam(':student_id', $Student_Id);
        $checkStmt->execute();

        if ($checkStmt->rowCount() == 0) {
            array_push($errors, "No registered student found with this ID.");
        }
    }

    // Register complaint if there are no errors in the form
    if (count($errors) == 0) {
        $query1 = "INSERT INTO complaints (complaint_date, Student_Id, phoneno, roomno, complaint_type, description) 
                   VALUES (:complaint_date, :student_id, :phoneno, :roomno, :complaint_type, :description)";
        $stmt = $db1->prepare($query1);
        
        $stmt->bindParam(':complaint_date', $complaint_date);
        $stmt->bindParam(':student_id', $Student_Id);
        $stmt->bindParam(':phoneno', $phoneno);
        $stmt->bindParam(':roomno', $roomno);
        $stmt->bindParam(':complaint_type', $complaint_type);
        $stmt->bindParam(':description', $description);

        // Execute the query
        if ($stmt->execute()) {
            $_SESSION['success'] = "Your complaint is registered";
            header('location: complainsuccess.php');
            exit(); 
        } else {
            array_push($errors, "Failed to register complaint. Please try again.");
        }
    }
}
?>