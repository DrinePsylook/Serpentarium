<?php
require_once('../classes/bdd.class.php');
require_once('../classes/serpent.class.php');
require_once('../classes/race.class.php');
require_once('../classes/date.class.php');
require_once('../classes/pagination.class.php');

$currentPage = isset($_POST['currentPage']) ? $_POST['currentPage'] : 1;
$parPage = isset($_POST['parPage']) ? $_POST['parPage'] : 10;
$premier = isset($_POST['premier']) ? $_POST['premier'] : 10;

 $serp = new Serpent();
 $tabSnakeAlive = $serp->selectAllAlive($premier, $parPage);
 $dateAuj = date('Y-m-d H:i:s');
 $race = new Race();
 $tblRace= $race->selectRace();
 $date = new Date();
 $numSnkAlive = 0 + $premier;
 

    foreach($tabSnakeAlive as $serpent) {

        //déclaration des variables
        $idSerpent = $serpent['id_Serpents'];
        $numSnkAlive = $numSnkAlive+1;
        $nomSerpent = ucwords($serpent['nomSerpent']);
        $race = $serpent['libelleRace'];
        $poids = $serpent['poids'];
        $imgRace = $serpent['imgRace'];
        $genre = $serpent['genreMale'];
        $dateNaissance = $date->afficheDateFr($serpent['dateNaissance']);
        $idPere = $serpent['id_pere'];
        $idMere = $serpent['id_mere'];
        $nomPere = $serp->getPere($idSerpent);
        $nomMere = $serp->getMere($idSerpent);
        $mort= "";
        if( $serpent['dateMort'] == null || $dateAuj < $serpent['dateMort']){
            $mort = 0;
        } else {
            $mort = 1;
        }

        
//Affichage des serpents à condition qu'ils soient nés et vivants à la date d'aujourd'hui, ou que la date de mort soit égale à null       
if($serpent['dateNaissance'] < $dateAuj && $serpent['dateMort'] > $dateAuj || $serpent['dateMort'] == null){
?>
    <tr>
            <th scope="row">
            <form acton="" method="post">
    <input type="" id="nbPagesAllSnakesAlive" value="<?= $nbPagesAll; ?>" hidden/>
</form>

                <?php echo $numSnkAlive; ?>
            </th>

            <td>
                <?php 
                    if ($mort == 0) {
                        echo "<a href='index.php?page=updtserp&id=".$idSerpent."'><button type='button' class='btn btn-success mx-auto'>Modifier</button></a>";
                    } else {
                        echo "<button type='' class='btn btn-secondary mx-auto'>Modification impossible</button> "; 
                   }  
                ?>
            </td>

            <td>
                <?php 
                    if ($mort == 0) {
                        echo "<a href='index.php?page=byeserp&id=".$idSerpent."'><button type='button' class='btn btn-success mx-auto'>Tuer</button></a>";
                    } else {
                        echo "<button type='' class='btn btn-secondary mx-auto'>Déjà mort</button> "; 
                    }  
                ?>
            </td>

            <td>
                <img src="images/<?php echo $imgRace ?>" class= "imgList" alt="Photo de la race : <?php echo $race ?>">
            </td>

            <td>
                <?php echo $nomSerpent; ?>
            </td>

            <td>
                <?php echo $race; ?>
            </td>

            <td>
                <?php echo $poids." kg"; ?>
            </td>

            <td>
                <?php 
                    if($genre == 1) {
                        echo '<span class="male">Mâle</span>';
                    }else{
                        echo '<span class="femelle">Femelle</span>';
                    } 
                ?>
            </td>

            <td>
                <?php echo $dateNaissance; ?>
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
                    echo "<button type='' class='btn btn-secondary mx-auto genealogy' disabled>Inconnue</button>";
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