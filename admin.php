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

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contacts WHERE id=$id");
}

$result = $conn->query("SELECT * FROM contacts");
?>
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
// Existing code for admin.php...


<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Admin Panel</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td><a href="?delete=<?php echo $row['id']; ?>">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
