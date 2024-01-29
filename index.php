<?php
    session_start();
    require_once('classes/bdd.class.php'); 
    require_once('classes/serpent.class.php');
    require_once('classes/race.class.php');
    require_once('classes/pagination.class.php');
    require_once('classes/date.class.php');
    require_once('components/tableauNoms.php');
    error_reporting(E_ALL ^ E_DEPRECATED);


    $serp = new Serpent();
    $tblserp = $serp->selectAll();
    $race = new Race();
    $tblRace= $race->selectRace();
    $date = new Date();
    $pagination = new Pagination;

    $dateAuj = date('Y-m-d H:i:s');

    $serp->delete(); //efface les champs null

    $countSnakeAlive = $serp->countSnake(); //compte tous les serpents vivants
    $countSnakeDead = $serp->countSnakeDead();//compte tous les serpents morts

    $countSnkMalive = $serp->countGenderSnakeAlive(1);//compte le nombre de mâles vivants
    $countSnkFemAlive = $serp->countGenderSnakeAlive(0);//compte le nombre de femelles vivant

    $countSnkMalDead = $serp->countGenderSnakeDead(1);//compte le nombre de mâles morts
    $countSnkFemalDead = $serp->countGenderSnakeDead(0);//compte le nombre de femelles morts

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Serpentarium</title>
        <link rel="icon" href="images/iconSnake.png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="scripts.js" defer></script>
        <script src="ajax_function.js" defer></script>
        <!-- <script src="components/ajax_function.js" defer></script> -->
        <link rel="stylesheet" href="design.css" />
    </head>

    <body>
        <header>
            <?php include('menu.php')
            ?>
        </header>

        <div id="content">
            <?php 
            if(!isset($_GET['page']) || $_GET['page'] == '')    $_GET['page'] = 'accueil';
            $fileimport = 'pages/'.$_GET['page'].'.php';
            if(file_exists($fileimport)) 
            {
                include($fileimport);
            } else {
                echo "<div class='card badPg' style='width: 18rem;'>
                <div class='card-body'>
                <h6 class='card-subtitle mb-2 oups'>Oups, la page n'est pas disponible.</h6>
                </div>
                </div>";
            }
            ?>
        </div>


    </body>
</html>