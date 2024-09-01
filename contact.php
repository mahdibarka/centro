<?php
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "centro_assistenza_italiani";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$message = $_POST['message'];

$sql = "INSERT INTO contacts (full_name, email, phone_number, message) VALUES ('$full_name', '$email', '$phone_number', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
