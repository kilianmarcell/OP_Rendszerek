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
          $ujSzazalek = $_POST['szazalek'] ?? '';
     
          if ($ujNev !== '' && $ujFelhasznalok !== '' && $ujLeiras !== '' && $ujSzazalek !== '') {

              $ujOprendszer = new oprendszer($ujNev, (int)$ujFelhasznalok, new DateTime($ujDatum), $ujLeiras, $ujSzazalek);
          
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

     <form method="POST" class="m-5 h2">

          <div class="container">
               <div class="row">
                    <div class="col-sm-5">
                         Név:
                    </div>
                    <div class="col-sm-7">
                         <input type="text" name="nev"><br>
                    </div>
               </div>
               <div class="row">
                    <div class="col-sm-5">
                         Felhasználók száma:
                    </div>
                    <div class="col-sm-7">
                         <input type="number" name="felhasznalok"><br>
                    </div>
               </div>
               <div class="row">
                    <div class="col-sm-5">
                         Első verzió megjelenése:
                    </div>
                    <div class="col-sm-7">
                         <input type="date" name="datum"><br>
                    </div>
               </div>
               <div class="row">
                    <div class="col-sm-5">
                         Leírás:
                    </div>
                    <div class="col-sm-7">
                         <input type="text" name="leiras"><br>
                    </div>
               </div>
               <div class="row">
                    <div class="col-sm-5">
                         Emberek hány százaléke használja:
                    </div>
                    <div class="col-sm-7">
                         <input type="number" name="szazalek"><br>
                    </div>
               </div>

               <input class=" btn btn-primary btn-lg mt-5" type="submit" value="Hozzáadás">

          </div>

    </form>

     <div class="m-5">

          <?php

               foreach ($lista as $i) {

                    echo '<div class="container h3 mb-5">';

                         echo '<div class="row mb-2">';
                              echo '<div class="col-5">';
                                   echo 'Operációs rendszer neve: ';
                              echo '</div>';

                              echo '<div class="col-7">';
                                   echo $i -> getNev() . '<br>';
                              echo '</div>';
                         echo '</div>';

                         echo '<div class="row mb-2">';
                              echo '<div class="col-5">';
                                   echo 'Felhasználók száma: ';
                              echo '</div>';

                              echo '<div class="col-7">';
                                   echo $i -> getFelhasznalok() . '<br>';;
                              echo '</div>';
                         echo '</div>';

                    
                         echo '<div class="row mb-2">';
                              echo '<div class="col-5">';
                                   echo 'Első verzió megjelenése: ';
                              echo '</div>';

                              echo '<div class="col-7">';
                                   echo $i -> getDatum() -> format('Y-m-d') . '<br>';
                              echo '</div>';
                         echo '</div>';

                         echo '<div class="row mb-2">';
                              echo '<div class="col-5">';
                                   echo 'Leírás: ';
                              echo '</div>';

                              echo '<div class="col-7">';
                                   echo $i -> getLeiras() . '<br>';
                              echo '</div>';
                         echo '</div>';

                         echo '<div class="row mb-3">';
                              echo '<div class="col-5">';
                                   echo 'Emberek hány százaléke használja: ';
                              echo '</div>';

                              echo '<div class="col-7">';
                                   echo $i -> getSzazalek() . '%<br>';
                              echo '</div>';
                         echo '</div>';

                         echo '<div class="row col-5 mb-5">';
                              echo '<div class="col-5">';
                                   echo '<form method="POST"><button class="btn btn-danger btn-lg" name="torles" value="' . $i -> getId() . '">Törlés</button></form>';
                              echo '</div>';

                              echo '<div class="col-7">';
                                   echo '<a href="szerkesztes.php?id=' . $i -> getId() . '"><button class="btn btn-secondary btn-lg">Szerkesztés</button></a>';
                              echo '</div>';
                         echo '</div>';
                    echo '</div>';

               }
               
          ?>

     </div>

</body>
</html>