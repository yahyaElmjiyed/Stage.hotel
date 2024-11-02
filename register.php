<?php
// Vérifie si une session n'est pas déjà démarrée avant de démarrer une nouvelle session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'condb.php'; // Inclusion du fichier de connexion à la base de données

// Logique du traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérification si les deux mots de passe correspondent
    if ($password != $confirm_password) {
        echo "<div class='alert alert-danger'>Les mots de passe ne correspondent pas.</div>";
    } else {
        // Hachage du mot de passe pour plus de sécurité
        $password_hache = password_hash($password, PASSWORD_DEFAULT);

        // Vérification si l'email existe déjà dans la base de données
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Cet email est déjà enregistré. Veuillez vous connecter.</div>";
        } else {
            // Insérer le nouvel utilisateur dans la base de données
            $stmt = $conn->prepare("INSERT INTO users (nom, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nom, $email, $password_hache);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Inscription réussie ! Vous pouvez maintenant vous connecter.</div>";
                // Redirection vers la page de connexion après l'inscription
                header("Location: login.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Erreur lors de l'inscription. Veuillez réessayer.</div>";
            }

            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Lien vers Bootstrap pour la mise en forme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Variables CSS pour la personnalisation du thème */
        :root {
            --primary-color: #4CAF50; /* Couleur principale */
            --secondary-color: #2C3E50; /* Couleur secondaire */
            --background-color: #ecf0f1; /* Couleur de fond */
            --button-hover-color: #45a049; /* Couleur du bouton au survol */
            --border-radius: 8px; /* Rayon des bordures arrondies */
        }

        /* Ajout de l'image en arrière-plan avec overlay */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
        }

        /* L'élément parent contient à la fois l'image et l'overlay */
        .background-container {
            position: relative;
            height: 100vh;
            background-image: url('all.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Overlay semi-transparent par-dessus l'image de fond */
        .background-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Couche semi-transparente noire */
        }

        /* Style de la boîte de formulaire */
        .container {
            position: relative; /* Position relative pour être au-dessus de l'overlay */
            background: rgba(255, 255, 255, 0.9); /* Opacité plus forte pour meilleure lisibilité */
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            margin: 50px auto;
            z-index: 1; /* Assure que le formulaire est bien au-dessus de l'overlay */
        }

        h2 {
            color: var(--secondary-color);
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: var(--secondary-color);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            background-color: var(--background-color);
            border: 1px solid var(--secondary-color);
            border-radius: var(--border-radius);
            padding: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        /* Effet focus sur les champs de formulaire */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
            outline: none;
        }

        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: bold;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: var(--button-hover-color);
        }

        /* Style du lien de connexion */
        .text-center a {
            color: var(--primary-color);
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .text-center a:hover {
            color: var(--button-hover-color);
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }

            button[type="submit"] {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="background-container">
    <div class="container">
        <h2>Inscription</h2>
        <!-- Formulaire d'inscription -->
        <form method="post" action="" class="form-group">
            <div class="form-group">
                <label for="nom">Nom complet</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez votre nom complet" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le mot de passe</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirmez votre mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
        </form>

        <!-- Lien pour se connecter s'il a déjà un compte -->
        <div class="text-center mt-3">
            <p>Êtes-vous déjà membre ? <a href="login.php">Cliquez ici pour vous connecter</a></p>
        </div>
    </div>
</div>

<!-- Lien vers le CDN JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
