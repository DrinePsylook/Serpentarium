/*----------------------------------------------------------------------------------------------
Alertes création/modification bouton submit
----------------------------------------------------------------------------------------------*/
$('#reproGo').click(function()
{
    let nameSnkCreated = $('#nomHasard').val();
    let dateNaissRepro = $('#dateNaissRepro').val();
    alert(nameSnkCreated + ' est né le ' + dateNaissRepro + '.');
});

$('#changement').click(function()
{
    let nameModif = $('#nomSerpentChgmt').val();
    let creaOrModif = $('#creaOrModif').val();
    if (creaOrModif == 1){
        alert(nameModif + ' a bien été créé.');
    } else if (creaOrModif == 0){
        alert(nameModif + ' a bien été modifié.');
    }
});

$('#creaNbSerp').click(function()
{
    let nbNvSerp = $('#nbNvSerp').val();
    alert(nbNvSerp + ' nouveaux serpents ont été créés.');
});


