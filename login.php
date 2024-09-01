<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: developer.php");
    exit;
}

// Gestion du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vous pouvez remplacer ces valeurs par des valeurs récupérées depuis une base de données
    $correct_username = 'admin';
    $correct_password = 'password123';

    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['logged_in'] = true;
        header("Location: developer.php");
        exit;
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Developer Interface</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Connexion</h2>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</body>
</html>
