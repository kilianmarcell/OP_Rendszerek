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
     <title>Operációs rendszerek</title>
</head>
<body>
     <div>
          <?php
               foreach ($lista as $i) {
                    echo $i -> getNev() . " " . $i -> getFelhasznalok() . " " . $i -> getDatum() -> format('Y-m-d') . " " . $i -> getLeiras() . "<br>";
               }
          ?>
     </div>
</body>
</html>