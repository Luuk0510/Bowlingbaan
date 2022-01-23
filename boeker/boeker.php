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
  <title>Boeker</title>
</head>

<body>
  <?php include_once "nav.html" ?>
  <main>
    <h1 class="display-1 d-flex justify-content-center">Boeker</h1>
    <div class="container">
      <div class="row justify-content-center">
        <table style="max-width: 1000px" class="table table-primary table-hover text-center align-middle">
          <tr>
            <th>Naam</th>
            <th>Adres</th>
            <th>Postcode</th>
            <th>Telefoon Nummer</th>
            <th>Email</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = 'SELECT * FROM `boeker` ORDER BY `id` ASC';
          $stmt = selectAll($pdo, $query);
          while ($row = $stmt->fetch()) {
            $id = $row['id'];
            $naam = $row['naam'];
            $adres = $row['adres'];
            $postcode = $row['postcode'];
            $telefoonnummer = $row['telefoonnummer'];
            $email = $row['email'];
          ?>
            <tr>
              <td><?= $naam ?></td>
              <td><?= $adres ?></td>
              <td><?= $postcode ?></td>
              <td><?= $telefoonnummer ?></td>
              <td><?= $email ?></td>
              <td><a class="btn btn-primary" href="boekerform.php?id=<?=$id?>&naam=<?=$naam?>&adres=<?=$adres?>&adres=<?=$adres?>&postcode=<?=$postcode?>&telefoonnummer=<?=$telefoonnummer?>&email=<?=$email?>&crud=update">Update</a></td>
              <td><a class="btn btn-primary" href="boekercrud.php?id=<?=$id?>&crud=delete">Verwijderen</a></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </main>
</body>

</html>