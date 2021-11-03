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
     $ujSzazalek = $_POST['szazalek'] ?? 0;

     $opSys -> setNev($ujNev);
     $opSys -> setFelhasznalok($ujFelhasznalok);
     $opSys -> setDatum(new DateTime($ujDatum));
     $opSys -> setLeiras($ujLeiras);
     $opSys -> setSzazalek($ujSzazalek);

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
     <form method="POST" class="m-5 h2">

          <div class="container">

               <div class="row">
                    <div class="col-sm-5">
                         Név:
                    </div>
                    <div class="col-sm-7">
                         <input type="text" name="nev" value="<?php echo $opSys -> getNev() ?>"><br>
                    </div>
               </div>

               <div class="row">
                    <div class="col-sm-5">
                         Felhasználók száma:
                    </div>
                    <div class="col-sm-7">
                         <input type="number" name="felhasznalok" value="<?php echo $opSys -> getFelhasznalok() ?>"><br>
                    </div>
               </div>

               <div class="row">
                    <div class="col-sm-5">
                         Első verzió megjelenése:
                    </div>
                    <div class="col-sm-7">
                         <input type="date" name="datum" value="<?php echo $opSys -> getDatum() -> format('Y-m-d') ?>"><br>
                    </div>
               </div>

               <div class="row">
                    <div class="col-sm-5">
                         Leírás:
                    </div>
                    <div class="col-sm-7">
                         <input type="text" name="leiras" value="<?php echo $opSys -> getLeiras() ?>"><br>
                    </div>
               </div>

               <div class="row">
                    <div class="col-sm-5">
                         Emberek hány százaléke használja:
                    </div>
                    <div class="col-sm-7">
                         <input type="number" name="szazalek" value="<?php echo $opSys -> getSzazalek() ?>"><br>
                    </div>
               </div>
          </div>

          <div class="container">
               <div class="row col-5">
                    <input class="mt-5 btn btn-secondary btn-lg" type="submit" value="Szerkesztés">
               </div>
          </div>
    </form>

          <div class="container">
               <div class="row col-5">
                    <a href="index.php"><button class="col-12 btn btn-danger btn-lg">Mégse</button></a>
               </div>
          </div>

     </div>

</body>
</html>