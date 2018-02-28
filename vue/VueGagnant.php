<?php

/**
*Classe qui permet d'afficher une vue lorque l'utilisateur à gagné
*/

class vueGagnant{


/**
*Fonction qui renvoie l'en tête de la vue gagnant
*/
Function getHeaderVueGagnant(){
  echo '<!DOCTYPE html>
    <html>
    <head>
      <title> Gagner!!</title>
      <link rel="stylesheet" href="vue/css/vueGagnant_Perdant.css">
    </head>
    <body>
        <h1>Vous avez Gagne!!</h1>
        <h2>Bravo!!</h2>';
}

/**
*Fonction qui permet de voir le tableau contenant toutes les statistiques
*@param $tab contenant le tableau des cinq meilleurs parties
*/

Function getTable($tab){
  echo'
              <table>
                <tr>
                  <td><h3>Pseudo</h3></td>
                  <td><h3>Meilleur partie</h3></td>
                  <td><h3>Nombre de partie jouee</h3></td>
                  <td><h3>Nombre de partie gagnee</h3></td>
                </tr>';
                foreach($tab as $row){
                  echo'<tr>
                    <td>'.$row['pseudo'].'</td>
                    <td>'.$row['partieGagnee'].'</td>
                    <td>'.$row['nombreCoups'].'</td>
                    <td>'.$row['partieGagnee'].'</td>
                    </tr>';
                }
                ;
}

/**
*Fonction qui permet de voir le pied de page de la vue gagnant
*/

Function getFootVueGagnant(){
  echo '</table>
</body>
</html>';
}

/**
*Fonction qui regroupe la totalité des Fonction precedente en une seule
*@param $tab contenant le tableau des cinq meilleurs parties
*/

Function getVueGagnant($tab){
  $this->getHeaderVueGagnant();
  $this->getTable($tab);
  $this->getFootVueGagnant();
}

}

?>
