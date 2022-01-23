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
  $aantalpersonen = $_REQUEST['aantalpersonen'];
  $tijdstip = $_REQUEST['tijdstip'];

  $baan_id = $_REQUEST['bowlingbaan'];

  $parameters = array(':naam' => $naam,
                      ':adres' => $adres,
                      ':postcode' => $postcode,
                      ':telefoonnummer' => $telefoonnummer,
                      ':email' => $email);

  $query = "INSERT INTO `boeker` (`id`, `naam`, `adres`, `postcode`, `telefoonnummer`, `email`) VALUES (NULL, :naam, :adres, :postcode, :telefoonnummer, :email)";
  insert($pdo, $query, $parameters);

  $query = "SELECT `id` FROM `boeker` ORDER BY `boeker`.`id` DESC LIMIT 1";
  $stmt = selectAll($pdo, $query);
  while ($row = $stmt->fetch()) {
    $boeker_id = $row['id'];
  }
  
  $parameters = array(':id' => NULL,
                      ':boeker_id' => $boeker_id,
                      ':baan_id' => $baan_id,
                      ':aantal_personen' => $aantalpersonen,
                      ':tijdstip' => $tijdstip);
  $query = "INSERT INTO `boeking` (`id`, `boeker_id`, `baan_id`, `aantal_personen`, `tijdstip`) VALUES (:id, :boeker_id, :baan_id, :aantal_personen, :tijdstip)";
  insert($pdo, $query, $parameters);

  $query = "SELECT `id` FROM `boeking` ORDER BY `boeking`.`id` DESC LIMIT 1";
  $stmt = selectAll($pdo, $query);
  while ($row = $stmt->fetch()) {
    $boeking_id = $row['id'];
  }

  $query = "SELECT `id` FROM `schoenpaar` ORDER BY `schoenpaar`.`maat` DESC";
  $stmt = selectAll($pdo, $query);
  while ($row = $stmt->fetch()) {
    $schoenpaar_id = $row['id'];
    $aantal = $_REQUEST[$schoenpaar_id];
    if($aantal != 0){
      $parameters = array(':boeking_id' => $boeking_id,
                          ':schoenpaar_id' => $schoenpaar_id,
                          ':aantal' => $aantal);
      //INSERT INTO `bestelling` (`boeking_id`, `schoenpaar_id`, `aantal`) VALUES ('3', '4', '1')
      $query = "INSERT INTO `bestelling` (`boeking_id`, `schoenpaar_id`, `aantal`) VALUES (:boeking_id, :schoenpaar_id, :aantal)";
      insert($pdo, $query, $parameters);
    } else {
      continue;
    }
  }
  header("Location: boeking.php");
  exit;

} elseif ($crud == "update") {
  $naam = $_REQUEST['naam'];
  $adres = $_REQUEST['adres'];
  $postcode = $_REQUEST['postcode'];
  $telefoonnummer = $_REQUEST['telefoonnummer'];
  $email = $_REQUEST['email'];
  $aantalpersonen = $_REQUEST['aantalpersonen'];
  $tijdstip = $_REQUEST['tijdstip'];
  $baan_id = $_REQUEST['bowlingbaan'];
  
  $parameters = array(':naam' => $naam,
                      ':adres' => $adres,
                      ':postcode' => $postcode,
                      ':telefoonnummer' => $telefoonnummer,
                      ':email' => $email,
                      ':id' => $id);

  $query = "UPDATE `boeker` SET `naam` = :naam, `adres` = :adres, `postcode` = :postcode, `telefoonnummer` = :telefoonnummer, `email` = :email WHERE `boeker`.`id` = :id";
  update($pdo, $query, $parameters);

  header("Location: boeking.php");
  exit;

} elseif ($crud == "delete") {
  $id = $_REQUEST['id'];
  
  $parameters = array(':boeker_id' => $id);
  $query = "DELETE FROM `bestelling` WHERE `bestelling`.`boeking_id` = :boeker_id";
  delete($pdo, $query, $parameters);

  $query = "DELETE FROM `boeking` WHERE `boeking`.`id` = :boeker_id";
  delete($pdo, $query, $parameters);

  header("Location: boeking.php");
  exit;
  
} else {
    header("Location: boeking.php");
    exit;
}
?>