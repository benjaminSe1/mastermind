<?php

/**
*Classe qui gere la connection au mastermind ainsi qu'a la base de donnee
*/

require_once __DIR__."/../modele/Bd.php";
require_once 'ControleurJeu.php';
require_once __DIR__ . "/../vue/VueConnexion.php";

class ControleurAuthentification{

private $vueConnexion;
private $bd;

/**
*Constructeur de la classe
*/

function __construct(){
	$this->vueConnexion=new VueConnexion();
	$this->bd=new bd();
	$this->ctrlJeu = new ControleurJeu();
}

/**
*Fonction qui permet de générer la vueJeu de connexion
*@param dejaEssaye 
*/
function genereVueConnexion($dejaEssaye){
	$this->vueConnexion->genereVueConnexion($dejaEssaye);
}

/**
*Fonction qui permet de verifier le pseudo mdp avec le mdp de la base
*@param $pseudo le pseudo à vérifier 
*/
function verificationPseudo($pseudo){
$mdpBD = $this->bd->getMdp($_POST['pseudo']);
	if(crypt($_POST['pwd'], $mdpBD)	== $mdpBD)
	{
		$_SESSION['authentification'] = TRUE;
		$_SESSION['pseudoJoueur'] = $pseudo;
		$_SESSION['nombreDeTours'] = 0; 
		$_SESSION['ligneUtilisateur'] = array();
		$this->authentificationReussie();
	}
	else
	{
		session_unset('pseudoJoueur');
		$this->vueConnexion->genereVueConnexion(TRUE);
	}
}

function authentificationReussie(){
	$this->ctrlJeu->initialiseTabJeu(false);
}

}
?>