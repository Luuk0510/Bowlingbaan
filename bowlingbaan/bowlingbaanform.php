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
  <title>Bowlingbaan <?=$crud?></title>
</head>

<body>
  <?php
  include_once "nav.html";
  
  if ($crud == "insert") {
  ?>
  <div class="row justify-content-center">
    <form style="width: 200px" action="bowlingbaancrud.php" method="post">
    <input type="hidden" name="crud" value="insert">
      <div class="text-center">
        <h1><?= $crud ?></h1>
      </div>
      <div class="form-floating">
        <input type="number" name="maxpersonen" class="form-control">
        <label for="floatingInput">Maximale personen</label>
      </div>
      <div class="form-floating">
        <input type="number" name="prijs" class="form-control">
        <label for="floatingPassword">Prijs</label>
      </div>
      <br>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
  </div>
  <?php
  } elseif ($crud == "update"){
    $id = $_REQUEST['id'];
    $maxPersonen = $_REQUEST['maxpersonen'];
    $prijs = $_REQUEST['prijs'];

  ?>
    <div class="row justify-content-center">
    <form style="width: 200px" action="bowlingbaancrud.php" method="post">
      <input type="hidden" name="crud" value="<?= $crud ?>">
      <input type="hidden" name="id" value="<?= $id ?>">
      <div class="text-center">
        <h1><?= $crud ?></h1>
      </div>
      <div class="form-floating">
        <input type="number" class="form-control" name="maxpersonen" value="<?= $maxPersonen ?>">
        <label for="floatingInput">Maximale personen</label>
      </div>
      <div class="form-floating">
        <input type="number" class="form-control" name="prijs" value="<?= $prijs ?>">
        <label for="floatingPassword">Prijs</label>
      </div>
      <br>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
  </div>
  <?php
  } else {
    header("Location: bowlingbaan.php");
    exit;
  }
  ?>
</body>

</html>