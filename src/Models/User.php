<?php

namespace App\Models;

class User {
  private $db;
  public function __construct($db) {
    if (!$db) {
      throw new \Exception("Erreur : Connexion à la base de données non fournie !");
    }
    $this->db = $db;
  }

  public function inscription($name, $email, $password) {
    try {
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
      $stmt->bindParam(":name", $name);
      $stmt->bindParam(":email", $email);
      $stmt->bindParam(":password", $passwordHash);

      if ($stmt->execute()) {
        return true;
      } else {
        $errorInfo = $stmt->errorInfo();
        return "Erreur SQL : " . $errorInfo[2];
      }
    } catch (\PDOException $e) {
      return "Erreur PDO : " . $e->getMessage();
    }
  }

  public function connexion($email, $password){
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }
    return false;
  }
}
