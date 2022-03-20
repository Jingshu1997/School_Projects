class Carre{
	constructor(couleur){
		this.couleur = couleur;
		this.taille = 2;
		this.masque = [[1,1],[1,1]]; 
	}
}

class Ligne{

	constructor(couleur){
		this.couleur = couleur;
		this.taille = 4;
		this.masque = [[1,1,1,1],[0,0,0,0],[0,0,0,0],[0,0,0,0]]; 
	}
}

class S{

	constructor(couleur){
		this.couleur = couleur;
		this.taille = 3;
		this.masque = [[0,1,1],[1,1,0],[0,0,0]]; 
	}
}

class J{

	constructor(couleur){
		this.couleur = couleur;
		this.taille = 3;
		this.masque = [[0,0,1],[1,1,1],[0,0,0]];
	}
}

class L{

	constructor(couleur){
		this.couleur = couleur;
		this.taille = 3;
		this.masque = [[1,0,0],[1,1,1],[0,0,0]];  
	}
}

class T{

	constructor(couleur){
		this.couleur = couleur;
		this.taille = 3;
		this.masque = [[0,1,0],[1,1,1],[0,0,0]]; 
	}
}

class Z{

	constructor(couleur){
		this.couleur = couleur;
		this.taille = 3;
		this.masque = [[1,1,0],[0,1,1],[0,0,0]]; 
	}
}

class None{
	constructor(couleur){
		this.couleur = couleur;
		this.taille = 3;
		this.masque = [[0,0,0],[0,0,0],[0,0,0]]; 
	}
}