<?php
require_once('../classes/bdd.class.php');
require_once('../classes/serpent.class.php');
require_once('../classes/race.class.php');
require_once('../classes/date.class.php');
require_once('../classes/pagination.class.php');

$currentPage = isset($_POST['currentPage']) ? $_POST['currentPage'] : 1;
$parPage = isset($_POST['parPage']) ? $_POST['parPage'] : 10;
$premier = isset($_POST['premier']) ? $_POST['premier'] : 10;


$category1 = isset($_POST['genderFilter']) ? $_POST['genderFilter'] : 1;
$category2 = isset($_POST['raceFilter']) ? $_POST['raceFilter'] : 1;

$serp = new Serpent();

if(($category1  === "" || $category1 === "all") ){
    $tabfilterDead = $serp->filterRaceSnakeDead($category2);
} else if($category2  === "" || $category2 === "all"){    
    $tabfilterDead = $serp->filterGenderSnakeDead($category1); 
} else  {    
    $tabfilterDead = $serp->filterSnakeDead($category1, $category2);
}

$serp = new Serpent();
 $tabSnakeDead = $serp->selectAllDead($premier, $parPage);
 $dateAuj = date('Y-m-d H:i:s');
 $race = new Race();
 $tblRace= $race->selectRace();
 $date = new Date();

 foreach($tabfilterDead as $serpent) { //je parcours tous les serpents du tableau et je liste les variables :
        
    $idSerpent = $serpent['id_Serpents'];
    $nomSerpent = $serpent['nomSerpent'];
    $race = $serpent['libelleRace'];
    $imgRace = $serpent['imgRace'];
    $genre = $serpent['genreMale'];
    $dateNaissance = $date->afficheDateFr($serpent['dateNaissance']);
    $idPere = $serpent['id_pere'];
    $idMere = $serpent['id_mere'];
    $nomPere = $serp->getPere($idSerpent);
    $nomMere = $serp->getMere($idSerpent);
    
    
    if($serpent['dateMort'] <= $dateAuj && $serpent['dateMort'] != null){
        $dateMort =  $date->afficheDateFr($serpent['dateMort']);
?>
        <tr>
            <th scope="row"><?php echo $idSerpent; ?></th>
            <td><button type="" class="btn btn-secondary mx-auto">Décédé</button></td>
            
            <td>
                <img src="images/<?php echo $imgRace ?>" class= "imgList" alt="Photo de la race : <?php echo $race ?>">
            </td>
            
            <td><?php echo $nomSerpent; ?></td>
            <td><?php echo $race; ?></td>

            <td><?php 
                if($genre == 1) {
                    echo '<span class="male">Mâle</span>';
                }else{
                    echo '<span class="femelle">Femelle</span>';
                } ?>
            </td>

            <td>
                <?php echo $dateNaissance; ?>
            </td>
            <td><?php 
                    echo $dateMort;
                ?>
            </td>
            <td>
                <?php 
                    if ($idPere == null) {
                    echo "/";
                    } else {
                        echo $nomPere;
                    } 
                ?>
            </td>
            <td>
                <?php 
                    if ($idMere == null) {
                        echo "/";
                    } else {
                        echo $nomMere;
                    } 
                ?>
            </td>
            <td>
                <?php
                if($idPere == null && $idMere == null){
                    echo "<button type='' class='btn btn-secondary mx-auto genealogy'>Inconnue</button>";
                } else {
                    echo "<a href='index.php?page=genealogie&id=".$idSerpent."'><button type='button' class='btn btn-success mx-auto genealogy'>Généalogie</button></a>";
                }
                ?>
            </td>
        </tr>
    
<?php 
    }
}

?>