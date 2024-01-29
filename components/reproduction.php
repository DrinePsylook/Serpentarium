<?php
require_once('../classes/bdd.class.php');
require_once('../classes/serpent.class.php');
require_once('../classes/race.class.php');
require_once('../classes/date.class.php');
require_once('../classes/pagination.class.php');

$_GET['id']="new";
$serp = new Serpent();
$race = new Race();
$tblRace= $race->selectRace();
$date = new Date();
$raceName= "";

$category2 = isset($_POST['raceChosen']) ? $_POST['raceChosen'] : 1;

if(($category2  != "") ){
    $tabRaceChosenMalive = $serp->filterSnakeAlive(1, $category2);
    $tabRaceChosenFemalive = $serp->filterSnakeAlive(0, $category2);
}

foreach($tblRace as $race) {
    $nomRace = $race['libelleRace'];
    $id_Race = $race['id_Races'];
    if($id_Race == $category2){
        $raceName = $nomRace;
    }
}

?> 

<div class="container mx-auto">

        <div class="inLove">      
            <div class="byRace">
                <h5>Mâles <?= $raceName?></h5>
                <img src="images/male_snake_in_love.png" alt="serpent turquoise">
                <select id="maleByRace">
                    <option value=''>Choisissez le mâle</option>
                        <?php
                            foreach($tabRaceChosenMalive as $serpentMale) {
                                $idSerpentMale = $serpentMale['id_Serpents'];
                                $nomSerpentMale = ucwords($serpentMale['nomSerpent']);
                                $dateNaissMale = $date->afficheDateFr($serpentMale['dateNaissance']);
                                echo "<option value='$idSerpentMale'>$nomSerpentMale, né le $dateNaissMale</option>";
                            }
                        ?>
                </select>
            </div>

            <div class="byRace">
                <h5>Femelles <?= $raceName?></h5>
                <img src="images/female_snake_in_love.png" alt="serpent violet">
                <select id="femaleByRace">
                    <option value=''>Choisissez la femelle</option>
                        <?php
                            foreach($tabRaceChosenFemalive as $serpentFemale) {
                                $idSerpentFemale = $serpentFemale['id_Serpents'];
                                $nomSerpentFemale = ucwords($serpentFemale['nomSerpent']);
                                $dateNaissFemale = $date->afficheDateFr($serpentFemale['dateNaissance']);
                                echo "<option value='$idSerpentFemale'>$nomSerpentFemale, né le $dateNaissFemale</option>";

                            }
                        ?>
                </select>
            </div>
        </div>
        <input type="hidden" id="raceTransmise" value="<?= $category2 ?>" />
        <input type="hidden" id="getId" value="<?= $_GET['id'] ?>" />
    
        
    
</div>





