<?php
global $db;
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';
require_once 'templates/header.php';

use App\Models\User;

session_start();

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $utilisateur = $user->connexion($email, $password);

  if ($utilisateur) {
    $_SESSION['user_id'] = $utilisateur['id'];
    $_SESSION['user_name'] = $utilisateur['name'];

    header("Location: tasks.php");
    exit();
  } else {
    $erreur = "Email ou mot de passe incorrect.";
  }
}
?>

  <h2>Connexion</h2>

  <form action="" method="post">
    <label for="email">Email :</label>
    <input type="email" name="email" placeholder="Email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" placeholder="Mot de passe" required>

    <button type="submit">Connexion</button>
  </form>

  <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>

<?php require_once 'templates/footer.php'; ?>
