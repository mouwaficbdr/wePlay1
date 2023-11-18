<?php
include_once 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Inclure le fichier de configuration de la base de données
  include_once 'config.php';

  // Récupérer les données du formulaire
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $remember = isset($_POST['remember']) ? 1 : 0;

  // Requête SQL pour vérifier les informations de connexion
  $query = "SELECT id, username, password, role FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $user = mysqli_fetch_assoc($result);
    if ($user && password_verify($password, $user['password'])) {
      // Enregistrement des informations de l'utilisateur dans la session
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];

      // Redirection vers une page après la connexion réussie (par exemple, la page d'accueil)
      header("Location: ../HTML/index.html");
      exit();
    } else {
      // Redirection avec un message d'erreur si les informations de connexion sont incorrectes
      header("Location: ../HTML/connexion.html?error=invalid");
      exit();
    }
  } else {
    // Redirection avec un message d'erreur en cas d'erreur de requête
    header("Location: ../HTML/connexion.html?error=database");
    exit();
  }
} else {
  // Redirection si la page est accédée directement sans soumettre le formulaire
  header("Location: ../HTML/inscription.html");
  exit();
}
