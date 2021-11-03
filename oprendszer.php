<?php

class OpRendszerek {
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
}