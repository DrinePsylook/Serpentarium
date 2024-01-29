<div id='container'>
    <div class="block">
        <div class="modif">
                    <h2>Repeuplement de l'élevage</h2>
        </div>
        <div class="corpsBlock">
            <p>Saisissez le nombre de serpents que vous souhaitez créer.</p>
            <form class="hasard" action="" method="post">
                <label for="nbNvSerp">Nombre de serpents à créer :</label>
                <input type="text" id="nbNvSerp" name="nbNvSerp"/>
                <br/>
                <div class="alignementBouton">
                <button type="submit" class="btn btn-success" id ="creaNbSerp" name='creationNbSerp'>Valider</button>
                <a href="index.php?page=lstserpents"><button type="button" class="btn btn-success mx-auto">Retour</button></a>
</div>
            </form>
        </div>
    </div>
</div>

<?php
    $cptNvSerp = "";              
    if(isset($_POST['creationNbSerp'])){
        $cptNvSerp = $_POST['nbNvSerp'];

            if($cptNvSerp > 0) {
                for($i=0; $i< $cptNvSerp; $i++){
                    $serp = new Serpent($_GET['id']);
                    $nomHasard = $lstNoms[array_rand($lstNoms)];;
                    $raceHasard = $serp->raceHasard();

                    $poidsHasard = ""; //random poidsHasard en  fonction de la raceRandom
                    if($raceHasard == 1){
                        $poidsHasard = rand(8, 18);
                    } else if($raceHasard == 2){
                        $poidsHasard = rand(10, 18);
                    } else if($raceHasard == 3){
                        $poidsHasard = mt_rand(10, 30)/100;
                    } else if($raceHasard == 4){
                        $poidsHasard = rand(80, 100);
                    } else if($raceHasard == 5){
                        $poidsHasard = rand(2, 7);
                    } else if($raceHasard == 6){
                        $poidsHasard = mt_rand(40, 70)/100;
                    }else if($raceHasard == 7){
                        $poidsHasard = rand(1, 3);
                    } else if($raceHasard == 8){
                        $poidsHasard = mt_rand(10, 40)/100;
                    } 

            
                $dateMortHasard = $serp->randomDeath($raceHasard);
                $genreHasard = $serp->genreHasard();
                    
                $serp->set('nomSerpent', $nomHasard);
                $serp->set('id_race', $raceHasard);
                $serp->set('dateNaissance', $dateAuj);
                $serp->set('dateMort', $dateMortHasard);
                $serp->set('poids', $poidsHasard);
                $serp->set('genreMale', $genreHasard);
                $_GET['id']="new";
                }

                 //redirection php
                header('Location: index.php?page=lstserpents');

                //redirection javascript
                echo "<script language='javascript'>window.location='index.php?page=lstserpents'</script>";
            }

        }
        ?>
           


    
     


