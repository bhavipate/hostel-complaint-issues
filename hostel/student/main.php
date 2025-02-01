<?php include('server2.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
    /* General page styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f3e5f5; /* Light purple background */
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* Header styling */
.header {
    background-color: #7e57c2; /* Deep purple for header */
    color: white;
    padding: 15px;
    text-align: center;
    border-radius: 10px 10px 0 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: slideInDown 1s ease-out;
}

/* Form container styling */
form {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    max-width: 600px;
    width: 100%;
    margin: 20px auto;
    animation: fadeInUp 1s ease-out;
}

/* Input group styling */
.input-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #5e35b1; /* Darker purple for labels */
}

/* Input, select, and textarea styling */
input[type="text"],
input[type="date"],
select,
textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #d1c4e9;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 16px;
    color: #333;
}

textarea {
    resize: vertical;
}

/* Button styling */
button.btn {
    background-color: #7e57c2;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

button.btn:hover {
    background-color: #6a1b9a;
    transform: scale(1.05);
}

/* Logout link styling */
p {
    text-align: center;
}

p a {
    color: #d32f2f;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

p a:hover {
    color: #b71c1c;
}

/* Error message styling */
.error {
    color: #d32f2f;
    font-size: 14px;
    margin-bottom: 15px;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


    </style>
</head>
<body>


    <form method="post" action="main.php">
        <?php include('errors.php'); ?>
    <center>
    <h2>Student Complaints Page</h2>
    </center>
        <label for="complaint_date">Date of Complaint:</label>
        <input type="date" id="complaint_date" name="complaint_date">

        <div class="input-group">
            <label>Student Id</label>
            <input type="text" name="Student_Id" value="<?php echo $Student_Id; ?>">
        </div>
        
        <div class="input-group">
            <label>Phone No.</label>
            <input type="text" name="phoneno">
        </div>

        <div class="input-group">
            <label>Room No.</label>
            <input type="text" name="roomno">
        </div>

        <div class="input-group">
            <label for="complaint_type">Complaint Type</label>
            <select id="complaint_type" name="complaint_type">
                <option value="Electricity issue">Electricity issue</option>
                <option value="Carpentry issue">Carpentry issue</option>
                <option value="Leakage issue">Leakage issue</option>
                <option value="Cleaning/housekeeping issue">Cleaning/housekeeping issue</option>
                <option value="Mess food issue">Mess food issue</option>
                <option value="Other issue">Other issue</option>
            </select>
        </div>

        <div class="input-group">
            <label for="description">Problem Description</label>
            <textarea id="description" name="description" placeholder="Write something.." rows="5" cols="43"></textarea>
        </div>

        <div class="input-group">
            <button type="submit" class="btn" name="sub_user">Submit</button>
        </div>

        <p><a href="a.php?logout='1'" style="color: red;">Logout</a></p>    
    </form>                    
</body>
</html>