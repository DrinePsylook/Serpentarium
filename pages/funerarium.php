<?php

$pagination = new Pagination();
$currentPage = $pagination->currentPage();
$nbPages = $pagination->nbPageSnDead($countSnakeDead);
$parPage = $pagination->getParPage(10);
$premier =($currentPage * $parPage) - $parPage;
// var_dump($nbPages);

?>
<form action="" method="post">
    <input type="" id="currentPage" value="<?= $currentPage ?>" hidden/>
    <input type="" id="parPage" value="<?= $parPage?>" hidden/>
    <input type="" id="premier" value="<?= $premier?>" hidden/>
</form>

<div class="corpus">
<h2>Funérarium : nos <?php echo $countSnakeDead; ?> serpents décédés</h2>

<div class="genre">
    <div class="sexe">
        <img src="images/sigleMale.png" alt="sigle mâle">
        <p><?php echo $countSnkMalDead; ?> mâles</p>
    </div>    
    <div class="sexe">    
        <img src="images/sigleFemelle.png" alt="sigle femelle">
        <p><?php echo $countSnkFemalDead; ?> femelles</p>
    </div>
</div>

<div id="filter">
    <h5>Filtres : </h5>
    <div id="sexFilter">
        <select id="genderFilterDead">
            <option value=''>Choisissez le genre</option>
            <option value='0'>Femelle</option>;
            <option value='1'>Mâle</option>
            <option value='all'>Tous</option>
        </select>
    </div>
    <div id="snakeRaceFilter">
        <select id="raceFilterDead">
            <option value=''>Choisissez la race</option>
            <?php
                foreach($tblRace as $race) {
                    $nomRace = $race['libelleRace'];
                    $id_Race = $race['id_Races'];
                    echo "<option class='colorSelect' value='$id_Race'>$nomRace</option>";
                }
            ?>
            <option value='all'>Tous</option>
        </select> <br/>
    </div>
</div>

<table class="table table-striped-columns m-1">

            <thead class="table-success nomColTabDead">
                <!-- noms de colonnes appelés dans la page ajax_function.js-->
            </thead>

            <tbody id="listSnakDead">
                <!-- affichage des serpents morts appelé dans la page ajax_function.js-->
            </tbody>
        </table>

        <div class="boutonsPagination"> <!-- boutons de pagination : précédent et suivant disabled si on est sur la première et dernière  -->
        <a href="./?page=funerarium&pagin=<?= $currentPage - 1 ?>"><button class='btn btn-success' type='button' <?= ($currentPage == 1)?"disabled" : "" ?>>Précédente</button></a>
        <?php
        $pg="";
        for($pg=1; $pg <= $nbPages; $pg++){ ?>
            <a href="./?page=funerarium&pagin=<?= $pg ?>"><button class='btn btn-success' type='button' <?= ($currentPage == $pg)?"disabled" : "" ?>><?= $pg ?></button></a>
        <?php }
        ?>
        <a href="./?page=funerarium&pagin=<?= $currentPage + 1 ?>"><button class='btn btn-success' type='button' <?= ($currentPage == $nbPages)?"disabled" : "" ?>>Suivante</button></a>
    </div>

        <div class="retour"><a href='index.php?page=accueil'><button class='btn btn-success mx-auto' type='button'>Retour</button></a></div>
</div>