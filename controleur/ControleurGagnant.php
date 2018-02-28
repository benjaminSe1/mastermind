<?php

/**
*Classe qui permet de gerer les differentes interactions avec la vue gagnante
*/

require_once __DIR__ . "/../vue/VueGagnant.php";
require_once __DIR__."/../modele/Bd.php";
require_once __DIR__."/../modele/Jeu.php";

class ControleurGagnant{
  private $vueGagnant;
  private $bd;
  private $jeu;

/**
*Constructeur de la classe
*/

  Function __construct(){
    $this->vue = new vueGagnant();
    $this->bd = new Bd();
    $this->jeu = new Jeu();
  }

/**
*Fonction qui permet de faire appel à la vue gagnante avec les statistiques
*@return vue qui est la vue contenant un message de felicitation et les statistiques des différents joueurs.
*/

  Function afficherStats(){
    $tab = $this->bd->getMeilleuresParties();
    $this->vue->getVueGagnant($tab);
  }

/**
*Fonction qui permet de mettre l'etat gagnant stocker dans une variable de session à true ou false selon si
*l'utilisateur a gagne ou non
*@param $essaie la ligne de l'utilisateur
*/

  function VerifGagnant($essaie){
    if($this->jeu->Verification_Gagnant($essaie)){
      $_SESSION['gagne'] = true;
    }
  }
}
 ?>
