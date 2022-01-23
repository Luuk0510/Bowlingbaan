<?php
  require "../connectie.php";
  require "../functions.php";
?>
<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" type="image/x-icon" href="../favicon/favicon.png">
  <title>Bowlingbaan</title>
</head>

<body>
  <?php include_once "nav.html" ?>
  <main>
    <h1 class="display-1 d-flex justify-content-center">Boeking</h1>
    <div class="d-flex justify-content-center">
      <a class="btn btn-primary" href="boekingform.php?crud=insert">Nieuwe Boeking toevoegen</a>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <table style="max-width: 1500px" class="table table-primary table-hover text-center align-middle">
          <tr>
            <th class="bg-primary">Boeker</th>
            <th class="bg-primary">Baan Nummer</th>
            <th class="bg-primary">Aantal Personen</th>
            <th class="bg-primary">Tijdstip</th>
            <th class="bg-primary">Schoenen</th>
            <th class="bg-primary">Totaal</th>
            <th class="bg-primary">Updaten</th>
            <th class="bg-primary">Verwijder</th>
          </tr>
          <?php
          $query = 'SELECT
	                      `boeker`.`id` AS boeker_id,
                        `boeker`.`naam`,
                        `baan`.`id` AS baan_id,
                        `baan`.`prijs` AS baan_prijs,
                        `boeking`.`id` AS boeking_id,
                        `boeking`.`aantal_personen`,
                        `boeking`.`tijdstip`
                    FROM
                        `boeking`
                    INNER JOIN `boeker` ON `boeker`.`id` = `boeking`.`boeker_id`
                    INNER JOIN `baan` ON `baan`.`id` = `boeking`.`baan_id`
                    ORDER BY `boeking`.`tijdstip` DESC';
          
          $stmt = selectAll($pdo, $query);
          while ($row = $stmt->fetch()) {
            $boeking_id = $row['boeking_id'];
            $boeker_id = $row['boeker_id'];
            $naam = $row['naam'];
            $baan_id = $row['baan_id'];
            $baan_prijs = $row['baan_prijs'];
            $aantal_personen = $row['aantal_personen'];
            $myDateTime = DateTime::createFromFormat("Y-m-d H:i:s", $row['tijdstip']);
            $tijdstip = $myDateTime->format('d-m-Y H:i');
          ?>
            <tr>
              <td><?= $naam ?></td>
              <td><?= $baan_id ?></td>
              <td><?= $aantal_personen ?> personen</td>
              <td><?= $tijdstip ?></td>
              <td><p>
                <?php
                $prijsschoen = 0;
                  $parameters = array(':boeking_id' => $boeking_id);
                  $query = "SELECT
                                `schoenpaar`.`maat`,
                                `schoenpaar`.`prijs`,
                                SUM(
                                    `schoenpaar`.`prijs` * `bestelling`.`aantal`
                                ) AS schoenprijs,
                                `bestelling`.`aantal`
                            FROM
                                `bestelling`
                            INNER JOIN `schoenpaar` ON `schoenpaar`.`id` = `bestelling`.`schoenpaar_id`
                            WHERE `bestelling`.`boeking_id` = :boeking_id
                            GROUP BY maat";
                  $stmt2 = select($pdo, $query, $parameters);
                  while ($row = $stmt2->fetch()) {
                    $maat = $row['maat'];
                    $prijs = $row['schoenprijs'];
                    $aantal = $row['aantal'];
                    $prijsschoen = $prijsschoen + $prijs;
                  ?>
                  Maat: <?=$maat?> Aantal: <?=$aantal?> Prijs &euro;<?=$prijs?> <br>
              <?php } 
              $totaalprijs = $prijsschoen + $baan_prijs;
              ?>
              </p>
              </td>
              <td>&euro;<?=$totaalprijs?></td>
              <td><a class="btn btn-primary" href="boekingform.php?boeker_id=<?= $boeker_id ?>&boeking_id=<?= $boeking_id ?>&crud=update">Update</a></td>
              <td><a class="btn btn-primary" href="boekingcrud.php?id=<?= $boeking_id ?>&crud=delete">Verwijderen</a></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </main>

</body>

</html>