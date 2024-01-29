<h1>Bienvenue dans l'élevage de serpent de Psylook</h1>

<div class="prstAccueil">
    <img class="imgAccueil" src="images/serpent-sonnette-illustration.jpg" alt="illustration serpent à sonnette">
    <div class="textPrst">
        <h5>Un élevage de serpent comme vous n'en verrez jamais ailleurs</h5>
        <p class="textAccueil">Nous vous proposons de découvrir notre serpentarium.<br>
        Nous avons 8 races domestiquées et nous comptons bien agrandir notre cheptel.<br/>
        Vous pouvez parcourir la liste de nos serpents vivants dans le serpentarium. Nous avons conservé la trace de nos serpents décédés dans le funérarium.<br/>
        Vous pouvez créer un serpent individuellement, ou repeupler le serpentarium en déterminant le nombre de serpents que vous souhaitez créer.<br/>
        Vous pouvez modifier ou tuer les serpents encore vivants et consulter la généalogie de chacun.
        Nous vous laissons la main sur la reproduction de nos serpents.<br/>
        Actuellement, dans notre serpentarium, nous avons :</p>
        <p class="annonceNbr"><?php echo $countSnakeAlive; ?> serpents</p>
    </div>  
</div>

<div id="carteAccueil">
    <div class="choixAccueil">
        <h3>Serpentarium</h3>
        <a href="index.php?page=lstserpents"><img class="imgAccueil" src="images/Serpentarium.png" alt="Serpentarium"></a>
        <p class="textAccueil">Venez découvrir nos serpents.<br/>
        Vous ne serez pas déçu de la visite.</p>
        <a href="index.php?page=lstserpents"><button type="" class="btn btn-success mx-auto">Entrez</button></a>
    </div>
    <div class="choixAccueil">
        <h3>Funérarium</h3>
        <a href="index.php?page=funerarium"><img class="imgAccueil" src="images/SnakeNecropolis.png" alt="Nécropole pour les serpents"></a>
        <p class="textAccueil">Nous conservons une trace de tous nos serpents.<br/>
        Venez vous recueillir devant la tombe de nos défunts.</p>
        <a href="index.php?page=funerarium"><button type="" class="btn btn-success mx-auto">Entrez</button></a>
    </div>
    <div class="choixAccueil">
        <h3>Reproductarium</h3>
        <a href="index.php?page=reproductarium&id=new"><img class="imgAccueil" src="images/snakeInLove.png" alt="Salle de reproduction pour les serpents"></a>
        <p class="textAccueil">Nos serpents peuvent s'accoupler.<br/>
        Entrez et faites votre choix.</p>
        <a href="index.php?page=reproductarium&id=new"><button type="" class="btn btn-success mx-auto">Entrez</button></a>
    </div>
</div>

