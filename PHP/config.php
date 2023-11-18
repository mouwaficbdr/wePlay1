<?php
// Afficher les erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "weplay";

// Créer une connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $database);

// Vérifier la connexion
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
