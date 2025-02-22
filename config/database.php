<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'gestion_tache');
define('DB_USER', 'root');
define('DB_PASS', 'root');

try {
  $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}
