<?php global $db;
require_once 'templates/header.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';

use App\Models\User;

if (!isset($db)) {
  die("Erreur : La connexion à la base de données n'est pas disponible.");
}

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  if ($user->inscription($name, $email, $password)) {
    echo "Inscription réussie. <a href='connexion.php'>Connectez-vous ici</a>.";
  } else {
    echo "Erreur lors de l'inscription.";
  }
}

?>



<h2>Inscription</h2>
<form action="" method="post">
  <label for="name">Nom :</label>
  <input type="text" name="name" placeholder="Nom" required>
  <label for="email">Email :</label>
  <input type="text" name="email" placeholder="Email" required>
  <label for="passsword">Password :</label>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <button type="submit">Inscription</button>
</form>

<?php require_once 'templates/footer.php'; ?>
