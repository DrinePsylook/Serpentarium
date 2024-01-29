<?php
$serp = new Serpent($_GET['id']);
// var_dump($_GET['id']);
$date = new Date();
$dateAuj = date('Y-m-d H:i:s');  
$raceTransmise = 0;
$nomHasard = $lstNoms[array_rand($lstNoms)];

$poidsHasard = ""; 
if($raceTransmise == 1){
    $poidsHasard = rand(8, 18);
} else if($raceTransmise == 2){
    $poidsHasard = rand(10, 18);
} else if($raceTransmise == 3){
    $poidsHasard = mt_rand(10, 30)/100;
} else if($raceTransmise == 4){
    $poidsHasard = rand(80, 100);
} else if($raceTransmise == 5){
    $poidsHasard = rand(2, 7);
} else if($raceTransmise == 6){
    $poidsHasard = mt_rand(40, 70)/100;
}else if($raceTransmise == 7){
    $poidsHasard = rand(1, 3);
} else if($raceTransmise == 8){
    $poidsHasard = mt_rand(10, 40)/100;
} else {
    $poidsHasard = mt_rand(10/100, 90);
}

$genreHasard = $serp->genreHasard();
$dateMortHasard = $serp->randomDeath($raceTransmise);
?>


<div class="corpus">
    <h2>Reproductarium</h2>
    <p class="byRace">Choisissez la race puis le couple à reproduire</p>
    
    <div class="selectRace">
        <select id="raceChosenForRepro">
            <option value=''>Choisissez votre race</option>
            <?php
                foreach($tblRace as $race) {
                    $nomRace = $race['libelleRace'];
                    $id_Race = $race['id_Races'];
                    $nbSnakeByRace = $serp->countRaceSnakeAlive($id_Race);
                    echo "<option value='$id_Race'>$nomRace ($nbSnakeByRace serpents) </option>";
                }
            ?>
        </select>
    </div>

    <div id="lovers">

    </div>

    <div class="boutonRepro divNone">
            <form action="" method="post">
                
                <input type="hidden" id="nomHasard" name="nomSerpent" value="<?php echo $nomHasard; ?>"/>
                <input type="hidden" id="raceTransmise" name="id_race" value="<?php echo $raceTransmise; ?>"/>
                <input type="hidden" id="raceTransmisePourPds" name="poids" value="<?php echo $poidsHasard; ?>"/>
                <input type="hidden" id ="dateNaissRepro" name="dateNaissance" value="<?php echo $dateAuj; ?>"/>
                <input type="hidden" name="dateMort" value="<?php echo $dateMortHasard; ?>"/>
                <input type="hidden" name="genreMale" value="<?php echo $genreHasard; ?>"/>
                <input type="hidden" id="idSerpentMale" name="id_pere" value="<?php echo $idSerpentMale; ?>"/>
                <input type="hidden" id="idSerpentFemale" name="id_mere" value="<?php echo $idSerpentFemale; ?>"/>
                
                <button type="submit" name="reproGo" id="reproGo"  class="btn btn-success">Reproduire</button>
            </form>
        </div>

</div>




<?php



if(isset($_POST['reproGo'])){
    
    foreach ($_POST as $key => $value) {
        if($key != 'reproGo') {
            $serp->set($key, $value);
        }
    }
    echo $nomHasard." est né.<script language='javascript'>window.location='index.php?page=reproductarium&id=new'</script>";
    echo '<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?= $nomHasard ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div>
        </div>
    </div>
    </div>';

}

?>