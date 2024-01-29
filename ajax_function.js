/*----------------------------------------------------------------------------------------------
Affichage en-tête tableau des serpents vivants
----------------------------------------------------------------------------------------------*/
$(".nomColTabAlive").load("components/tabHeadAlive.html");


/*----------------------------------------------------------------------------------------------
Affichage en-tête tableau des serpents morts
----------------------------------------------------------------------------------------------*/
$(".nomColTabDead").load("components/tabHeadDead.html");


/*----------------------------------------------------------------------------------------------
Affichage liste des serpents vivants
----------------------------------------------------------------------------------------------*/

$(document).ready(function(){

    let currentPage = $("#currentPage").val();
    let parPage = $("#parPage").val();
    let premier = $("#premier").val();

    affichTabAllSnake(currentPage, parPage, premier);

    function affichTabAllSnake(currentPage, parPage, premier){
        $("#listSnakAlive").load("components/snakeAliveList.php",{
            currentPage: currentPage,
            parPage: parPage,
            premier: premier
        });
        }
    })

/*----------------------------------------------------------------------------------------------
Affichage liste des serpents morts
----------------------------------------------------------------------------------------------*/

$(document).ready(function(){
    let currentPage = $("#currentPage").val();
    let parPage = $("#parPage").val();
    let premier = $("#premier").val();
$("#listSnakDead").load("components/snakeDeadList.php", {
    currentPage: currentPage,
    parPage: parPage,
    premier: premier
});
})

/*----------------------------------------------------------------------------------------------
Récupération de l'id_Race pour randomDeath dans la création d'un seul serpent 
----------------------------------------------------------------------------------------------*/

$(document).ready(function(){
    $("#affichRace").on("change", function(){
        sendValueIdRace($(this).val());
    });
function sendValueIdRace(raceValue){
    $.ajax({
        type:"POST",
        data: {
            valeur_recup : raceValue
        },
        success: function(data){
            document.getElementById("raceValue").value = data;
        }
    })
}
})

/*----------------------------------------------------------------------------------------------
Filtres
----------------------------------------------------------------------------------------------*/
let boutonsPagination=document.querySelector(".boutonsPagination");

// filtre serpentarium
$(document).ready(function(){
    $("#genderFilter, #raceFilter").on("change", function(){
        let genderFilter = $('#genderFilter').val();
        let raceFilter = $('#raceFilter').val();
        let currentPage = $("#currentPage").val();
        let parPage = $("#parPage").val();
        let premier = $("#premier").val();
        
        if((genderFilter == "" && (raceFilter  == "" || raceFilter == "all")) 
            || (genderFilter == "all" && (raceFilter  == "" || raceFilter == "all"))) {
            $("#listSnakAlive").load("components/snakeAliveList.php",{
                currentPage: currentPage,
                parPage: parPage,
                premier: premier
            });
            boutonsPagination.classList.remove("divNone");
        }else {
            console.log(genderFilter);
            console.log(raceFilter);
            affichTabFilter(genderFilter, raceFilter);
            boutonsPagination.classList.add("divNone");
        }
    })

    function affichTabFilter(genderFilter, raceFilter){
    $("#listSnakAlive").load("components/filterSnakeAlive.php", {
        genderFilter: genderFilter,
        raceFilter: raceFilter
    });
    }
})

// filtre funérarium
$("#genderFilterDead, #raceFilterDead").on("change", function(){
    let genderFilterDead = $('#genderFilterDead').val();
    let raceFilterDead = $('#raceFilterDead').val();
    // console.log(genderFilterDead);
    
    if((genderFilterDead == "" && (raceFilterDead  == "" || raceFilterDead == "all")) 
        || (genderFilterDead == "all" && (raceFilterDead  == "" || raceFilterDead == "all"))) {
        $("#listSnakDead").load("components/snakeDeadList.php",{
            currentPage: currentPage,
            parPage: parPage,
            premier: premier
        });
        boutonsPagination.classList.remove("divNone");
    }else {
        // console.log(genderFilterDead);
        // console.log(raceFilterDead);
        affichTabFilterDead(genderFilterDead, raceFilterDead);
        boutonsPagination.classList.add("divNone");
    }
})

function affichTabFilterDead(genderFilterDead, raceFilterDead){
$("#listSnakDead").load("components/filterSnakeDead.php", {
    genderFilter: genderFilterDead,
    raceFilter: raceFilterDead
});
}

/*----------------------------------------------------------------------------------------------
Reproduction
----------------------------------------------------------------------------------------------*/

function loadRace(){
    let raceChosen = $("#raceChosenForRepro").val();
    let raceTransmise = $("#raceChosenForRepro").val();
    console.log(raceChosen);

    if(raceChosen != ""){
        $("#lovers").load("components/reproduction.php", {
            raceChosen: raceChosen
        });
        document.getElementById("raceTransmise").value = raceTransmise;
    }
}

function loadParents(){
    let idSerpentMale = $("#maleByRace").val();
        let idSerpentFemale = $("#femaleByRace").val();
        let getId = $("#getId").val();
        let boutonReproVis = document.querySelector(".boutonRepro");
        console.log(idSerpentMale);
        console.log(idSerpentFemale);
        console.log(raceTransmise);
        console.log(getId);
        
        
        if(idSerpentMale != "" && idSerpentFemale !=""){
            $("#boutonRepro").load("components/reproGo.php", {
                idSerpentMale: idSerpentMale,
                idSerpentFemale : idSerpentFemale,
                raceTransmise: raceTransmise,
                getId: getId
            });
            boutonReproVis.classList.remove("divNone")
            document.getElementById("idSerpentMale").value = idSerpentMale;
            document.getElementById("idSerpentFemale").value = idSerpentFemale;
        }

}

$(document).ready(function(){
    
    $("#raceChosenForRepro").on("change", function(){
        loadRace();
    });
    $(document).on("change", "#maleByRace, #femaleByRace", function(){
        loadParents();
    });
})

