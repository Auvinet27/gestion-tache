<?php
namespace App\Controllers;

use App\Models\Task;

class TaskController {
  private $task;

  public function __construct($db) {
    $this->task = new Task($db);
  }

  public function afficherTaches($userId) {
    return $this->task->getTasksByUser($userId);
  }

  public function ajouterTache($userId, $title, $description) {
    return $this->task->addTask($userId, $title, $description);
  }

  public function modifierTache($taskId, $title, $description, $status) {
    return $this->task->updateTask($taskId, $title, $description, $status);
  }

  public function supprimerTache($taskId) {
    return $this->task->deleteTask($taskId);
  }
}
