<?php
namespace App\Models;

class Task {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getTasksByUser($userId) {
    $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
  }

  public function addTask($userId, $title, $description) {
    $stmt = $this->db->prepare("INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)");
    return $stmt->execute([$userId, $title, $description]);
  }

  public function updateTask($taskId, $title, $description, $status) {
    $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?");
    return $stmt->execute([$title, $description, $status, $taskId]);
  }

  public function deleteTask($taskId) {
    $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
    return $stmt->execute([$taskId]);
  }
}
?>
