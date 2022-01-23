<?php
require "../connectie.php";
require "../functions.php";
$crud = $_REQUEST['crud'];

if ($crud == "insert") {
  $maat = $_REQUEST['maat'];
  $prijs = $_REQUEST['prijs'];

  $parameters = array(':id' => NULL,
                      ':maat' => $maat,
                      ':prijs' => $prijs);

  $query = "INSERT INTO `schoenpaar` (`id`, `maat`, `prijs`) VALUES (:id, :maat, :prijs);";
  insert($pdo, $query, $parameters);

  header("Location: schoenpaar.php");
  exit;

} elseif ($crud == "update") {
  $id = $_REQUEST['id'];
  $maat = $_REQUEST['maat'];
  $prijs = $_REQUEST['prijs'];

  $parameters = array(':maat' => $maat,
                      ':prijs' => $prijs,
                      ':id' => $id);

  $query = "UPDATE `schoenpaar` SET `maat` = :maat, `prijs` = :prijs WHERE `schoenpaar`.`id` = :id";
  update($pdo, $query, $parameters);

  header("Location: schoenpaar.php");
  exit;

} elseif ($crud == "delete") {
  $id = $_REQUEST['id'];

  $parameters = array(':id' => $id);
  $query = "DELETE FROM `schoenpaar` WHERE `schoenpaar`.`id` = :id";
  delete($pdo, $query, $parameters);

  header("Location: schoenpaar.php");
  exit;
  
} else {
    header("Location: schoenpaar.php");
    exit;
}
?>