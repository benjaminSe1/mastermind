<?php

/**
*Classe qui permet d'afficher une vue lorque l'utilisateur à gagné
*/

class VuePerdant{
  function getVuePerdant(){
    echo'
  <!DOCTYPE html>
  <html>
  <head>
  <title> Perdu!!</title>
  <link rel="stylesheet" href="vueGagnant_Perdant.css">
  </head>
  <body>
      <h1>Vous avez Perdu!!</h1>
      <h2>Desole!!</h2>
      <div class="container">
              <div class="divTable" style="width: 100%;border: 4px solid #000;" >
                <div class="divTableBody">
                  <div class="divTableRow">
                    <div class="divTableCell"><h3>Pseudo</h3></div>
                    <div class="divTableCell"><h3>Meilleur partie</h3></div>
                    <div class="divTableCell"><h3>Nombre de partie jouee</h3></div>
                    <div class="divTableCell"><h3>Nombre de partie gagnee</h3></div>
                  </div>
                  <div class="divTableRow">
                    <div class="divTableCell">ez</div>
                    <div class="divTableCell">ez</div>
                    <div class="divTableCell">ez</div>
                    <div class="divTableCell">ez</div>
                  </div>
                </div>
              </div>
    </div>
  </body>
  </html>';
  }
}

?>
