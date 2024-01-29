<?php
$countSnkMalive = $serp->countGenderSnakeAlive(1);//compte le nombre de mâles vivants

$countSnkFemAlive = $serp->countGenderSnakeAlive(0);//compte le nombre de femelles vivantes

$pagination = new Pagination();

$currentPage = $pagination->currentPage();
$nbPagesAll = $pagination->nbPageSnAlive($countSnakeAlive);
$parPage = $pagination->getParPage(10);
$premier =($currentPage * $parPage) - $parPage;

?>
<form action="" method="post">
    <input type="" id="currentPage" value="<?= $currentPage ?>" hidden/>
    <input type="" id="parPage" value="<?= $parPage?>" hidden/> 
    <input type="" id="premier" value="<?= $premier?>" hidden/>
    <input type="" id="nbPagesAll" value="<?= $nbPagesAll?>" hidden/>
</form>

<div class="corpus">
<h2>Voici la liste de nos serpents vivants</h2>


<div class="genre"> <!-- affichage des sigles males et femelles + nombres -->
    <div class="sexe"> 
        <img src="images/sigleMale.png" alt="sigle mâle">
        <p><?php echo $countSnkMalive; ?> mâles</p>
    </div>    
    <div class="sexe">    
        <img src="images/sigleFemelle.png" alt="sigle femelle">
        <p><?php echo $countSnkFemAlive; ?> femelles</p>
    </div>
</div>



<a href="index.php?page=updtserp&id=new"><button type="button" class="btn btn-success m-3">Créer un nouveau serpent</button></a>

<a href="index.php?page=repeuplement&id=new"><button type="button" class="btn btn-success m-3">Création aléatoire de serpents</button></a>

<div id="filter">
    <h5>Filtres : </h5>
    <div id="sexFilter">
        <select id="genderFilter">
            <option value=''>Choisissez le genre</option>
            <option value='0'>Femelle</option>;
            <option value='1'>Mâle</option>
            <option value='all'>Tous</option>
        </select>
    </div>
    <div id="snakeRaceFilter">
        <select id="raceFilter">
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

<!-- Entête du tableau -->
<table class="table table-striped-columns m-1">

    <thead class="table-success nomColTabAlive">
        <!--noms de colonnes appelés dans la page ajax_function.js-->
    </thead>
    
    <tbody  id="listSnakAlive">
<!-- affichage des serpents vivants appelé dans la page ajax_function.js-->
    </tbody>
</table>

<div class="boutonsPagination"> <!-- boutons de pagination : précédent et suivant disabled si on est sur la première et dernière  -->
        <a href="./?page=lstserpents&pagin=<?= $currentPage - 1 ?>"><button class='btn btn-success' type='button' <?= ($currentPage == 1)?"disabled" : "" ?>>Précédente</button></a>
        <?php
        $pg="";
        for($pg=1; $pg <= $nbPagesAll; $pg++){ ?>
            <a href="./?page=lstserpents&pagin=<?= $pg ?>&categorie="><button class='btn btn-success' type='button' <?= ($currentPage == $pg)?"disabled" : "" ?>><?= $pg ?></button></a>
        <?php }
        ?>
        <a href="./?page=lstserpents&pagin=<?= $currentPage + 1 ?>"><button class='btn btn-success' type='' <?= ($currentPage == $nbPagesAll)?"disabled" : "" ?>>Suivante</button></a>
    </div>


<!-- bouton retour à l'accueil -->
<div class="retour"><a href='index.php?page=accueil'><button class='btn btn-success mx-auto' type='button'>Retour</button></a></div>

</div>