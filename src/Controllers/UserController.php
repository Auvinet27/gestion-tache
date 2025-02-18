<?php

namespace App\Controllers;

use App\Models\User;

class UserController {
  private $userModel;

  public function __construct($db) {
    $this->userModel = new user($db);
  }

  public function inscription($name, $email, $password){
    $this->userModel->inscription($name, $email, $password);
    header('Location: ../Views/connexion.php');
  }

  public function connexion($email, $password){
    $this->userModel->connexion($email, $password);
    header('Location: ');
  }

  public function logout() {
    session_destroy();
    header("Location: ../Views/connexion.php");
    exit();
  }
}
