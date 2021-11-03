<?php

require_once "db.php";
require_once "oprendszer.php";

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
     <div class="m-5">
          <?php
               foreach ($lista as $i) {
                    echo '<div class="h3 mb-5">';
                    echo 'Operációs rendszer neve: ' . $i -> getNev() . '<br>';
                    echo 'Felhasználók száma: ' . $i -> getFelhasznalok() . '<br>';
                    echo 'Első verzió megjelenése: ' . $i -> getDatum() -> format('Y-m-d') . '<br>';
                    echo 'Leírás: ' . $i -> getLeiras() . '<br>';
                    echo '</div>';
               }
          ?>
     </div>
</body>
</html>