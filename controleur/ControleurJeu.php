<?php

/**
*Classe qui permet de gerer les differentes interaction avec le plateau du jeu mastermind
*/

require_once __DIR__ . "/../vue/Vue.php";
require_once __DIR__ . "/../vue/VuePerdant.php";
require_once __DIR__."/../modele/Bd.php";
require_once __DIR__."/../modele/Jeu.php";
require_once __DIR__."/../controleur/ControleurGagnant.php";

class ControleurJeu{

private $vue;
private $vuePerdant;
private $bd;
private $jeu;
private $vueGagnant;
private $controleurGagnant;




/**
*Constructeur de la classe
*/

function __construct(){
  $this->vue=new Vue();
	$this->vuePerdant=new VuePerdant();
	$this->bd=new bd();
	$this->jeu = new jeu();
	$this->controleurGagnant = new controleurGagnant();
  if(!isset($_SESSION['tabJeu'])){
    $_SESSION['tabJeu'] = array();
    for($i = 0; $i < 10; $i++){
      $_SESSION['tabJeu'][$i] = array();
    }
  }

  if(!isset($_SESSION['tabVerif'])){
    $_SESSION['tabVerif'] = array();
    for($i = 0; $i < 10; $i++){
      $_SESSION['tabVerif'][$i] = array();
    }
  }

  if(!isset($_SESSION['ligneUtilisateur'])){
    $_SESSION['ligneUtilisateur']=array();
  }

  if(!isset($_SESSION['nombreDeTours'])){
    $_SESSION['nombreDeTours']=0;
  }
}

/**
*Fonction qui permet d'ajouter un pion dans une ligne
*@param $pion qui represente le pion ajoute par l'utilisateur
*@return le pion ajoute
*/

function ajoutPionLigne($pion){
  array_push($_SESSION['ligneUtilisateur'], $pion);
   for($i = 0; $i < 10; $i++){
    if(count($_SESSION['tabJeu'][$i]) < 4){
      array_push($_SESSION['tabJeu'][$i], $pion);
      return;
    }
   }
  }


/**
*Fonction qui permet de supprimer un pion
*@return le pion supprime
*/

function deletePionLigne(){
  for($i = 0; $i < 10; $i++){
    if(count($_SESSION['tabJeu'][$i]) < 4){
      unset($_SESSION['tabJeu'][$i][count($_SESSION['tabJeu'][$i])-1]);
      return;
    }
   }
}

  function getTabJeu(){
    return $_SESSION['tabJeu'];  
  }

/**
*Fonction qui met à jour les pions dans le tableau de jeu
*@return vue qui est la vue du jeu
*/

function majJeuPion(){
  $this->ajoutPionLigne($_SESSION['pionJoueur']);
  //si la ligne de pions est complete on va réaliser tout le traitement
  if(count($_SESSION['ligneUtilisateur']) == 4 && $_SESSION['nombreDeTours'] < 10){

    $reponseUtilisateur = $_SESSION['ligneUtilisateur'];
    //on va sauvegarder la ligne de pions dans la classe jeu
    $this->jeu->setEssaie($reponseUtilisateur);

    //on récupère le tabVerif
    $tabVerif = $this->jeu->getTabVerif($reponseUtilisateur);

    //on incrément le nombre de tours
    $_SESSION['nombreDeTours']++;

    //on réinitiamlise la ligne de pion
    $_SESSION['ligneUtilisateur'] = array();

    //on vérifie si la ligne courante est identique à la solution
    $this->controleurGagnant->VerifGagnant($reponseUtilisateur);

    //on génère la vue avec tabJeu qui contient tous les pions des lignes précedentes et courantes.
    $tabJeu = $this->getTabJeu();
    $this->vue->genereVueJeu($tabJeu, $tabVerif);
  }
  //sinon on affiche seulement le tableaux de jeu sans toutes les vérifications
  else if(count($_SESSION['ligneUtilisateur']) < 4 && $_SESSION['nombreDeTours'] < 10){
    //
    $this->vue->genereVueJeu($this->getTabJeu(), array("", "", "", ""));
  }else{
    $_SESSION['perdu'] = true;
  }
}

/**
*Fonction qui initialise la tableau de jeu et la vue
*@param regame si regame est à oui, le joueur a donc appuyé sur "regame" 
*et on va reinitialiser ou effacer toutes les variable de jeu 
*/

function initialiseTabJeu($regame){
  if($regame)
  {
    if(isset($_SESSION['tabJeu'])){
      session_unset('tabJeu');
    }
    if(isset($_SESSION['pionJoueur'])){
      session_unset('pionJoueur');
    }
    if(isset($_SESSION['nombreDeTours'])){
      $_SESSION['nombreDeTours'] = 0;
    }
     if(isset($_SESSION['solution'])){
      session_unset('solution');
    }
  }
$this->vue->genereVueJeu(array("", "", "", ""), array("", "", "", ""));
}


/**
*Fonction qui delete un pion si la ligne courante est contient au moins un pion et n'est pas complete
*@return vue qui represente la vue du jeu sans le pion que l'utilisateur a decide d'enlever
*/

function deletePion(){
  //si la ligne courante n'est pas vide et n'est pas complète
  if(count($_SESSION['ligneUtilisateur']) > 0 &&  count($_SESSION['ligneUtilisateur']) < 4){
    //on enleve le dernier pion de la ligne
    unset($_SESSION['ligneUtilisateur'][count($_SESSION['ligneUtilisateur'])-1]);
    //on enleve le pion du tableJeu
    $this->deletePionLigne();
    //on regénère la vue
    $this->vue->genereVueJeu($this->getTabJeu(), array("", "", "", ""));
  }else{
    //sinon on regénère la vue, inchangée
    $this->vue->genereVueJeu($this->getTabJeu(), array("", "", "", ""));
  }
}


function getVuePerdant(){
  $this->vuePerdant->getVuePerdant();
}

}
