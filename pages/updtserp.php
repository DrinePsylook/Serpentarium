<?php
$serp = new Serpent($_GET['id']);
//var_dump($_GET['id']);

$nomSerp = $serp->get('nomSerpent');
$dateNaissance = $serp->get('dateNaissance');

if(isset($_POST['changement'])){
    
    foreach ($_POST as $key => $value) {
        if($key != 'changement') {
            $serp->set($key, $value);
        }
    }

    //redirection php
    header('Location: index.php?page=lstserpents');

    //redirection javascript
    echo "<script language='javascript'>window.location='index.php?page=lstserpents'</script>";

}



$poids = $serp->get('poids');

if(!$dateNaissance || $dateNaissance ==null){ //enregistrement différent selon que ce soit la modification ou la création de serpent
    $dateNaissanceAffich = $dateAuj;
    $creation = 1;
} else {
    $dateNaissanceAffich = date('Y-m-d',strtotime($dateNaissance)). " ". date('H:i', strtotime($dateNaissance));
    $creation = 0;
}
$dateMort = $serp->get('dateMort');
$idRace = $serp->get('id_race');
$libelleGenre = $serp->publieGenre();
$genre = $serp->get('genreMale');
$race = $serp->nameRace($idRace);


$raceValue = 1; //valeur par défaut permettant de récupérer par la suite la race pour le randomDeath
?>
<div id='container'>
    <div class="block">        
        <div class="modif">
            <h2>
                <?php if($dateNaissance){
                    echo "Modification";
                }else{
                    echo "Création";
                } ?>
            </h2>
        </div>

        <div class="corpsBlock">
            <form action="" method="POST">
                Nom :<br/>
                    <input type="text" id= "nomSerpentChgmt" name="nomSerpent" value="<?php echo $nomSerp; ?>"/></br>
                Poids (kg):<br/>
                    <input type="text" name="poids" value="<?php echo $poids; ?>"/></br>
                Date de naissance :<br/>
                    <input type="datetime-local" id = "dateNaissModif" name="dateNaissance" value="<?php echo $dateNaissanceAffich; ?>"/></br>
                Race : <br/>
                    <select name="id_race" id="affichRace">
                        <option value='<?php echo $idRace; ?>'><?php echo $race; ?></option>
                            <?php
                            foreach($tblRace as $race) {
                                $nomRace = $race['libelleRace'];
                                $id_Race = $race['id_Races'];
                                echo "<option class='colorSelect' value='$id_Race'>$nomRace</option>";
                            }
                            ?>
                    </select> <br/>
                Genre :<br/>
                    <select name="genreMale" id="affichGenre">
                        <?php if($genre == null) {
                                echo "<option value=''>Choisissez le genre</option>";
                                echo "<option value='0'>Femelle</option>";
                                echo "<option value='1'>Mâle</option>";
                            } else if($genre == 1) {
                                echo "<option value='$genre'>$libelleGenre</option>";
                                echo "<option value='0'>Femelle</option>";
                            }else if($genre==0){
                                    echo "<option value='$genre'>$libelleGenre</option>";
                                    echo "<option value='1'>Mâle</option>";
                                }?>
                    </select><br/>

                    <input type="" id="creaOrModif" value="<?= $creation ?>" hidden />
                
                    <input type="" id="raceValue" value="<?= $raceValue ?>" hidden /> 
                    <!-- La valeur de la race onChange est récupérée et renvoyée en javascript pour lpouvoir utiliser la méthode randomDeath -->
                <?php 
            
                $dateMortHasard = $serp->randomDeath($raceValue);

                if($dateMort == null || !$dateMort){
                    echo "<input type='datetime-local' name='dateMort' value='$dateMortHasard' hidden/></br>";
                }
            ?>
                <div class="alignementBouton">
                    <button id='changement' class='btn btn-success mx-auto kill' type='submit' name='changement'>Enregistrer</button>
                    <a href="index.php?page=lstserpents"><button type="button" class="btn btn-success mx-auto kill">Retour</button></a>
                </div>
            </form>
        </div>
    </div>
</div>