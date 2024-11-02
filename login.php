<?php
// Vérifie si une session n'est pas déjà démarrée avant de démarrer une nouvelle session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'condb.php'; // Inclusion du fichier de connexion à la base de données

// Logique du traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Hash the submitted password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Vérification des identifiants
    $stmt = $conn->prepare("SELECT id, nom, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Utilisateur trouvé
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Mot de passe correct, démarrer la session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nom'] = $row['nom'];

            // Redirection vers une page protégée ou la page d'accueil
            header("Location: index.html");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Mot de passe incorrect. Veuillez réessayer.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Aucun compte trouvé avec cet email.</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers Bootstrap pour la mise en forme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin-top: 50px;
        }

        /* Style du logo */
        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
        }

        .all-image {
            display: block;
            margin: 20px auto;
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Ajout du logo avec lien vers le site d'Accor -->
    <div class="logo">
        <a href="https://group.accor.com/fr" target="_blank">
            <img src="logo-accord.png" alt="Logo Accor">
        </a>
    </div>

    <h2 class="text-center mb-4">Connexion</h2>
    
    <!-- Formulaire de connexion -->
    <form method="post" action="" class="form-group">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
    </form>

    <!-- Lien pour s'inscrire s'il n'a pas encore de compte -->
    <div class="text-center mt-3">
        <p>Vous n'avez pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
    </div>

    <!-- Image "all.jpg" ajoutée en bas -->
    <img src="all.jpg" alt="ALL Image" class="all-image">
</div>

<!-- Lien vers le CDN JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
