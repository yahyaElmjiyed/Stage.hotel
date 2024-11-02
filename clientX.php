<?php
// Vérifier si le formulaire a été soumis
if (isset($_POST['name'])) {
    $nom_complet = $_POST['name']; // Récupération du nom depuis le formulaire
} else {
    $nom_complet = "Client"; // Si le nom n'est pas défini, afficher 'Client' par défaut
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de feedback</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles to resemble the original */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, black, grey, darkblue);
            margin: 0;
            padding: 0;
            color: white;
        }

        h1 {
            color: white;
        }

        form {
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            font-size: 24px;
            color: rgba(255, 255, 255, 0.882);
            font-weight: bold;
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0.445);
            padding: 10px 20px;
            display: inline-block;
            border-radius: 10px;
            margin: 20px auto;
        }

        a:hover {
            color: lightslategray;
        }

        button {
            background-color: #5623e2;
            color: white;
            font-weight: bold;
            font-style: italic;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-check-label {
            color: black;
        }

        label {
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-5">Bonjour <?php echo htmlspecialchars($nom_complet); ?>  </h1>
        <div class="text-center">
            <a href="index.html" class="btn btn-light mb-4">Retour à l'accueil</a>
        </div>

        <form action="client.php" method="post" class="p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="name" class="form-label">Nom complet :</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom complet" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="xxxxxxxxxx@gmail.com" required>
            </div>

            <div class="mb-3">
                <label for="type-voyageur" class="form-label">Type de voyageur :</label>
                <select id="type-voyageur" name="type-voyageur" class="form-select" required>
                    <option value="couple">Couple</option>
                    <option value="famille">Famille</option>
                    <option value="individuelle">Individuelle</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="mois-annee" class="form-label">Mois et annee du voyage :</label>
                <input type="date" class="form-control" id="mois-annee" name="mois-annee" required>
            </div>

            <!-- Hebergement Rating -->
            <div class="mb-3">
                <label class="form-label">Hebergement :</label>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hebergement" id="hebergement-0" value="0" required>
                        <label class="form-check-label" for="hebergement-0">0</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hebergement" id="hebergement-1" value="1">
                        <label class="form-check-label" for="hebergement-1">1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hebergement" id="hebergement-2" value="2">
                        <label class="form-check-label" for="hebergement-2">2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hebergement" id="hebergement-3" value="3">
                        <label class="form-check-label" for="hebergement-3">3</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hebergement" id="hebergement-4" value="4">
                        <label class="form-check-label" for="hebergement-4">4</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="hebergement" id="hebergement-5" value="5">
                        <label class="form-check-label" for="hebergement-5">5</label>
                    </div>
                </div>
            </div>

            <!-- Satisfaction WiFi -->
            <div class="mb-3">
                <label class="form-label">Satisfaction WiFi :</label>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="wifi" id="wifi-0" value="0" required>
                        <label class="form-check-label" for="wifi-0">0</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="wifi" id="wifi-1" value="1">
                        <label class="form-check-label" for="wifi-1">1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="wifi" id="wifi-2" value="2">
                        <label class="form-check-label" for="wifi-2">2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="wifi" id="wifi-3" value="3">
                        <label class="form-check-label" for="wifi-3">3</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="wifi" id="wifi-4" value="4">
                        <label class="form-check-label" for="wifi-4">4</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="wifi" id="wifi-5" value="5">
                        <label class="form-check-label" for="wifi-5">5</label>
                    </div>
                </div>
            </div>

            <!-- Satisfaction Check-in/Check-out -->
            <div class="mb-3">
                <label class="form-label">Satisfaction Check-in/Check-out :</label>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="checkin" id="checkin-0" value="0" required>
                        <label class="form-check-label" for="checkin-0">0</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="checkin" id="checkin-1" value="1">
                        <label class="form-check-label" for="checkin-1">1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="checkin" id="checkin-2" value="2">
                        <label class="form-check-label" for="checkin-2">2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="checkin" id="checkin-3" value="3">
                        <label class="form-check-label" for="checkin-3">3</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="checkin" id="checkin-4" value="4">
                        <label class="form-check-label" for="checkin-4">4</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="checkin" id="checkin-5" value="5">
                        <label class="form-check-label" for="checkin-5">5</label>
                    </div>
                </div>
            </div>

            <!-- Satisfaction Service -->
            <div class="mb-3">
                <label class="form-label">Satisfaction Service :</label>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="service" id="service-0" value="0" required>
                        <label class="form-check-label" for="service-0">0</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="service" id="service-1" value="1">
                        <label class="form-check-label" for="service-1">1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="service" id="service-2" value="2">
                        <label class="form-check-label" for="service-2">2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="service" id="service-3" value="3">
                        <label class="form-check-label" for="service-3">3</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="service" id="service-4" value="4">
                        <label class="form-check-label" for="service-4">4</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="service" id="service-5" value="5">
                        <label class="form-check-label" for="service-5">5</label>
                    </div>
                </div>
            </div>

            <!-- Satisfaction Petit Déjeuner -->
            <div class="mb-3">
                <label class="form-label">Satisfaction Petit Déjeuner :</label>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="petit-dejeuner" id="petit-dejeuner-0" value="0" required>
                        <label class="form-check-label" for="petit-dejeuner-0">0</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="petit-dejeuner" id="petit-dejeuner-1" value="1">
                        <label class="form-check-label" for="petit-dejeuner-1">1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="petit-dejeuner" id="petit-dejeuner-2" value="2">
                        <label class="form-check-label" for="petit-dejeuner-2">2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="petit-dejeuner" id="petit-dejeuner-3" value="3">
                        <label class="form-check-label" for="petit-dejeuner-3">3</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="petit-dejeuner" id="petit-dejeuner-4" value="4">
                        <label class="form-check-label" for="petit-dejeuner-4">4</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="petit-dejeuner" id="petit-dejeuner-5" value="5">
                        <label class="form-check-label" for="petit-dejeuner-5">5</label>
                    </div>
                </div>
            </div>

            <!-- Satisfaction Bar -->
            <div class="mb-3">
                <label class="form-label">Le Bar :</label>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bar" id="bar-0" value="0" required>
                        <label class="form-check-label" for="bar-0">0</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bar" id="bar-1" value="1">
                        <label class="form-check-label" for="bar-1">1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bar" id="bar-2" value="2">
                        <label class="form-check-label" for="bar-2">2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bar" id="bar-3" value="3">
                        <label class="form-check-label" for="bar-3">3</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bar" id="bar-4" value="4">
                        <label class="form-check-label" for="bar-4">4</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bar" id="bar-5" value="5">
                        <label class="form-check-label" for="bar-5">5</label>
                    </div>
                </div>
            </div>

            <!-- Gender Selection -->
            <div class="mb-3">
                <label class="form-label">Identité de genre :</label>
                <div class="d-flex">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                        <label class="form-check-label" for="male">H</label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                        <label class="form-check-label" for="female">F</label>
                    </div>
                </div>
            </div>

            <!-- Country and First-time Section -->
            <div class="mb-3">
                <label for="country" class="form-label">Votre pays :</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Ex: France" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Première fois à l'hôtel ?</label>
                <div class="d-flex">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="first-time" id="first-time-yes" value="yes" required>
                        <label class="form-check-label" for="first-time-yes">Oui</label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="first-time" id="first-time-no" value="no">
                        <label class="form-check-label" for="first-time-no">Non</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="avis" class="form-label">Avis général :</label>
                <textarea class="form-control" id="avis" name="avis" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Envoyer</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
