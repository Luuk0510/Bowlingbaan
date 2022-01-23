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
      <div class="row justify-content-center">
        <form style="width: 350px" action="boekercrud.php" method="post">
          <input type="hidden" name="crud" value="insert">
          <div class="text-center">
            <h1>Klant toevoegen</h1>
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
          <br>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Toevoegen</button>
        </form>
      </div>
    <?php
    } elseif ($crud == "update") {
      $id = $_REQUEST['id'];
      $naam = $_REQUEST['naam'];
      $adres = $_REQUEST['adres'];
      $postcode = $_REQUEST['postcode'];
      $telefoonnummer = $_REQUEST['telefoonnummer'];
      $email = $_REQUEST['email'];
    ?>
      <div class="row justify-content-center">
        <form style="width: 350px" action="boekercrud.php" method="post">
          <input type="hidden" name="crud" value="update">
          <input type="hidden" name="id" value="<?= $id ?>">
          <div class="text-center">
            <h1>Klant toevoegen</h1>
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
          <br>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Toevoegen</button>
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