<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Inclure le fichier de configuration de la base de données
  include_once 'config.php';

  // Récupérer les données du formulaire
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  // Requête SQL pour insérer un nouvel utilisateur
  $query = "INSERT INTO users (username, password, email) VALUES ('$name', '$prenom', '$email')";

  if (mysqli_query($conn, $query)) {
    // Redirection vers une page après l'inscription réussie (par exemple, la page de connexion)
    header("Location: ../HTML/connexion.html");
    exit();
  } else {
    // Redirection avec un message d'erreur en cas d'échec de l'inscription
    header("Location: ../HTML/inscription.html?error=database");
    exit();
  }
} else {
  // Redirection si la page est accédée directement sans soumettre le formulaire
  header("Location: ../HTML/inscription.html");
  exit();
}
