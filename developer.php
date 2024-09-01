<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "guarder_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Supprimer un utilisateur
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_sql = "DELETE FROM contacts WHERE id='$id'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Utilisateur supprimé avec succès');</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression');</script>";
    }
}

// Récupérer les données de la table contacts
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);

?>

<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Le reste du code de la page `developer.php` suit...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Développeur - Gestion des Contacts</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Gestion des Contacts</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Numéro de Téléphone</th>
                        <th>Message</th>
                        <th>Date de Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone_number']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun contact trouvé.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
</body>
</html>
