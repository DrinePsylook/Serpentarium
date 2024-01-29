<?php

    class Serpent {
        
        private $tblSerps = "Serpents";
	    private $id = "";
    

        public function __construct($myid = "vide"){ //ajouter un serpent
            if($myid != "vide" && $myid != 'new') $this->id = $myid;
            if($myid == "new") {
                $conn = new Bdd();
                $this->id = $conn->create($this->tblSerps);
            }
        }

/*----------------------------------------------------------------------------------------------
Getters et setters
----------------------------------------------------------------------------------------------*/
    
public function get($col) {
    $conn = new Bdd();
    return $conn->select($this->tblSerps, $this->id, $col);
}

public function set($col, $value) {
    $conn = new Bdd();
    return $conn->misajour($this->tblSerps, $this->id, $col, $value);
}

public function delete() { //efface les rows null
    $conn = new Bdd();
    return $conn->execReq("DELETE 
                            FROM Serpents 
                            WHERE dateNaissance IS NULL AND genreMale IS NULL AND id_race IS NULL;");
}

public function createNewSnake($values){
    $conn = new Bdd();
    return $conn->execReq("INSERT INTO Serpents (nomSerpent, poids, dateNaissance, dateMort, genreMale, id_pere, id_mere, id_race) VALUES ($values);");
}

/*----------------------------------------------------------------------------------------------
Select des serpents vivants + filtres
----------------------------------------------------------------------------------------------*/
        
        //selection de tous les serpents
        public function selectAll(){ 
            $conn = new Bdd();
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races ORDER BY nomSerpent;");
        }

        //sélection de tous les serpents vivants
        public function selectAllAlive($premier, $parPage){ 
            $conn = new Bdd();
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races WHERE dateNaissance <= NOW() AND (dateMort > NOW()
            OR dateMort IS NULL) ORDER BY nomSerpent LIMIT $premier,$parPage;"); 
        }

        //filtres genre && race
        public function filterSnakeAlive($category1, $category2){
            $conn = new Bdd(); 
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races WHERE dateNaissance <= NOW() AND (dateMort > NOW()
            OR dateMort IS NULL) AND genreMale = $category1 AND id_race = $category2 ORDER BY nomSerpent"); 
        }

        //filtre genre
        public function filterGenderSnakeAlive($category1){
            $conn = new Bdd(); 
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races WHERE dateNaissance <= NOW() AND (dateMort > NOW()
            OR dateMort IS NULL) AND genreMale = $category1 ORDER BY nomSerpent;"); 
        }

        //filtre race
        public function filterRaceSnakeAlive($category2){
            $conn = new Bdd(); 
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races WHERE dateNaissance <= NOW() AND (dateMort > NOW()
            OR dateMort IS NULL) AND id_race = $category2 ORDER BY nomSerpent;"); 
        }

/*----------------------------------------------------------------------------------------------
Select des serpents morts + filtres
----------------------------------------------------------------------------------------------*/

        //sélection de tous les serpents morts
        public function selectAllDead($premier, $parPage){ 
            $conn = new Bdd();
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races WHERE dateMort <= NOW() ORDER BY nomSerpent LIMIT $premier,$parPage;"); 
        }

        //filtres genre && race
        public function filterSnakeDead($category1, $category2){
            $conn = new Bdd(); 
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races WHERE dateMort <= NOW() AND genreMale = $category1 AND id_race = $category2 ORDER BY nomSerpent;"); 
        }

         //filtre genre
         public function filterGenderSnakeDead($category1){
            $conn = new Bdd(); 
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races WHERE dateMort <= NOW() AND genreMale = $category1 ORDER BY nomSerpent;"); 
        }

        //filtre race
        public function filterRaceSnakeDead($category2){
            $conn = new Bdd(); 
            return $conn->execReq("SELECT * FROM Serpents INNER JOIN Races ON Serpents.id_race = Races.id_Races WHERE dateMort <= NOW() AND id_race = $category2 ORDER BY nomSerpent;"); 
        }



/*----------------------------------------------------------------------------------------------
Randoms
----------------------------------------------------------------------------------------------*/

        public function randomDeath($idRace){
            $dateAuj = date('Y-m-d H:i:s');
            $jours_min_to_add = 1;
            $jours_max_to_add = ""; 
            if($idRace == 1 || $idRace == 2 || $idRace == 7 ){
                $jours_max_to_add = 22;
            } else if($idRace == 3){
                $jours_max_to_add = 30;
            } else if($idRace == 4){
                $jours_max_to_add = 12;
            } else if($idRace == 5){
                $jours_max_to_add = 18;
            } else if($idRace == 6){
                $jours_max_to_add = 10;
            } else if($idRace == 8){
                $jours_max_to_add = 32;
            } else {
                $jours_max_to_add = 32;
            }
            $valMort = rand($jours_min_to_add, $jours_max_to_add);
            $valMortAdd = strtotime($dateAuj . " + {$valMort} days");
            return $dateMortHasard = date('Y-m-d H:i:s', $valMortAdd);
        }
        
        //génère l'id_race aléatoirement
        public function raceHasard(){ 
            return $raceHasard = rand(1,8);
        }

        //génère le genre aléatoirement
        public function genreHasard(){ 
            return $genreHasard = rand(0, 1);
        }

        //établie le jour et l'heure de la mort à maintenant -> utilisation dans la section byeSerpent
        public function getMort(){ 
            $dateNaissance = date('d-M-Y', strtotime($this->get('dateMort'))). " à ".date('H:i', strtotime($this->get('dateMort')));
            return $dateNaissance;
        } 

/*----------------------------------------------------------------------------------------------
Affichage
----------------------------------------------------------------------------------------------*/

        //affichage des noms de race dans les options de race, section modification
        public function nameRace($idRace){ 
        $idRace = $this->get('id_race');
            switch($idRace){
                case 1: return "Boa";
                break;
                case 2: return "Cobra";
                break;
                case 3: return "Couleuvre";
                break;
                case 4: return "Python";
                break;
                case 5: return "Serpent à sonnette";
                break;
                case 6: return "Serpent des blés";
                break;
                case 7: return "Serpent-roi";
                break;
                case 8: return "Vipere";
                break;
                default : return "Choisissez votre race";
            }
       }

        //affiche le genre dans la création de serpents
        public function publieGenre(){ 
            $genre = $this->get('genreMale');
            if($genre == 1) {
                return "Male";
            }else{
                return "Femelle";
            }
        }

/*----------------------------------------------------------------------------------------------
COUNT
----------------------------------------------------------------------------------------------*/        
        //count total des serpents vivants (accueil)
        public function countSnake(){ 
            $conn = new Bdd(); 
            $total = $conn->execReq("SELECT COUNT(*)
                            FROM Serpents
                            WHERE dateNaissance <= NOW() AND (dateMort > NOW()
                            OR dateMort IS NULL);");
            $nbSnakeAlive= $total[0];
            return $nbSnakeAlive[0];
        }
        
        //count total des serpents (funérarium)
        public function countSnakeDead(){ 
            $conn = new Bdd(); 
            $total = $conn->execReq("SELECT COUNT(*)
                            FROM Serpents
                            WHERE dateMort <= NOW();");
            $nbSnakeDead = $total[0];
            return $nbSnakeDead[0];
        }

        //affichage des serpents males ou femelle vivants + utilisation pagination
        public function countGenderSnakeAlive($genre){ 
            $conn = new Bdd(); 
            $total = $conn->execReq("SELECT COUNT(*)
                            FROM Serpents
                            WHERE genreMale = $genre
                            AND dateNaissance <= NOW() AND (dateMort > NOW()
                            OR dateMort IS NULL);");
            $nbSnakeMFAlive = $total[0];
            return $nbSnakeMFAlive[0];
        }

        public function countRaceSnakeAlive($idRace){ 
            $conn = new Bdd(); 
            $total = $conn->execReq("SELECT COUNT(*)
                            FROM Serpents
                            WHERE id_race = $idRace
                            AND dateNaissance <= NOW() AND (dateMort > NOW()
                            OR dateMort IS NULL);");
            $nbRaceSnkDead = $total[0];
            return $nbRaceSnkDead[0];
        }

        //affichage des serpents males ou femelles morts + utilisation pagination
        public function countGenderSnakeDead($genre){ 
            $conn = new Bdd(); 
            $total = $conn->execReq("SELECT COUNT(*)
                            FROM Serpents
                            WHERE genreMale = $genre
                            AND dateMort <= NOW();");
            $nbSnakeMFDead = $total[0];
            return $nbSnakeMFDead[0];
        }

        //affichage des serpents femelles mortes + utilisation pagination
        public function countRaceSnakeDead($idRace){ 
            $conn = new Bdd(); 
            $total = $conn->execReq("SELECT COUNT(*)
                            FROM Serpents
                            WHERE id_race = $idRace
                            AND dateMort <= NOW();");
            $nbRaceSnkDead = $total[0];
            return $nbRaceSnkDead[0];
        }

/*----------------------------------------------------------------------------------------------
Généalogie
----------------------------------------------------------------------------------------------*/

//requete sql :
//SELECT enfant.id_Serpents, enfant.nomSerpent as nomEnfant, enfant.id_pere, parent.nomSerpent as nomParent
// FROM Serpents enfant 
// JOIN Serpents parent
// ON enfant.id_pere = parent.id_Serpents;

        public function getPere($idSerpent){
            $conn = new Bdd();
            $total = $conn->execReq("SELECT parent.nomSerpent
                                FROM Serpents enfant 
                                LEFT JOIN Serpents parent
                                ON enfant.id_pere = parent.id_Serpents
                                WHERE enfant.id_Serpents = $idSerpent;");
            $nomPere = $total[0];
            return $nomPere[0];
        }

        public function getMere($idSerpent){
            $conn = new Bdd();
            $total = $conn->execReq("SELECT parent.nomSerpent
                                FROM Serpents enfant 
                                LEFT JOIN Serpents parent
                                ON enfant.id_mere = parent.id_Serpents
                                WHERE enfant.id_Serpents = $idSerpent;");
            $nomMere = $total[0];
            return $nomMere[0];
        }


}

?>