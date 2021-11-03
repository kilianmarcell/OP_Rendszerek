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
     <title>Szerkesztés</title>
</head>
<body>
     <form method="POST">
          <input type="date" name="datum"><br>
          <input type="number" name="szam"><br>
          <input type="text" name="szoveg"><br>
          <input type="submit" value="Szerkesztés">
    </form>
    <a href="index.php"><button>Mégse</button></a>
</body>
</html>