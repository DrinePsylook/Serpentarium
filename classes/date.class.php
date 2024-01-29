<?php

class Date {

    private $date;
    private $jour;
    private $mois;
    private $annee;

    public function __construct(){
        $this->date;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate(){
       $this->date;
    }

    public function afficheDateFr($date_a_changer){
    $date = date_parse($date_a_changer);
                $jour = $date['day'];
                $mois = $date['month'];
                $annee = $date['year'];
                $heures = $date['hour'];
                $minutes = $date['minute'];
                if($mois == 1){
                    $moisfr = "janvier";
                } else if($mois == 2){
                    $moisfr = "février";
                } else if($mois == 3){
                    $moisfr = "mars";
                } else if($mois == 4){
                    $moisfr = "avril";
                } else if($mois == 5){
                    $moisfr = "mai";
                } else if($mois == 6){
                    $moisfr = "juin";
                } else if($mois == 7){
                    $moisfr = "juillet";
                } else if($mois == 8){
                    $moisfr = "août";
                } else if($mois == 9){
                    $moisfr = "septembre";
                } else if($mois == 10){
                    $moisfr = "octobre";
                } else if($mois == 11){
                    $moisfr = "novembre";
                } else if($mois == 12){
                    $moisfr = "décembre";
                } else {
                    $moisfr = " ";
                }
                if($minutes >= 0 && $minutes <=9){
                    $newDate = $jour. " ".$moisfr. " ".$annee. " à ".$heures. "h0".$minutes;
                }else {
                    $newDate = $jour. " ".$moisfr. " ".$annee. " à ".$heures. "h".$minutes;
                }
             return $newDate;
        }

}