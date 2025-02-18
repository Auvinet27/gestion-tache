<?php
global $db;
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';
require_once 'templates/header.php';

use App\Controllers\TaskController;

session_start();

$userId = $_SESSION['user_id'];
$taskController = new TaskController($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['title']) && !empty($_POST['description'])) {
  $taskController->ajouterTache($userId, $_POST['title'], $_POST['description']);
  header("Location: tasks.php");
  exit();
}

$taches = $taskController->afficherTaches($userId);
?>

<a href="deconnexion.php">Déconnexion</a>

<h2>Mes Tâches</h2>

<form action="" method="post">
  <label for="title">Titre :</label>
  <input type="text" name="title" placeholder="Titre" required>

  <label for="description">Description :</label>
  <textarea name="description" placeholder="Description" required></textarea>

  <button type="submit">Ajouter Tâche</button>
</form>

<ul>
  <?php foreach ($taches as $tache): ?>
    <li style="margin-bottom: 50px">
      <strong><?= htmlspecialchars($tache['title']); ?></strong>
      <p><?= htmlspecialchars($tache['description']); ?></p>
      <p><strong>Status :</strong> <?= htmlspecialchars($tache['status']); ?></p>
      <a href="edit_tasks.php?id=<?= $tache['id']; ?>">Modifier / Supprimer</a>
    </li>
  <?php endforeach; ?>
</ul>

<?php require_once 'templates/footer.php'; ?>
