/*

	Process -- le tout en graphique

	1er -> plateau vide graphique
	2eme -> afficher les prochaines pieces
	3eme -> mettre la piece sur le plateau
	4eme -> faire descendre la piece sur le plateau
	Normalement, le plateau devrait être terminé

*/

/*Initialisation*/

let plateau = new ParametreJeu;

actualisergrille();

/*Faire le sac de pièces*/

let sac_piece = new Piece();

let score = new ScorePartie();

let savepiece = new None(0);

let changement = 0;

sac_piece.init();

 $.ajax({
	url: 'difficulte.php',
	type: 'POST',
	dataType: 'json',
	success: function(response, statut)
	{
	    console.log(response);

	    switch(response)
	    {
	        case 'hard' : setInterval("affichage()", 250);
	        break;

	        case 'medium' : setInterval("affichage()", 500);
	        break;

	        case 'easy' : setInterval("affichage()", 1000);
	        break;

	    }
	},
	error: function(response, statut, error)
	{
	    console.log(response);
	    console.log(error);
	}
}); 


/*On commence la boucle pour le jeu*/

function affichage(){

	sidepiece();

	save_piece();

	if(finDeplacement(getMaxPosX(getligneMasqueVideBas()), getligneMasqueVideBas())) {// on quitte la fontion car inutile d'effacer, la pièce est stoppé et on en pioche une autre
		modifscore();
		finpartie();
		pieceSuivante();
	} else {
		/*Avant d'actualiser la pièce, nous allons commencer par l'effacer de la grille*/
		effacer();
		sac_piece.posX++;

		/*Actualiser la pièce dans la grille de jeu*/
		placement();

		/*Actualiser la grille visuellement*/
		actualisergrille();
	}
}

function effacer(){
	/*Actualiser la grille de jeu*/

	for (var i = 0; i<sac_piece.piece[0].taille;i++)
	{
		for (var j = 0; j<sac_piece.piece[0].taille;j++)
		{
			if(sac_piece.posY+j < 0) {
				continue;
			}

			if(sac_piece.piece[0].masque[i][j] == 1)
			{
				plateau.Grille[sac_piece.posX+i][sac_piece.posY+j][0] = 0;
				plateau.Grille[sac_piece.posX+i][sac_piece.posY+j][1] = 0;
			}
		}
	}

}


/*Pour avoir une syntaxe plus sympa dans le code, on créé une fonction qui effectue le placement d'une pièce*/
function placement(){
	var ligneMasqueVide = getligneMasqueVideBas();
	var colonneMasqueVideGauche = getColonneMasqueVideGauche();
	var colonneMasqueVideDroite = getColonneMasqueVideDroite();
	var posXMax = getMaxPosX(ligneMasqueVide);

	/*Actualiser la grille de jeu*/

	for (var i = 0; i<sac_piece.piece[0].taille - ligneMasqueVide; i++)
	{
		for (var j = 0; j<sac_piece.piece[0].taille - colonneMasqueVideDroite; j++)
		{
			if(sac_piece.posY + j < 0) {
				continue;
			}
			/*Le if suivant sert à afficher seulement dans la bonne couleur les cases composant la pièce*/

			if(sac_piece.piece[0].masque[i][j] == 1)
			{
				plateau.Grille[sac_piece.posX + i][sac_piece.posY + j][0] = 1;
				plateau.Grille[sac_piece.posX+i][sac_piece.posY+j][1] = sac_piece.piece[0].couleur;
			}
		}
	}
}

function actualisergrille(){

	/*On doit dans un premier temps retirer l'ancienne grille*/
	$("#plateaujeu").html("");

	for (var i = 0; i<plateau.ligne;i++)
	{
	
		$("#plateaujeu").append("<div class=\"ligne\" id=\"ligne_"+i+"\"><div>");
		
		for( var j = 0; j<plateau.colonne;j++)
		{
			if(i<=3)
			{
				$("#ligne_"+i).append("<div class=\"premiere "+plateau.Grille[i][j][1]+"\"  id=\"case\"> </div>");
			}
			else
			{
				$("#ligne_"+i).append("<div class="+plateau.Grille[i][j][1]+" id=\"case\"> </div>");
			}
		}
	}
}


function save_piece()
{
	$("#savepiece").html("Pièce sauvegardée : ");

	$("#savepiece").append("<div class=\"sauvegarde\"> </div>");
		
	for (var j = 0; j<savepiece.taille;j++)
	{
		$(".sauvegarde").append("<div class=\"lignepiece\" id=\"lignepiece_"+j+"\"><div>");
		for (var k = 0; k<savepiece.taille;k++)
		{
			/*Le if suivant sert à afficher seulement dans la bonne couleur les cases composant la pièce*/
			if(savepiece.masque[k][j] == 1)
			{
				$("#lignepiece_"+j).append("<div class='"+savepiece.masque[k][j]+" "+savepiece.couleur+"' id=\"case\"> </div>");
			}
			else
			{
				$("#lignepiece_"+j).append("<div class='"+savepiece.masque[k][j]+" 0' id=\"case\"> </div>");
			}
		}
	}

}

function sidepiece(){

	/*On doit d'abord retirer l'ancien affichage*/
	$("#side").html("");

	$("#side").append("<div class=\"score\" > Score actuel = "+ score.getScore() + "</div>");

	for( var i = 1; i <= 3;i++)/*Afficher les 3 avant-dernières pièces car la dernière est sur le plateau*/
	{
		$("#side").append("<div class=\"futurepiece\" id=\"piece_"+i+"\"> </div>");
		
		for (var j = 0; j<sac_piece.piece[i].taille;j++)
		{
			$("#piece_"+i).append("<div class=\"lignepiece\" id=\"lignepiece_"+i+j+"\"><div>");
			for (var k = 0; k<sac_piece.piece[i].taille;k++)
			{
				/*Le if suivant sert à afficher seulement dans la bonne couleur les cases composant la pièce*/
				if(sac_piece.piece[i].masque[k][j] == 1)
				{
					$("#lignepiece_"+i+j).append("<div class='"+sac_piece.piece[i].masque[k][j]+" "+sac_piece.piece[i].couleur+"' id=\"case\"> </div>");
				}
				else
				{
					$("#lignepiece_"+i+j).append("<div class='"+sac_piece.piece[i].masque[k][j]+" 0' id=\"case\"> </div>");
				}
			}
		}
	}

}







// Fonction permettant le déplacement des pièces et détection des collisions

// Retourne le nombre de ligne vide dans le masque en partant du bas
function getligneMasqueVideBas() {
	var ligneMasqueVide = 0;

	for(var i = sac_piece.piece[0].taille - 1; i >= 0; i--) {
		var compteur = 0;
		for(var j = 0; j < sac_piece.piece[0].taille; j++) {
			if(sac_piece.piece[0].masque[i][j] == 0)
				compteur++;
		}

		if(compteur == sac_piece.piece[0].taille)
			ligneMasqueVide++;

		// pas besoin de chercher au dessus
		if(ligneMasqueVide == 0)
			break;
	}

	return ligneMasqueVide;
}

// Retourne la hauteur maximale à laquelle peut se trouver la positionX de la piece
function getMaxPosX(ligneMasqueVide) {
	return plateau.ligne - sac_piece.piece[0].taille + ligneMasqueVide;
}


// Fonction retournant vrai si la piece ne peut plus descendre, ie elle touche le sol ou une piece
function finDeplacement(posXMax, nombreLigneVide) {
	// Pièce en bas
	if(sac_piece.posX == posXMax) {
		return true;
	}

	// Collision avec une autre pièce
	for(var i = sac_piece.piece[0].taille - 1; i >= 0; i--) {
		for(var j = 0; j < sac_piece.piece[0].taille; j++) {
			if(sac_piece.posY + j < 0)
				continue;
			else if (sac_piece.posY + j > plateau.colonne)
				break;

			if(sac_piece.piece[0].masque[i][j] == 1 && plateau.Grille[sac_piece.posX + i + 1][sac_piece.posY + j][0] == 1) {
				if(i == sac_piece.piece[0].taille - 1) { //on est à la dernière ligne
					return true;
				} else if(sac_piece.piece[0].masque[i + 1][j] == 0) { // sinon on vérifie que la case de la grille est pleine (elle l'est à cause dela pièce)
					return true;
				}
			}
		}
	}

	return false;
}

// Retourne le nombre de colonne vide dans le masque en partant de la gauche
function getColonneMasqueVideGauche() {
	var colonneMasqueVide = 0;

	for(var i = 0; i < sac_piece.piece[0].taille; i++) {
		var compteur = 0;
		for(var j = 0; j < sac_piece.piece[0].taille; j++) {
			if(sac_piece.piece[0].masque[j][i] == 0)
				compteur++;
		}

		if(compteur == sac_piece.piece[0].taille)
			colonneMasqueVide++;

		// pas besoin de chercher au dessus
		if(colonneMasqueVide == 0)
			break;
	}

	return colonneMasqueVide;
}

function deplacementGauche() {
	if(sac_piece.posY == -getColonneMasqueVideGauche()) {
		return false;
	}

	for(var i = 0; i < sac_piece.piece[0].taille; i++) {
		for(var j = 0; j < sac_piece.piece[0].taille; j++) {
			if(sac_piece.posY + j - 1 < 0)
				continue;

			if(sac_piece.piece[0].masque[i][j] == 1 && plateau.Grille[sac_piece.posX + i][sac_piece.posY + j - 1][0] == 1) {
				if(j == 0) { // on est à la première ligne du masque
					return false;
				} else if(sac_piece.piece[0].masque[i][j - 1] == 0) { // sinon on vérifie que la case de la grille est pleine (elle l'est à cause de la pièce)
					return false;
				}
			}

		}
	}

	return true;
}

// Retourne le nombre de colonne vide dans le masque en partant de la droite
function getColonneMasqueVideDroite() {
	var colonneMasqueVide = 0;

	for(var i = sac_piece.piece[0].taille - 1; i >= 0; i--) {
		var compteur = 0;
		for(var j = 0; j < sac_piece.piece[0].taille; j++) {
			if(sac_piece.piece[0].masque[j][i] == 0)
				compteur++;
		}

		if(compteur == sac_piece.piece[0].taille)
			colonneMasqueVide++;

		// pas besoin de chercher au dessus
		if(colonneMasqueVide == 0)
			break;
	}

	return colonneMasqueVide;
}

// Retourne la hauteur maximale à laquelle peut se trouver la positionX de la piece
function getMaxPosY(colonneMasqueVide) {
	return plateau.colonne - sac_piece.piece[0].taille + colonneMasqueVide;
}

function deplacementDroite() {
	if(sac_piece.posY == getMaxPosY(getColonneMasqueVideDroite())) {
		return false;
	}

		for(var i = 0; i < sac_piece.piece[0].taille; i++) {
			for(var j = sac_piece.piece[0].taille - 1; j >= 0 ; j--) {
				if (sac_piece.posY + j > plateau.colonne)
					break;

				if(sac_piece.piece[0].masque[i][j] == 1 && plateau.Grille[sac_piece.posX + i][sac_piece.posY + j + 1][0] == 1) {
					if(j == sac_piece.piece[0].taille - 1) { //on est à la dernière colonne
						return false;
					} else if(sac_piece.piece[0].masque[i][j + 1] == 0) { // sinon on vérifie que la case de la grille est pleine (elle l'est à cause dela pièce)
						return false;
					}
				}
			}
		}

	return true;
}





// Fonction passant à la piece suivante dans le sac
function pieceSuivante() {
	sac_piece.posX = 0;
	sac_piece.posY = 4;
	changement = 0;
	sac_piece.nouvellepiece();
}

//Gestion du score
function modifscore(){
    var lignecomplete=0;
    for (var i = 0; i<plateau.ligne;i++)
    {
        if (plateau.VerifLigne(i)) {
            lignecomplete++;
            for(var k = i; k >= 1; k--) {
	            for (var j = 0; j<plateau.colonne; j++) {
	                plateau.Grille[k][j][0] = plateau.Grille[k-1][j][0];
	                plateau.Grille[k][j][1] = plateau.Grille[k-1][j][1];
	            }    
	         }
        }
    }
    score.calculScore(lignecomplete, plateau.VerifGrilleVide() );
    console.log(score.score);
}

function finpartie(){
        if (sac_piece.posX < 5) {
            $.ajax({
		            url: 'connectbdd.php',
		            type: 'POST',
		            data: {function: 'saveScore', 'score': score.score},
		            dataType: 'json',
		            success: function(response, statut)
		            {
		                console.log(response);
		                document.location.href="../menu/finpartie.php"; 
		            },
		            error: function(response, statut, error)
		            {
		                console.log(response);
		                console.log(error);
		            }
	            });  
        }
}




/*Gestion des inputs de type clavier*/

document.onkeydown = checkKey;

function checkKey(e) {

    e = e || window.event;

    if (e.keyCode == '38') {/*Fleche du haut*/
    	
    	effacer();
    	sac_piece.rotation();

    	if(sac_piece.posY > getMaxPosY(getColonneMasqueVideDroite()))
    		sac_piece.posY = getMaxPosY(getColonneMasqueVideDroite());
    	else if(sac_piece.posY < -getColonneMasqueVideGauche())
    		sac_piece.posY = -getColonneMasqueVideGauche();

    	if(sac_piece.posX < 0)
    		sac_piece.posX = 0;
    	else if(sac_piece.posX > getMaxPosX(getligneMasqueVideBas()))
    		sac_piece.posX = getMaxPosX(getligneMasqueVideBas());

		placement();
		actualisergrille();
    	
    }
    else if (e.keyCode == '40') {/*Fleche du bas*/
    	if(finDeplacement(getMaxPosX(getligneMasqueVideBas()), getligneMasqueVideBas())) {// on quitte la fontion car inutile d'effacer, la pièce est stoppé et on en pioche une autre
			modifscore();
			finpartie();
			pieceSuivante();
		} else {
			effacer();
		    sac_piece.descente();
		    placement();
		    actualisergrille();
	    }
    }
    else if (e.keyCode == '37') {/*Fleche de gauche*/
    	if(deplacementGauche()) {
    		 effacer();
		     sac_piece.translationgauche();
		     placement();
		     actualisergrille();
	   }
    }
    else if (e.keyCode == '39') {/*Fleche de droite*/
    	if(deplacementDroite()) {
    		effacer();
	       	sac_piece.translationdroite();
	       	placement();
	       	actualisergrille();
    	}
    } else if (e.keyCode == '32') { /*Espace*/
    	while(!finDeplacement(getMaxPosX(getligneMasqueVideBas()), getligneMasqueVideBas())) {
    		effacer();
    		sac_piece.descente();
    		placement();
		    actualisergrille();
    	}

		modifscore();

    	// Vérification partie fini
		finpartie();
		pieceSuivante();
    } else if (e.keyCode == '16') { /*left shift*/

    	if(savepiece.constructor.name == "None")
    	{
    		effacer();

    		switch(sac_piece.piece[0].constructor.name)
    		{
    			case "Carre":
    				savepiece = new Carre(sac_piece.piece[0].couleur);
    				break;
    			case "Ligne":
    				savepiece = new Ligne(sac_piece.piece[0].couleur);
    				break;
    			case "S":
    				savepiece = new S(sac_piece.piece[0].couleur);
    				break;
    			case "J":
    				savepiece = new J(sac_piece.piece[0].couleur);
    				break;
    			case "L":
    				savepiece = new L(sac_piece.piece[0].couleur);
    				break;
    			case "T":
    				savepiece = new T(sac_piece.piece[0].couleur);
    				break;
    			case "Z":
    				savepiece = new Z(sac_piece.piece[0].couleur);
    				break;
    		}

    		pieceSuivante();
    	}

    	else if(changement == 0)
    	{
    		let temp;

    		effacer();

    		switch(sac_piece.piece[0].constructor.name)
    		{
    			case "Carre":
    				temp = new Carre(sac_piece.piece[0].couleur);
    				break;
    			case "Ligne":
    				temp = new Ligne(sac_piece.piece[0].couleur);
    				break;
    			case "S":
    				temp = new S(sac_piece.piece[0].couleur);
    				break;
    			case "J":
    				temp = new J(sac_piece.piece[0].couleur);
    				break;
    			case "L":
    				temp = new L(sac_piece.piece[0].couleur);
    				break;
    			case "T":
    				temp = new T(sac_piece.piece[0].couleur);
    				break;
    			case "Z":
    				temp = new Z(sac_piece.piece[0].couleur);
    				break;
    		}

    		switch(savepiece.constructor.name)
    		{
    			case "Carre":
    				sac_piece.piece[0] = new Carre(savepiece.couleur);
    				break;
    			case "Ligne":
    				sac_piece.piece[0] = new Ligne(savepiece.couleur);
    				break;
    			case "S":
    				sac_piece.piece[0] = new S(savepiece.couleur);
    				break;
    			case "J":
    				sac_piece.piece[0] = new J(savepiece.couleur);
    				break;
    			case "L":
    				sac_piece.piece[0] = new L(savepiece.couleur);
    				break;
    			case "T":
    				sac_piece.piece[0] = new T(savepiece.couleur);
    				break;
    			case "Z":
    				sac_piece.piece[0] = new Z(savepiece.couleur);
    				break;
    		}

    		switch(temp.constructor.name)
    		{
    			case "Carre":
    				savepiece = new Carre(temp.couleur);
    				break;
    			case "Ligne":
    				savepiece = new Ligne(temp.couleur);
    				break;
    			case "S":
    				savepiece = new S(temp.couleur);
    				break;
    			case "J":
    				savepiece = new J(temp.couleur);
    				break;
    			case "L":
    				savepiece = new L(temp.couleur);
    				break;
    			case "T":
    				savepiece = new T(temp.couleur);
    				break;
    			case "Z":
    				savepiece = new Z(temp.couleur);
    				break;
    		}


    		sac_piece.posX = 0;
			sac_piece.posY = 4;
			changement = changement+1;


    	}

    }
}