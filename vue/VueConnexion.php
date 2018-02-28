<?php 
require_once __DIR__ . "/Vue.php";
require_once __DIR__ . "/VuePerdant.php";
/*
classe vue qui permet l'affichage de l'authentification de la personne et qui renvoie au jeu mastermind.
*/
class VueConnexion{
private $vueUtil;
private $vuePerdant;

function __construct(){
  $this->vueUtil = new Vue();
  $this->vuePerdant = new VuePerdant();
}

  function genereVueConnexion($dejaEssaye){
  $this->vueUtil->genereHeader("vueConnexion");
  $this->demandePseudo($dejaEssaye);
}


/**
*Fonction qui génère la vue permettant à l'utilisateur de se connecter
*@param booleen $dejaEssaye: 
*"True" si l'utilisateur a déjà essayé de se connecter mais avec de mauvais identifiants
*"False" et si c'est sa première tentative
*/
    function demandePseudo($dejaEssaye){
      if($dejaEssaye == TRUE){
    ?>
    <body>
      <h1>Mastermind</h1>
      <div class="container">
        <div id="login">
          <form action="index.php" method="POST">
            <fieldset class="clearfix">
              <p><span class="fontawesome-user"></span><input name ="pseudo" type="text" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p>
              <p><span class="fontawesome-lock"></span><input name ="pwd" type="password" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p>
              <p><input name="soumettreAuthentification" type="submit" value="Connexion"></p>
              <p style = "color:red; text-align: center; font-size:16px;"> Mauvais identifiants </p>
            </fieldset>
          </form>
        </div> 
      </div>
    </body>
    </html>
    <?php
    }
    else{
    ?>
    <body>
      <h1>Mastermind</h1>
      <div class="container">
        <div id="login">
          <form action="index.php" method="POST">
            <fieldset class="clearfix">
              <p><span class="fontawesome-user"></span><input name ="pseudo" type="text" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p>
              <p><span class="fontawesome-lock"></span><input name ="pwd" type="password" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p>
              <p><input name="soumettreAuthentification" type="submit" value="Connexion"></p>

            </fieldset>
          </form>
        </div> 
      </div>
    </body>
    </html>
    <?php
    }
    }
}
?>