<?php 
/**
*class principale de vue qui permet l'affichage en cours de jeu et qui contient les fonctions UtilHtml utilisables dans toutes le vues.
*elle contient 3 types de fonctions:
*-les fonctions que l'on va appeler des classes exterieurs propre à la vue du jeu
*-les fonctions "util" que l'on va appeler des autres vues
*-les fonctions interne à la vue du jeu qui ne seront pas appelées de l'extérieur
*/

class Vue{

//---------------------------------------Fonction appelée à l'exterieur----------------------------------------------

/**
*Fonction qui permet d'afficher la vue du jeu avec les deux tableaux, celui des pions du joueur et celui des pions indicateurs
*ainsi que les differents partie de la page tel que l'en tête et le barre de navigation
*@param $tab qui represente le tableau de tous les pions du joueur
*@param $tabverif qui represente le tableau de tous les pions de verification
*/

function genereVueJeu($tab, $tabVerif){
	$this->genereHeader("vueJeux");
	$this->genereNavBar();
	$this->genereTableauJeu($tab, $tabVerif);
	$tabPions = array("green", "yellow", "red", "blue", "pink", "purple", "orange", "grey");
	$this->afficherBoutonsJeu($tabPions);
}

//---------------------------------------Fin Fonction appelée à l'exterieur----------------------------------------------





//---------------------------------------Fonction appelée à seulement dans la classe Vue----------------------------------------------

		//---------------------------------------Fonction utilHTML Générale----------------------------------------------

/**
*Fonction qui permet d'afficher l'en-tete de la page
*@param $nomFile le nom de la vue qui necessite cette en-tete
*/
		function genereHeader($nomFile)
		{
			echo '<!DOCTYPE html>
			<html>
			<head>
			<meta charset="utf-8">
			<title>Mastermind</title>
			<link rel="stylesheet" href="vue/css/'.$nomFile.'.css">
			</head>';
		}

		function genereNavBar()
        {
        echo '
        <div class="nav">
	        <ul>
		        <li class="Deconnexion"><a href="index.php">Déconnexion</a></li>
	        </ul>
        </div>
        <form method="POST" action="index.php">
        	<input type="submit" name="regame" value="Regame">
        </form>

        ';

        }


		//---------------------------------------Fin Fonction utilHTML Générale----------------------------------------------



		//---------------------------------------Fonction utilHTML propre à la vue du jeu----------------------------------------------


/**
*Fonction qui permet de recuperer le plateau de jeu contenant les deux tableaux (avec pion joueur et avec pion verification)
*@param $tab qui represente le tableau de tous les pions du joueur
*@param $tabverif qui represente le tableau de tous les pions de verification
*/

		function genereTableauJeu($tab, $tabVerif){
			$this->creerTabJeu($tab, $tabVerif);
		}

/**
*Fonction qui permet de creer le plateau de jeu contenant les deux tableau (avec pion joueur et avec pion verification)
*@param $tab qui represente le tableau de tous les pions du joueur
*@param $tabverif qui represente le tableau de tous les pions de verification
*/

		function creerTabJeu($tab, $tabVerif){ 
			echo '<table class="tabjeux">';
			for($j = 0; $j<count($tab); $j++)
		    {
		      echo '<tr>';
		      for($i = 0; $i<4; $i++)
		      {
		      	if(isset($tab[$j][$i]))
		      	{
		       		echo '<td bgcolor="'.$tab[$j][$i].'" class="grandrond"></td>';
		    	}
		    	else
		 		{
		       		echo '<td bgcolor="" class="grandrond"></td>';
		    	}
		      }
		      echo '<td>';
		      if($j <= count($tab)){$this->creerTabVerif($tabVerif);} //Ici on change le style des petitrond
		      echo '</td>';
		      echo '</tr>';
		   	}

		    for($k = count($tab); $k<10; $k++)
		    {
		      echo '<tr>';
		      for($l = 0; $l<4; $l++)
		      {
		        echo '<td bgcolor="" class="grandrond"></td>';
		      }
		      echo '<td>';
		      echo '</td>';
		      echo '</tr>';
		   	}
		   	echo '</table>';
		}

/**
*Fonction qui permet de creer le tableau de verification des pions
*@param $tabverif qui represente le tableau de tous les pions de verification
*/

		function creerTabVerif($tabVerif){ 
		  echo '<table>';
		  for($j = 0; $j<2; $j++)
		  {
		    echo '<tr></tr>';
		    for($i = 0; $i<2; $i++)
		    {
		    	if(isset($tabVerif[$i]))
		      	{
		        	echo '<td bgcolor="'.$tabVerif[$i].'" class="petitrond"></td>';
		    	}
		    	else
		 		{
		        	echo '<td bgcolor="" class="petitrond"></td>';
		    	}
		    }
		  }
		  echo '</table>';
		}

/**
*Fonction qui permet d'afficher les boutons de couleurs sur lesquels l'utilisateur pourra interragir pour
*placer ses pions
*@param $tab qui représente le tableau des pions de l'utilisateur
*/

		function afficherBoutonsJeu($tab){
			echo'<form style="position:relative; top:-500px;"action="index.php" method="POST">';
			
			for($i = 0; $i < sizeof($tab); $i++)
			{
				echo '<input style="background-color: '.$tab[$i].' ; color:'.$tab[$i].'; cursor:"pointer" class="petitRondSelection" name ="pionJoueur" type="submit" value="'.$tab[$i].'"></input>';
			}
			echo
			'<form style="position:relative; top:-500px;"action="index.php" method="POST">
				<input name="delete" cursor:"pointer" type="submit" value="delete"></input>
			</form>';
		}

		//---------------------------------------Fin Fonction utilHTML propre à le vue du jeu----------------------------------------------

}
?>
