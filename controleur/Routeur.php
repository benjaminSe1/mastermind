<?php

require_once 'ControleurAuthentification.php';
require_once 'ControleurJeu.php';
require_once 'ControleurGagnant.php';

/**
*Classe routeur qui permet de gerer l'ensemble des interactions entre les differents controleur et les variables de session
*/

class Routeur {

	private $ctrlAuthentification;
	private $ctrlJeu;
	private $ctrlGagnant;

 

	public function __construct() {
		$this->ctrlAuthentification = new ControleurAuthentification();
		$this->ctrlJeu = new ControleurJeu();
		$this->ctrlGagnant = new ControleurGagnant();
	}

	// Traite une requête entrante
 	public function routerRequete()
 	{
 		//si le formulaire de connexion est soumis
 		if(isset($_POST['soumettreAuthentification']) && !isset($_POST['pionJoueur']))
 		{
 			//on sauvegarde les variables
 			$_SESSION['soumettreAuthentification'] = $_POST['soumettreAuthentification'];
 			//$_SESSION['authentification'] = FALSE;
 			$_SESSION['pseudo'] = $_POST['pseudo'];

 			//on verifie si le mot de passe lié au login est le bon
			$this->ctrlAuthentification->verificationPseudo($_SESSION['pseudo']);
		}

		//sinon si le formulaire de connexion n'est pas soumis 
		else if(!isset($_POST['soumettreAuthentification']) && !isset($_POST['pionJoueur']) && !isset($_POST['delete']) && !isset($_POST['regame']))
		{
			//on détruit la variable 'soumettreAuthentification'
			session_unset('soumettreAuthentification');

			//on affiche la vue permettant l'authentification
			$this->ctrlAuthentification->genereVueConnexion(FALSE);
		}
		//si le joueur souhaite recommencer une partie
		else if(isset($_POST['regame'])){
			//on initialise le tableau de jeu avec comme parametre true pour indiquer à la methode que c'est un regame
			$this->ctrlJeu->initialiseTabJeu(true);
		}
		//Si le joueur a cliqué sur un pion, on met à jour les données de jeu et l'affichage
		else if(isset($_POST['pionJoueur']))
		{
			$_SESSION['pionJoueur'] = $_POST['pionJoueur'];
			$this->ctrlJeu->majJeuPion();
		}
		//si le joueur clique sur le bouton delete, on delete le dernier pion de la ligne courrante
		else if(isset($_POST['delete'])){
			$this->ctrlJeu->deletePion();
		}
		/*si gagne, la page afficherStats apparait

		BUG pas corrigé : après que le joueur est entré la bonne combinaison, il faut que le joueur recharge la page pour 
		rentrer dans le if ci-dessous et affiche la bonne page
		*/
		else if(isset($_SESSION['gagne'])){
			$this->ctrlGagnant->afficherStats();
		}
		/*si perdu, la page vuePerdu apparait

		BUG pas corrigé : affcihage impossible, mauvaise condition
		*/
		else if(isset($_SESSION['perdu'])){
			$this->ctrl->getVuePerdant();
		}
	}
}
	



?>
