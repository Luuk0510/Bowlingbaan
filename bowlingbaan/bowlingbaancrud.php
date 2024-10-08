<?php
require "../connectie.php";
require "../functions.php";
$crud = $_REQUEST['crud'];

if ($crud == "insert") {
  $maxpersonen = $_REQUEST['maxpersonen'];
  $prijs = $_REQUEST['prijs'];
  $crud = $_REQUEST['crud'];

  $parameters = array(':id' => NULL,
                      ':max_personen' => $maxpersonen,
                      ':prijs' => $prijs);

  $query = "INSERT INTO `baan` (`id`, `max_personen`, `prijs`) VALUES (:id, :max_personen, :prijs)";
  insert($pdo, $query, $parameters);

  header("Location: bowlingbaan.php");
  exit;

} elseif ($crud == "update") {
  $id = $_REQUEST['id'];
  $maxpersonen = $_REQUEST['maxpersonen'];
  $prijs = $_REQUEST['prijs'];
  $crud = $_REQUEST['crud'];

  $parameters = array(':maxpersonen' => $maxpersonen,
                      ':prijs' => $prijs,
                      ':id' => $id);

  $query = "UPDATE `baan` SET `max_personen` = :maxpersonen, `prijs` = :prijs WHERE `baan`.`id` = :id";
  update($pdo, $query, $parameters);

  header("Location: bowlingbaan.php");
  exit;

} elseif ($crud == "delete") {
  $id = $_REQUEST['id'];
  $parameters = array(':id' => $id);
  $query = "DELETE FROM `baan` WHERE `baan`.`id` = :id";
  delete($pdo, $query, $parameters);

  header("Location: bowlingbaan.php");
  exit;
  
} else {
    header("Location: bowlingbaan.php");
    exit;
}
?>