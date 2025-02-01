<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        /* General page styling */
body {
    font-family: Arial, sans-serif;
    background-color: #e8eaf6; /* Light purple background */
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container styling */
.container {
    max-width: 600px;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    text-align: center;
    animation: fadeIn 1s ease-in-out;
}

/* Paragraph styling */
.container p {
    color: #333;
    font-size: 18px;
    margin-bottom: 20px;
}

/* Button styling */
button {
    background-color: #7e57c2; /* Medium purple for buttons */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin: 10px 5px; /* Small spacing between buttons */
    transition: background-color 0.3s ease, transform 0.2s ease;
}

/* Button hover effect */
button:hover {
    background-color: #6a47b1; /* Slightly darker purple on hover */
    transform: scale(1.05); /* Slightly larger on hover */
}

/* Fade-in animation for the container */
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
   
    <div class="container">
        <p>Thank you for reaching out to us. We appreciate your feedback and will address your complaint shortly.</p>

        <button onclick="window.location.href='login.php'">Logout</button>
        <button onclick="window.location.href='student_manage.php'">Back To HomePage</button>
    </div>
</body>
</html>