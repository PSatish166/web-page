<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form data
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$contact = $conn->real_escape_string($_POST['contact']);
$message = $conn->real_escape_string($_POST['message']);

// SQL query to insert data into the table
$sql = "INSERT INTO contacts (name, email, contact, message)
VALUES ('$name', '$email', '$contact', '$message')";

// Execute the query and check for success
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Your message has been sent successfully!'); window.location.href='form.html';</script>";
} else {
    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='form.html';</script>";
}

// Close connection
$conn->close();
?>
