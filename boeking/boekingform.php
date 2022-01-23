<?php
require "../connectie.php";
require "../functions.php";
$crud = $_REQUEST['crud'];
?>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" type="image/x-icon" href="../favicon/favicon.png">
  <title>Boeker <?= $crud ?></title>
</head>

<body>

  <?php
  include_once "nav.html";
  ?>
  <main>
    <?php
    if ($crud == "insert") {
    ?>
      <div class="container-sm">
        <div class="row justify-content-center">
          <div class="text-center">
            <h1>Boeking toevoegen</h1>
          </div>
          <form action="boekingcrud.php" method="post">
            <input type="hidden" name="crud" value="insert">
            <div class="row align-items-start">
              <div class="col">
                <div class="text-center">
                  <h2>Klant gegevens</h2>
                </div>
                <div class="form-floating">
                  <input type="text" name="naam" class="form-control" required>
                  <label for="floatingInput">Naam</label>
                </div>
                <div class="form-floating">
                  <input type="text" name="adres" class="form-control" required>
                  <label for="floatingPassword">Adres</label>
                </div>
                <div class="form-floating">
                  <input type="text" name="postcode" class="form-control" required>
                  <label for="floatingPassword">Postcode</label>
                </div>
                <div class="form-floating">
                  <input type="tel" name="telefoonnummer" class="form-control" required>
                  <label for="floatingPassword">Telefoon nummer</label>
                </div>
                <div class="form-floating">
                  <input type="email" name="email" class="form-control" required>
                  <label for="floatingPassword">Email</label>
                </div>
                <div class="form-floating">
                  <input type="number" min="1" name="aantalpersonen" class="form-control" required>
                  <label for="floatingPassword">Aantal personen</label>
                </div>
                <div class="form-floating">
                  <input type="datetime-local" name="tijdstip" class="form-control" required>
                  <label for="floatingPassword">Tijdstip</label>
                </div>
              </div>
              <div class="col">
                <div class="text-center">
                  <h2>Bowlingbaan</h2>
                </div>
                <select name="bowlingbaan" class="align-top form-select">
                  <option selected>Kies bowling baan</option>
                  <?php
                  $query = "SELECT * FROM `baan` ORDER BY `baan`.`max_personen` ASC";
                  $stmt = selectAll($pdo, $query);
                  while ($row = $stmt->fetch()) {
                    $id = $row['id'];
                    $maxpersonen = $row['max_personen'];
                    $prijs = $row['prijs'];
                  ?>
                    <option value="<?= $id ?>"><?= "Max personen: " . $maxpersonen . " Prijs &euro;" . $prijs ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col">
                <div class="text-center">
                  <h2>Schoenenmaat</h2>
                </div>
                <?php
                $query = "SELECT * FROM `schoenpaar` ORDER BY `schoenpaar`.`maat` ASC";
                $stmt = selectAll($pdo, $query);
                while ($row = $stmt->fetch()) {
                  $id = $row['id'];
                  $maat = $row['maat'];
                  $prijs = $row['prijs'];
                ?>
                  <div class="form-floating">
                    <input type="number" name="<?= $id ?>" class="form-control" value="0" required>
                    <label for="floatingPassword">Maat <?= $maat ?></label>
                  </div>
                <?php } ?>
              </div>
              <br>
            </div>
            <div class="row justify-content-center">
              <button style="width: 250px !important" class="w-100 btn btn-lg btn-primary" type="submit">Toevoegen</button>
            </div>
          </form>
        </div>
      <?php
    } elseif ($crud == "update") {
      $boeker_id = $_REQUEST['boeker_id'];
      $boeking_id = $_REQUEST['boeking_id'];

      $parameters = array(':boeker_id' => $boeker_id);
      $query = "SELECT
                  `boeker`.`naam`,
                  `boeker`.`adres`,
                  `boeker`.`postcode`,
                  `boeker`.`telefoonnummer`,
                  `boeker`.`email`,
                  `boeking`.`aantal_personen`,
                  `boeking`.`baan_id`,
                  `boeking`.`tijdstip`
                FROM
                    `boeker`
                INNER JOIN `boeking` ON `boeking`.`boeker_id` = `boeker`.`id`
                WHERE
                    `boeking`.`id` = :boeker_id";
      $stmt = select($pdo, $query, $parameters);
      while ($row = $stmt->fetch()) {
        $naam = $row['naam'];
        $adres = $row['adres'];
        $postcode = $row['postcode'];
        $telefoonnummer = $row['telefoonnummer'];
        $email = $row['email'];
        $tijdstip = $row['tijdstip'];
        $aantal_personen = $row['aantal_personen'];
        $baan_id = $row['baan_id'];

        $tijdstip = DateTime::createFromFormat('Y-m-d H:i:s', $row['tijdstip']);
        $tijdstipdate = $tijdstip->format('Y-m-d');
        $tijdstiptijd = $tijdstip->format('H:i');
        $tijdstip = $tijdstipdate . 'T' . $tijdstiptijd;
      }

      $parameters = array(':boeking_id' => $boeking_id);
      $query = "SELECT `id`, `baan_id` FROM `boeking` ORDER BY `id` DESC";
      ?>
        <div class="container-sm">
          <div class="row justify-content-center">
            <div class="text-center">
              <h1>Boeking toevoegen</h1>
            </div>
            <form action="boekingcrud.php" method="post">
              <input type="hidden" name="crud" value="insert">
              <div class="row align-items-start">
                <div class="col">
                  <div class="text-center">
                    <h2>Klant gegevens</h2>
                  </div>
                  <div class="form-floating">
                    <input type="text" name="naam" class="form-control" value="<?= $naam ?>" required>
                    <label for="floatingInput">Naam</label>
                  </div>
                  <div class="form-floating">
                    <input type="text" name="adres" class="form-control" value="<?= $adres ?>" required>
                    <label for="floatingPassword">Adres</label>
                  </div>
                  <div class="form-floating">
                    <input type="text" name="postcode" class="form-control" value="<?= $postcode ?>" required>
                    <label for="floatingPassword">Postcode</label>
                  </div>
                  <div class="form-floating">
                    <input type="tel" name="telefoonnummer" class="form-control" value="<?= $telefoonnummer ?>" required>
                    <label for="floatingPassword">Telefoon nummer</label>
                  </div>
                  <div class="form-floating">
                    <input type="email" name="email" class="form-control" value="<?= $email ?>" required>
                    <label for="floatingPassword">Email</label>
                  </div>
                  <div class="form-floating">
                    <input type="number" min="1" name="aantalpersonen" class="form-control" value="<?= $aantal_personen ?>" required>
                    <label for="floatingPassword">Aantal personen</label>
                  </div>
                  <div class="form-floating">
                    <input type="datetime-local" name="tijdstip" class="form-control" value="<?= $tijdstip ?>" required>
                    <label for="floatingPassword">Tijdstip</label>
                  </div>
                </div>
                <div class="col">
                  <div class="text-center">
                    <h2>Bowlingbaan</h2>
                  </div>
                  <select name="bowlingbaan" class="align-top form-select">
                    <option>Kies bowling baan</option>
                    <?php
                    $query = "SELECT * FROM `baan` ORDER BY `baan`.`max_personen` ASC";
                    $stmt = selectAll($pdo, $query);
                    while ($row = $stmt->fetch()) {
                      $id = $row['id'];
                      $maxpersonen = $row['max_personen'];
                      $prijs = $row['prijs'];
                      if ($baan_id == $id) {
                    ?>
                        <option selected value="<?= $id ?>">Max personen <?= $maxpersonen ?>Prijs &euro;<?= $prijs ?></option>
                      <?php } else { ?>
                        <option value="<?= $id ?>">Max personen <?= $maxpersonen ?>Prijs &euro;<?= $prijs ?></option>
                    <?php }
                    } ?>
                  </select>
                </div>
                <div class="col">
                  <div class="text-center">
                    <h2>Schoenenmaat</h2>
                  </div>
                  <?php
                  $query = "SELECT * FROM `schoenpaar` ORDER BY `schoenpaar`.`maat` ASC";
                  $stmt = selectAll($pdo, $query);
                  while ($row = $stmt->fetch()) {
                    $id = $row['id'];
                    $maat = $row['maat'];
                    $prijs = $row['prijs'];
                    
                    $parameters = array(':boeking_id' => $boeker_id);
                    $query = "SELECT `schoenpaar_id`, `aantal` FROM `bestelling` WHERE `boeking_id` = :boeking_id";
                    $stmt = select($pdo, $query, $parameters);
                    while ($row = $stmt->fetch()) {
                      $schoenpaar_id = $row['schoenpaar_id'];
                    ?>
                      <div class="form-floating">
                        <?php
                        if ($schoenpaar_id == $id) {
                          $aantal = $row['aantal'];
                        ?>
                          <input type="number" name="<?= $id ?>" class="form-control" value="<?= $aantal ?>" required>
                        <?php } else { ?>
                          <input type="number" name="<?= $id ?>" class="form-control" value="0" required>
                        <?php } ?>
                        <label for="floatingPassword">Maat <?= $maat ?></label>
                    <?php }
                  } ?>
                      </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <button style="width: 250px !important" class="w-100 btn btn-lg btn-primary" type="submit">Wijzig</button>
              </div>
          </div>
          </form>
        </div>
      <?php
    } else {
      header("Location: bowlingbaan.php");
      exit;
    }
      ?>
  </main>
</body>

</html>