class Piece{

	init(){
		this.posX = 0;
		this.posY = 4;
		this.typepiece;
		this.piece = [];
		this.generationAleatoire();
	}

	generationAleatoire(){

		for(var i = 1;i<=10;i++)
		{
			
			switch (this.getRandomInt(7)) {
				case 0:
					this.typepiece = new Carre(3);
					this.piece.push(this.typepiece);
				    break;
			    case 1:
			    	this.typepiece = new Ligne(6);
					this.piece.push(this.typepiece);
				    break;
				case 2:
					this.typepiece = new S(1);
					this.piece.push(this.typepiece);
				    break;
				case 3:
					this.typepiece = new J(5);
					this.piece.push(this.typepiece);
				    break;
				case 4:
					this.typepiece = new L(7);
					this.piece.push(this.typepiece);
				    break;
				case 5:
					this.typepiece = new T(4);
					this.piece.push(this.typepiece);
				    break;
				case 6:
					this.typepiece = new Z(2);
					this.piece.push(this.typepiece);
				    break;
			}
			
		}

	}

	getRandomInt(max) {
	  return Math.floor(Math.random() * max);
	}

	translationgauche(){
		this.posY--;
	}

	translationdroite(){
		this.posY++;
	}

	rotation() {
        var mRotated = this.piece[0].masque;
        //transposée du masque
        for (var i = 0; i < this.piece[0].taille; i++)
        {
            for (var j = i; j < this.piece[0].taille; j++)
            {
                var temp = mRotated[i][j];
                mRotated[i][j] = mRotated[j][i];
                mRotated[j][i] = temp;
            }    
        }

        //inversion
        for (var i = 0; i < this.piece[0].taille; i++)
        {
            mRotated[i].reverse();
        }

        this.masque = mRotated;
       
    }

    descente() {
    	this.posX++;
    }

    nouvellepiece(){
    	for(var i = 1;i<10;i++)
		{
			this.piece[i-1] = this.piece[i];
		}
		this.piece.pop();
		switch (this.getRandomInt(7)) {
			case 0:
				this.typepiece = new Carre(3);
				this.piece.push(this.typepiece);
			    break;
		    case 1:
			   	this.typepiece = new Ligne(6);
				this.piece.push(this.typepiece);
			    break;
			case 2:
				this.typepiece = new S(1);
				this.piece.push(this.typepiece);
			    break;
			case 3:
				this.typepiece = new J(5);
				this.piece.push(this.typepiece);
			    break;
			case 4:
				this.typepiece = new L(7);
				this.piece.push(this.typepiece);
			    break;
			case 5:
				this.typepiece = new T(4);
				this.piece.push(this.typepiece);
			    break;
			case 6:
				this.typepiece = new Z(2);
				this.piece.push(this.typepiece);
			    break;
		}
    }
}