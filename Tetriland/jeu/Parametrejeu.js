class ParametreJeu
{
	constructor()
	{
		 this.ligne = 20;
		 this.colonne = 10;
		 this.Grille = new Array(20)

		for( var i = 0;i<this.ligne;i++)
        {
           this.Grille[i] = new Array(10);

           for(var j = 0; j<this.colonne;j++)
           {
           	this.Grille[i][j] = new Array(2);
           	this.Grille[i][j] = [0,0];
           }
        }

        
	}

	AfficherGrille() /*Affichage binaire du plateau*/
        {

	        for (var i = 0; i<this.ligne;i++)
	        {
	            for( var j = 0; j<this.colonne;j++)
	           {
	            document.write(this.Grille[i][j][0]);
	           }
	           document.write('<br/>');
	        }


    }

    VerifGrilleVide() 
    {

        for (var i = 0; i<this.ligne;i++)
        {
            for(var j = 0; j<this.colonne;j++)
           {
                if(this.Grille[i][j][0] == 1)
                {
                    return false;
                }
           }
           
        }
        return true;
    }


    VerifLigne(ligne) 
    {
        for (var i = 0; i<this.colonne;i++)
        {
            if(this.Grille[ligne][i][0] == 0)
            {
                return false;
            }    
        }
        return true;
        
    }
}




