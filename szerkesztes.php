<?php

require_once "db.php";
require_once "oprendszer.php";

$oprendszerId = $_GET['id'] ?? null;

if ($oprendszerId === null) {
     header('Location: index.php');
     exit();
}

$opSys = oprendszer::getById($oprendszerId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $ujNev = $_POST['nev'] ?? null;
     $ujFelhasznalok = $_POST['felhasznalok'] ?? 0;
     $ujDatum = $_POST['datum'] ?? null;
     $ujLeiras = $_POST['leiras'] ?? null;

     $opSys -> setNev($ujNev);
     $opSys -> setFelhasznalok($ujFelhasznalok);
     $opSys -> setDatum(new DateTime($ujDatum));
     $opSys -> setLeiras($ujLeiras);

     $opSys -> szerkeszt();
}

$lista = oprendszer::beolvas();

?><!DOCTYPE html>
<html lang="hu">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     
     <title>Szerkesztés</title>
</head>
<body>
     <div class="m-5 h3">
          <form method="POST">
               <input type="text" name="nev" value="<?php echo $opSys -> getNev() ?>"><br>
               <input type="number" name="felhasznalok" value="<?php echo $opSys -> getFelhasznalok() ?>"><br>
               <input type="date" name="datum" value="<?php echo $opSys -> getDatum() -> format('Y-m-d') ?>"><br>
               <input type="text" name="leiras" value="<?php echo $opSys -> getLeiras() ?>"><br>
               <input class="mt-5" type="submit" value="Szerkesztés">
          </form>
          <a class="h3" href="index.php"><button>Mégse</button></a>
     </div>
</body>
</html>