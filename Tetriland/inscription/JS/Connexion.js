// Redirige vers la page d'accueil au click du bouton "Retour"
$("#accueil").click(function()
{
    document.location.href="../menu/accueil.php"; 
});

$('#buttonConnexion').click(function(){
	var pseudo = $('#pseudo').val();
	var mdp = $('#mdp').val();

	$.ajax({
			url: 'verifConnexion.php',
			type: 'POST',
			dataType: 'html',
			data: {'function' : 'verifConnexion', 'pseudo': pseudo, 'mdp': mdp},
			success: function(resultat, statut) {

				if(JSON.parse(resultat) == 'Connexion autorisee')
				{
					document.location.href = '../menu/accueil.php';
				}
				else
				{
					$('#resultatConnexion').text(resultat);
				}
			},
			error: function(resultat, statut, erreur) {
				console.log(resultat);
				console.log(statut);
				console.log(erreur);
			}
	    });
});