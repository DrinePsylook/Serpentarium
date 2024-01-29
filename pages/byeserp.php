<?php

$serp = new Serpent($_GET['id']);
$nomSerp = $serp->get('nomSerpent');
$dateNaissance = $date->afficheDateFr($serp->get('dateNaissance'));
$dateMort = $serp->getMort();

if(isset($_POST['kill'])){
    if($dateMort != 'kill') $serp->set('dateMort', $dateAuj); //validation de la mort
    echo "<div id='container'>
            <div class='card annonce'>
                    <div class='card-body mx-auto deathOk'>"
                        .$nomSerp. " est mort.<br/>
                        <a href='index.php?page=lstserpents'><button type='button' class='btn btn-success'>OK</button></a>
                    </div>
            </div>
        <div>";
} else {  //message d'avertissement
    echo "
    <div id='container'>
        <div class='card annonce'>
            <div class='card-body mx-auto'>
                <form action='' method='POST'> 

                    <label>Vous allez tuer :</label><br/>
                    <p class='green'>".$nomSerp."</p><br/> 
                    <input class='noborder' type='text' value='né le " .$dateNaissance."' disabled/><br/>
                    <p>Veuillez confirmer :</p>
                    <input class='noborder' type='hidden' value='".$dateMort."' disabled/><br/>
                    <p><button class='btn btn-success mx-auto kill' type='submit' name='kill'>Confirmer la mort</button> 
                    <a href='index.php?page=lstserpents'><button class='btn btn-success mx-auto' type='button'>Retour</button></a></p>
                    
                </form>
            <div>
        </div> 
    </div> 

";}
?>

