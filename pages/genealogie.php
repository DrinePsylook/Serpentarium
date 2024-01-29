<?php 
$serp = new Serpent($_GET['id']);
//var_dump($_GET['id']);

$idSerpent = $serp->get('id_Serpents');
$nomSerpent= $serp->get('nomSerpent');
$dateNaissance= $date->afficheDateFr($serp->get('dateNaissance'));
$dateMort= $date->afficheDateFr($serp->get('dateMort'));
$genre = $serp->get('genreMale');
$idPere = $serp->get('id_pere');
$idMere = $serp->get('id_mere');
$nomPere = $serp->getPere($idSerpent);
$nomMere = $serp->getMere($idSerpent);

$id_ancestor = $serp->get('id_pere');
$id_ancestress = $serp->get('id_mere');
$nomEnfant = $nomSerpent;
?>

<div class="corpus">
<h2>Généalogie de <?= $nomSerpent ?></h2>

<div class="childrenSnk">
    <h4 class="nomGeneal"><?= $nomSerpent ?></h4>
    <p>Né le <?= $dateNaissance ?></p>
    <p>Mort le <?= $dateMort ?></p>
    <p><?php if($genre = 0){
                echo "Fille de ";
                } else {
                    echo "Fils de ";
                } 
                echo $nomPere. " et de ".$nomMere
        ?>
    </p>
</div>
<div class="textPrst">
    <h4 class="titleGeneal">Côté paternel</h4>
    <div class="genealParent">
        <?php
        affichPere($id_ancestor, $nomEnfant);
        ?>
    </div>
</div>
<div class="textPrst">
    <h4 class="titleGeneal">Côté maternel</h4>
    <div class="genealParent">
        <?php
        affichMere($id_ancestress, $nomEnfant);
        ?>
    </div>
</div>

<?php
function affichPere($id_ancestor, $nomEnfant){
    $date = new Date();

    //ancêtre père :
    $serpAncestor = new Serpent($id_ancestor);
    $idSerpAncestor = $serpAncestor->get('id_Serpents');
    $nameAncestor = $serpAncestor->get('nomSerpent');
    $ancestorBirthday = $date->afficheDateFr($serpAncestor->get('dateNaissance'));
    $ancestorDeathday = $date->afficheDateFr($serpAncestor->get('dateMort'));
    $idPereAncestor = $serpAncestor->get('id_pere');
    $idMereAncestor = $serpAncestor->get('id_mere');
    $nomPereAncestor = $serpAncestor->getPere($idSerpAncestor);
    $nomMereAncestor = $serpAncestor->getMere($idSerpAncestor);

    if($idPereAncestor == null && $idMereAncestor == null){
        $afficheAncetresPere = "Généalogie inconnue";
    } else if($idPereAncestor != null && $idMereAncestor == null){
        $afficheAncetresPere =  "Enfant de ".$nomPereAncestor.", mère inconnue";
    } else if($idPereAncestor == null && $idMereAncestor != null){
        $afficheAncetresPere =  "Enfant de ".$nomMereAncestor.", père inconnu";
    } else {
        $afficheAncetresPere = "Enfant de ".$nomPereAncestor." et de ".$nomMereAncestor;
    }
    
    if($id_ancestor != null){
        $num = 1;
        echo '<div class="fatherSnk">
                    <h4 class="nomGeneal">'.$nameAncestor.'</h4>
                    <p>Enfant : '.$nomEnfant.'</p>
                    <p>Né le '.$ancestorBirthday.'</p>
                    <p>Mort le '.$ancestorDeathday.'</p>
                    <p>'.$afficheAncetresPere.'</p>
                </div>';
    } else{
        echo '<div class="fatherSnk">
                    <h4 class="nomGeneal">Père inconnu</h4>
                </div>';
    }

    if($idPereAncestor!= null || $idMereAncestor != null){
        $nomEnfant = $nameAncestor;
        $id_ancestor = $idPereAncestor;
        $id_ancestress = $idMereAncestor;
        echo '<div>'.affichPere($id_ancestor, $nomEnfant).affichMere($id_ancestress, $nomEnfant).'</div>';
    }

}

function affichMere($id_ancestress, $nomEnfant){
    $date = new Date();

    //ancêtre mère
    $serpAncestress = new Serpent($id_ancestress);
    $idSerpAncestress = $serpAncestress->get('id_Serpents');
    $nameAncestress = $serpAncestress->get('nomSerpent');
    $ancestressBirthday = $date->afficheDateFr($serpAncestress->get('dateNaissance'));
    $ancestressDeathday = $date->afficheDateFr($serpAncestress->get('dateMort'));
    $idPereAncestress = $serpAncestress->get('id_pere');
    $idMereAncestress = $serpAncestress->get('id_mere');
    $nomPereAncestress = $serpAncestress->getPere($idSerpAncestress);
    $nomMereAncestress = $serpAncestress->getMere($idSerpAncestress);

    if($idPereAncestress == null && $idMereAncestress == null){
        $afficheAncetresMere = "Généalogie inconnue";
    } else if($idPereAncestress != null && $idMereAncestress == null){
        $afficheAncetresMere =  "Enfant de ".$nomPereAncestress.", mère inconnue";
    } else if($idPereAncestress == null && $idMereAncestress != null){
        $afficheAncetresMere =  "Enfant de ".$nomMereAncestress.", père inconnu";
    } else {
        $afficheAncetresMere = "Enfant de ".$nomPereAncestress." et de ".$nomMereAncestress;
    }

    if($id_ancestress != null){
        $num = 2;
        echo '<div class="motherSnk">
                    <h4 class="nomGeneal">'.$nameAncestress.'</h4>
                    <p>Enfant : '.$nomEnfant.'</p>
                    <p>Né le '.$ancestressBirthday.'</p>
                    <p>Mort le '.$ancestressDeathday.'</p>
                    <p>'.$afficheAncetresMere.'
                    </p>
                </div>';
    } else {
        echo '<div class="motherSnk">
                    <h4 class="nomGeneal">Mère inconnu</h4>
                </div>';
    }
    ?>

    </div>
<?php

if($idPereAncestress!= null){
    $nomEnfant = $nameAncestress;
    $num= $num+1;
    $id_ancestor = $idPereAncestress;
    $id_ancestress = $idMereAncestress;
    echo '<div>'.affichPere($id_ancestor, $nomEnfant).affichMere($id_ancestress, $nomEnfant).'</div>';
}
}


