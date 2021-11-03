<?php

require_once "db.php";
require_once "oprendszer.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $torlesId = $_POST['torles'] ?? '';
     if ($torlesId === '') {
          $ujNev = $_POST['nev'] ?? '';
          $ujFelhasznalok = $_POST['felhasznalok'] ?? '';
          $ujDatum = $_POST['datum'] ?? '';
          $ujLeiras = $_POST['leiras'] ?? '';
     
          if ($ujNev !== '' && $ujFelhasznalok !== '' && $ujLeiras !== '') {
              $ujOprendszer = new oprendszer($ujNev, (int)$ujFelhasznalok, new DateTime($ujDatum), $ujLeiras);
          
              $ujOprendszer -> hozzaad();
          }
     } else {
          oprendszer::torles($torlesId);
     }
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
     
     <title>Operációs rendszerek</title>
</head>
<body>
     <form method="POST" class="m-5 h3">
          <input type="text" name="nev"><br>
          <input type="number" name="felhasznalok"><br>
          <input type="date" name="datum"><br>
          <input type="text" name="leiras"><br>
          <input class="mt-5" type="submit" value="Hozzáadás">
    </form>
     <div class="m-5">
          <?php
               foreach ($lista as $i) {
                    echo '<div class="h3 mb-5">';
                    echo 'Operációs rendszer neve: ' . $i -> getNev() . '<br>';
                    echo 'Felhasználók száma: ' . $i -> getFelhasznalok() . '<br>';
                    echo 'Első verzió megjelenése: ' . $i -> getDatum() -> format('Y-m-d') . '<br>';
                    echo 'Leírás: ' . $i -> getLeiras() . '<br>';
                    echo '<form method="POST"><button name="torles" value="' . $i -> getId() . '">Törlés</button></form>';
                    echo '<a href="szerkesztes.php?id="' . $i -> getId() . '"><button>Szerkesztés</button></a>';
                    echo '</div>';
               }
          ?>
     </div>
</body>
</html>