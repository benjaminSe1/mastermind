<?php

/**
*Classe qui présente toutes les fonctions necessaire au deroulement du jeu
*/

class Jeu {
  private $essaie;
  private $vue;
  private $tabVerif;

/**
*Constructeur de la classe
*/

  function __construct(){
    $this->essaie =  array();
    $this->vue = new vue();
    $this->tabVerif = array();

     if(!isset($_SESSION['solution'])){
      $_SESSION['solution'] = $this->TirageAleatoire();
    }
    //ligne à décommenter si on veut afficher la solution
    //var_dump($_SESSION['solution']);
}

/**
*Fonction qui permet de changer l'essaie du joueur
*@param $essaie qui représente la ligne de l'utilisateur
*/

  function setEssaie($essaie){
    $this->essaie = $essaie;
  }

/**
*Fonction qui permet de retourner l'essaie du joueur
*@return $this->essaie qui est la ligne de l'utilisateur
*/

  function getEssaie(){
    return $this->essaie;
  }

/**
*Fonction qui permet de tirer aleatoirement quatre couleurs depuis des listes melanges et d'en former un seul
*@return $resultat qui est une liste de quatre couleur
*/

  function TirageAleatoire(){
    $couleur = array("green", "yellow", "red", "blue", "pink", "purple", "orange", "grey");

    shuffle($couleur);
    $rand_keys = array_rand($couleur, 2);
    $pion1 = $couleur[$rand_keys[0]];

    shuffle($couleur);
    $rand_keys = array_rand($couleur, 2);
    $pion2 = $couleur[$rand_keys[0]];

    shuffle($couleur);
    $rand_keys = array_rand($couleur, 2);
    $pion3 = $couleur[$rand_keys[0]];

    shuffle($couleur);
    $rand_keys = array_rand($couleur, 2);
    $pion4 = $couleur[$rand_keys[0]];

    $resultat = array("$pion1", "$pion2", "$pion3", "$pion4");
    return $resultat;
  }

/**
*Fonction qui permet de savoir si la ligne de l'utilisateur est identique à la ligne de la solution
*@param $essaie qui est la ligne de l'utilisateur
*@return un bouleen
*/

  function Verification_Gagnant($essaie){
    return $essaie === $_SESSION['solution'];
  }

/**
*Fonction qui permet de retourner une liste de pions blanc et noir, blanc representant le nombre de pions a la bonne
*place et noir representant le nombre de pions qui sont présent mais qui ne sont pas a la bonne place.
*@param $essaie qui est la ligne de l'utilisateur
*@return un tableau de longueur quatre avec dedans les mots "white" ou "black" representant le pions noir et blanc.
*/

  function getTabVerif($essaie){
    $tmp = $_SESSION['solution'];
    for($i = 0; $i < 4; $i++){
      for($j = 0; $j < 4; $j++){
        if($essaie[$i] == $tmp[$j] & $i==$j){
          $this->tabVerif[$i] = "white";
          $tmp[$j] = " ";
        }
        if($essaie[$i] == $tmp[$j] & $i!=$j){
          $tmp[$j] = " ";
          $this->tabVerif[$i] = "black";
        }
      }
    }
  return $this->tabVerif;
  }

}
?>
