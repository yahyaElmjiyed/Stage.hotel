<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avis";
$port = 3307;


$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Verifier la connexion
if (!$conn) {
    echo("Échec de la connexion : " . mysqli_connect_error());}
?>