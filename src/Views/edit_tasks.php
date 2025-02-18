<?php
global $db;
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';
require_once 'templates/header.php';

use App\Controllers\TaskController;

session_start();

$taskController = new TaskController($db);
$userId = $_SESSION['user_id'];

$taskId = $_GET['id'];
$tacheActuelle = null;

$taches = $taskController->afficherTaches($userId);
foreach ($taches as $t) {
  if ($t['id'] == $taskId) {
    $tacheActuelle = $t;
    break;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['title'], $_POST['description'], $_POST['status'])) {
    $taskController->modifierTache($taskId, $_POST['title'], $_POST['description'], $_POST['status']);
    header("Location: tasks.php");
    exit();
  }

  if (isset($_POST['delete'])) {
    $taskController->supprimerTache($taskId);
    header("Location: tasks.php");
    exit();
  }
}
?>

  <h2>Modifier la Tâche</h2>

  <form action="" method="post">
    <label for="title">Titre :</label>
    <input type="text" name="title" value="<?= htmlspecialchars($tacheActuelle['title']); ?>" required>

    <label for="description">Description :</label>
    <textarea name="description" required><?= htmlspecialchars($tacheActuelle['description']); ?></textarea>

    <label for="status">Statut :</label>
    <select name="status">
      <option value="À faire" <?= $tacheActuelle['status'] == "À faire" ? "selected" : ""; ?>>À faire</option>
      <option value="En cours" <?= $tacheActuelle['status'] == "En cours" ? "selected" : ""; ?>>En cours</option>
      <option value="Terminé" <?= $tacheActuelle['status'] == "Terminé" ? "selected" : ""; ?>>Terminé</option>
    </select>

    <button type="submit">Enregistrer les modifications</button>
  </form>

  <form action="" method="post">
    <button type="submit" name="delete">Supprimer la Tâche</button>
  </form>

  <a href="tasks.php">Retour aux tâches</a>

<?php require_once 'templates/footer.php'; ?>
