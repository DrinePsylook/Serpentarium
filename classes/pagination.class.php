<?php

    class Pagination {

        private $page ="";
        private $parPage ="";
        private $currentPage ="";


        public function __construct(){
            $this->page;
            $this->parPage;
        }

        public function getParPage($value){
            return $this->parPage = $value;
        }

        public function setParPage($parPage, $value){
            $this->parPage = "";
        }

        public function nbPageSnAlive($count){ //Calcul du nombre de pages total
            $parPage = $this->getParPage(10);
            $nbPage = ceil($count / $parPage); 
            return $nbPage;
        }

        public function nbPageSnDead($count){ //Calcul du nombre de pages total
            $parPage = $this->getParPage(10);
            $nbPage = ceil($count / $parPage); 
            return $nbPage;
        }

        public function currentPage(){
            if(isset($_GET['pagin']) && !empty($_GET['pagin'])){
                return $currentPage = (int) strip_tags($_GET['pagin']);
            }else{
                return $currentPage = 1;
            }
        }

        public function first(){
            $currentPage = $this->currentPage();
            $parPage = $this->getParPage(10);
            return $premier =($currentPage * $parPage) - $parPage;
        }

    }