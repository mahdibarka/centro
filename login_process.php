<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Replace with your own credentials
$correct_username = "admin";
$correct_password = "password";

if ($username === $correct_username && $password === $correct_password) {
    $_SESSION['logged_in'] = true;
    header('Location: admin.php');
} else {
    echo "Invalid credentials";
}
?>
