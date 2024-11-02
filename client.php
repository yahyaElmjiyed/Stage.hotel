<?php
// Utilisation de PHPMailer pour l'envoi d'email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Connexion à la base de données
include("condb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom_complet = $_POST['name'];
    $client_email = $_POST['email'];
    $type_voyageur = $_POST['type-voyageur'];
    $mois_annee = $_POST['mois-annee'];
    $hebergement = (int)$_POST['hebergement'];
    $wifi = (int)$_POST['wifi'];
    $checkin = (int)$_POST['checkin'];
    $service = (int)$_POST['service'];
    $petit_dejeuner = (int)$_POST['petit_dejeuner'];
    $bar = (int)$_POST['bar'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $first_time = $_POST['first-time'];
    $avis = $_POST['avis'];
    

    // Préparer la requête SQL
    $sql = $conn->prepare("INSERT INTO feedback1 (nom_complet, client_email, type_voyageur, mois_annee, hebergement, wifi, checkin, service, petit_dejeuner, bar, gender, country, first_time, avis)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($sql) {
        // Lier les paramètres
        $sql->bind_param("ssssiissssssss", $nom_complet, $client_email, $type_voyageur, $mois_annee, $hebergement, $wifi, $checkin, $service, $petit_dejeuner, $bar, $gender, $country, $first_time, $avis);

        // Exécuter la requête
        if ($sql->execute()) {
            // Envoyer l'email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'yahyaelmjiyed2020@gmail.com';
                $mail->Password = 'ofln hiwg gzhu nffm'; // Utilise une méthode sécurisée pour gérer les mots de passe
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('yahyaelmjiyed2020@gmail.com', 'Feedback System');
                $mail->addAddress('sofitelweb@gmail.com');

                $mail->isHTML(true);
                $mail->Subject = 'Nouveau Feedback sur le site';
                $mail->Body = "Un nouveau commentaire a été ajouté :<br><br>" .
                    "Nom complet: $nom_complet<br>" .
                    "Email: $client_email<br>" .
                    "Type de voyageur: $type_voyageur<br>" .
                    "Mois/Année: $mois_annee<br>" .
                    "Hébergement: $hebergement<br>" .
                    "WiFi: $wifi<br>" .
                    "Check-in: $checkin<br>" .
                    "Service: $service<br>" .
                    "Petit-déjeuner: $petit_dejeuner<br>" .
                    "Bar: $bar<br>" .
                    "Genre: $gender<br>" .
                    "Pays: $country<br>" .
                    "Première fois: $first_time<br>" .
                    "Avis: $avis<br>";

                $mail->send();
                header("Location: merci.php");
                exit(); // pour éviter une exécution supplémentaire après la redirection
            } catch (Exception $e) {
                echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
            }
        } else {
            echo "Erreur lors de l'exécution de la requête : " . $sql->error;
        }
        $sql->close();
    } else {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }
    $conn->close();
}
?>
