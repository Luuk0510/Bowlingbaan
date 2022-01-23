<?php
require "../connectie.php";
require "../functions.php";
$crud = $_REQUEST['crud'];

if ($crud == "insert") {
  $naam = $_REQUEST['naam'];
  $adres = $_REQUEST['adres'];
  $postcode = $_REQUEST['postcode'];
  $telefoonnummer = $_REQUEST['telefoonnummer'];
  $email = $_REQUEST['email'];

  $parameters = array(':naam' => $naam,
                      ':adres' => $adres,
                      ':postcode' => $postcode,
                      ':telefoonnummer' => $telefoonnummer,
                      ':email' => $email);

  $query = "INSERT INTO `boeker` (`id`, `naam`, `adres`, `postcode`, `telefoonnummer`, `email`) VALUES (NULL, :naam, :adres, :postcode, :telefoonnummer, :email)";
  insert($pdo, $query, $parameters);

  header("Location: boeker.php");
  exit;

} elseif ($crud == "update") {
  $id = $_REQUEST['id'];
  $naam = $_REQUEST['naam'];
  $adres = $_REQUEST['adres'];
  $postcode = $_REQUEST['postcode'];
  $telefoonnummer = $_REQUEST['telefoonnummer'];
  $email = $_REQUEST['email'];

  $parameters = array(':naam' => $naam,
                      ':adres' => $adres,
                      ':postcode' => $postcode,
                      ':telefoonnummer' => $telefoonnummer,
                      ':email' => $email,
                      ':id' => $id);

  $query = "UPDATE `boeker` SET `naam` = :naam, `adres` = :adres, `postcode` = :postcode, `telefoonnummer` = :telefoonnummer, `email` = :email WHERE `boeker`.`id` = :id";
  update($pdo, $query, $parameters);

  header("Location: boeker.php");
  exit;

} elseif ($crud == "delete") {
  $id = $_REQUEST['id'];
  $parameters = array(':id' => $id);
  $query = "DELETE FROM `boeker` WHERE `boeker`.`id` = :id";
  delete($pdo, $query, $parameters);

  header("Location: boeker.php");
  exit;
  
} else {
    header("Location: boeker.php");
    exit;
}
?>