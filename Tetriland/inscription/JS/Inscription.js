// Redirige vers la page d'accueil au click du bouton "Retour"
$("#accueil").click(function()
{
    document.location.href="../menu/accueil.php"; 
});

$('#buttonInscription').click(function(){
	var nom = $('#nom').val();
	var prenom = $('#prenom').val();
	var pseudo = $('#pseudo').val();
	var mdp = $('#mdp').val();
	var mdp2 = $('#mdp2').val();
	var email = $('#email').val();
	var age = $('#age').val();

	$.ajax({
			url: 'verifInscription.php',
			type: 'POST',
			dataType: 'html',
			data: {'function' : 'verifNomPrenomPseudo', 'nom': nom, 'prenom': prenom, 'pseudo': pseudo},
			success: function(resultat, statut) {
				resultat = JSON.parse(resultat);

				$('#resultatNomPrenomPseudo').text(resultat["informations"]);

				var insertionBDD = resultat["insertionBDD"];

				// on passe a la requete suivante
				$.ajax({
					url: 'verifInscription.php',
					type: 'POST',
					dataType: 'html',
					data: {'function' : 'verifMdp', 'mdp': mdp, 'mdp2': mdp2, 'insertionBDD': insertionBDD},
					success: function(resultat, statut) {
						resultat = JSON.parse(resultat);
						var insertionBDD = resultat["insertionBDD"] == "true";

						$('#resultatMdp').text(resultat["informations"]);

						// on passe a la requete suivante
						$.ajax({
							url: 'verifInscription.php',
							type: 'POST',
							dataType: 'html',
							data: {'function' : 'verifEmail', 'email': email, 'insertionBDD': insertionBDD},
							success: function(resultat, statut) {
								resultat = JSON.parse(resultat);
								var insertionBDD = resultat["insertionBDD"] == "true";

								$('#resultatMdp').text(resultat["informations"]);

								// on passe a la requete suivante
								$.ajax({
									url: 'verifInscription.php',
									type: 'POST',
									dataType: 'html',
									data: {'function' : 'verifAge', 'age': age, 'insertionBDD': insertionBDD},
									success: function(resultat, statut) {
										resultat = JSON.parse(resultat);
										var insertionBDD = resultat["insertionBDD"] == "true";

										$('#resultatMdp').text(resultat["informations"]);
										console.log(insertionBDD);

										if(insertionBDD) {
											$.ajax({
												url: 'verifInscription.php',
												type: 'POST',
												dataType: 'html',
												data: {'function' : 'insertionNouvelUtilisateur', 'nom': nom, 'prenom': prenom, 'pseudo': pseudo, 'mdp': mdp, 'email': email, 'age': age},
												success: function(resultat, statut) {
													console.log(resultat);

													document.location.href = '../menu/accueil.php';
												},
												error: function(resultat, statut, erreur) {
													console.log(resultat);
													console.log(statut);
													console.log(erreur);
												}
											});
										}
									},
									error: function(resultat, statut, erreur) {
										console.log(resultat);
										console.log(statut);
										console.log(erreur);
									}
								});
							},
							error: function(resultat, statut, erreur) {
								console.log(resultat);
								console.log(statut);
								console.log(erreur);
							}
						});
					},
					error: function(resultat, statut, erreur) {
						console.log(resultat);
						console.log(statut);
						console.log(erreur);
					}
				});
			},
			error: function(resultat, statut, erreur) {
				console.log(resultat);
				console.log(statut);
				console.log(erreur);
			}
	    });
});