<?php

    class Race {
        
        private $tblRace = "Races";
	    private $id = "";
    

        public function __construct($myid = "vide"){ //ajouter un serpent
            if($myid != "vide" && $myid != 'new') $this->id = $myid;
            if($myid == "new") {
                $conn = new Bdd();
                $this->id = $conn->create($this->tblSerps);
            }
        }

        public function selectRace(){
            $conn = new Bdd();
            return $conn->execReq("SELECT * FROM Races");
        }

        public function get($col) {
            $conn = new Bdd();
            return $conn->select($this->tblRace, $this->id, $col);
        }
    
        public function set($col, $value) {
            $conn = new Bdd();
            return $conn->misajour($this->tblRace, $this->id, $col, $value);
        }
    }