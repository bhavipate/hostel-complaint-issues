<?php 
session_start();

// Variable declaration
$staffname = "";
$email = "";
$errors = array(); 
$_SESSION['success'] = "";

// Connect to database using PDO
try {
    $db = new PDO('mysql:host=localhost;dbname=dbms;', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// REGISTER USER
if (isset($_POST['reg2_user'])) {
    // Receive all input values from the form
    $staffname = $_POST['staffname'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $reg_date = $_POST['reg_date'];
    $department = $_POST['department'];

    // Form validation: ensure that the form is correctly filled
    if (empty($staffname)) { array_push($errors, "Staff name is required"); }
    if (empty($phone_no)) { array_push($errors, "Phone No is required"); }
    if (empty($department)) { array_push($errors, "Department name is required"); }

    // Register user if there are no errors in the form
    if (count($errors) == 0) {
        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO staff (staffname, email, phone_no, reg_date, department) 
                  VALUES (:staffname, :email, :phone_no, :reg_date, :department)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':staffname', $staffname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_no', $phone_no);
        $stmt->bindParam(':reg_date', $reg_date);
        $stmt->bindParam(':department', $department);

        // Execute the query
        if ($stmt->execute()) {
            $_SESSION['success'] = "Staff registered successfully";
            header('location: admin_manage.php');
            exit();
        } else {
            array_push($errors, "Failed to register staff. Please try again.");
        }
    }
}
?>