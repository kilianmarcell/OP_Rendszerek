<?php

class oprendszer {
     private $id;
     private $nev;
     private $felhasznalok;
     private $datum;
     private $leiras;

     public function __construct(string $nev, int $felhasznalok, DateTime $datum, string $leiras) {
          $this -> nev = $nev;
          $this -> felhasznalok = $felhasznalok;
          $this -> datum = $datum;
          $this -> leiras = $leiras;
     }

     public function getId() : int {
          return $this -> id;
     }

     public function getNev() : string {
          return $this -> nev;
     }

     public function setNev(string $nev) : void {
          $this -> nev = $nev;
     }

     public function getFelhasznalok() : int {
          return $this -> felhasznalok;
     }

     public function setFelhasznalok(int $felhasznalok) : void {
          $this -> felhasznalok = $felhasznalok;
     }

     public function getDatum() : DateTime {
          return $this -> datum;
     }

     public function setDatum(DateTime $datum) : void {
          $this -> datum = $datum;
     }

     public function getLeiras() : string {
          return $this -> leiras;
     }

     public function setLeiras(string $leiras) : void {
          $this -> leiras = $leiras;
     }

     public static function beolvas() : array {
          global $db;

          $lekerdez = $db -> query('SELECT * FROM op_systems') -> fetchAll();

          $list = [];

          foreach ($lekerdez as $i) {
               $ujOprendszer = new oprendszer($i['nev'],
                                   $i['felhasznalok_szama'],
                                   new DateTime($i['letrehozas_datuma']),
                                   $i['leiras']);
               $ujOprendszer -> id = $i['id'];

               $list[] = $ujOprendszer;
          }

          return $list;
     }

     public function hozzaad() {
          global $db;

          $db -> prepare('INSERT INTO op_systems(nev, felhasznalok_szama, letrehozas_datuma, leiras)
                         VALUES (:nev, :felhasznalok_szama, :letrehozas_datuma, :leiras)')
          -> execute([':nev' => $this -> nev,
                    ':felhasznalok_szama' => $this -> felhasznalok,
                    ':letrehozas_datuma' => $this -> datum -> format('Y-m-d'),
                    ':leiras' => $this -> leiras]);
     }

     public static function torles(int $id) {
          global $db;

          $db -> prepare('DELETE FROM op_systems WHERE id LIKE :id')
          
          -> execute([':id' => $id]);
     }

     public static function getById(int $id) : oprendszer {
          global $db;
  
          $s = $db -> prepare('SELECT * FROM op_systems WHERE id = :id');

          $s -> execute([':id' => $id]);

          $e = $s -> fetchAll();
  
          if (count($e) !== 1) {
              throw new Exception("A lekérdezés több sort ad vissza!");
          }
  
          $oprendszer = new oprendszer(
               $e[0]['nev'],
               $e[0]['felhasznalok_szama'],
               new DateTime($e[0]['letrehozas_datuma']),
               $e[0]['leiras']
          );

          $oprendszer -> id = $e[0]['id'];

          return $oprendszer;
      }

     //public static function szerkeszt(int $id) : oprendszer {
     //     global $db;
//
     //     $s = $db -> prepare('UPDATE op_systems SET nev = :nev, felhasznalok_szama = :felhasznalok_szama,
     //                    letrehozas_datuma = :letrehozas_datuma, leiras = :leiras WHERE id = :id')
//
     //     $s = -> execute([
     //                    ':nev' => $this -> nev,
     //                    ':felhasznalok_szama' => $this -> felhasznalok,
     //                    ':letrehozas_datuma' => $this -> datum -> format('Y-m-d'),
     //                    ':leiras' => $this -> leiras,
     //                    ':id' => $id
     //     ]);
//
     //     $e = $s -> fetchAll();
//
     //     if (count($e) !== 1) {
     //          throw new Exception("A lekérdezés több sort ad vissza!");
     //     }
//
     //     $oprendszer = new oprendszer(
     //          $e[0]['nev'],
     //          $e[0]['felhasznalok_szama'],
     //          new DateTime($e[0]['letrehozas_datuma']),
     //          $e[0]['leiras'],
     //          $e[0]['id']
     //     );
//
     //     return $oprendszer;
     //}

     public function szerkeszt() {
          global $db;

          $db -> prepare('UPDATE op_systems SET nev = :nev, felhasznalok_szama = :felhasznalok_szama,
          letrehozas_datuma = :letrehozas_datuma, leiras = :leiras WHERE id = :id')
                         -> execute([
                              ':nev' => $this -> nev,
                              ':felhasznalok_szama' => $this -> felhasznalok,
                              ':letrehozas_datuma' => $this -> datum -> format('Y-m-d'),
                              ':leiras' => $this -> leiras,
                              ':id' => $this -> id
                         ]);
     }
}