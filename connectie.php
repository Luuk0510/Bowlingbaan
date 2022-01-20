<?php

try {
  $pdo = new PDO("mysql:host=localhost;dbname=bowlingbaan", 'root', '');
} catch (PDOException $e) {
  echo $e->getMessage();
}

?>