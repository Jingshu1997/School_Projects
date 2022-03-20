class ScorePartie {
	// Constructeur de la classe ScorePartie
	constructor() {
		this.score = 0; // Score initial
	}

	// Calcul le score, où tableauVide vaut true si le tableau est vide, faux sinon, ligneComplete est le nombre de ligne complété
	calculScore(ligneComplete, tableauVide) {
		if(tableauVide) {
			this.score += 10 * factorielle(5);
		} else if(ligneComplete != 0) {
			this.score += 10 * factorielle(ligneComplete);
		}
	}

	getScore(){
		return this.score;
	}

	// Affiche le score actuel du joueur dans une div dont l'id est donné en paramètre
	// affichage(id) {
	// 	document.getElementById(id).innerHTML = "Score : "+ this.score;
	// }
}

// Calcule itérativement le factorielle du nombre passé en paramètre
function factorielle(nombre) {
  // Si nbr = 0 la factorielle retournera 1
  if (nombre == 0) {
     return 1;
  }
  return nombre * factorielle(nombre - 1);
}