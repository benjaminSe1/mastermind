<?php
require_once __DIR__."/../vue/Vue.php";
require_once __DIR__."/../modele/bd.php";

$bd = new Bd();

/*$listePseudo = $bd->getAllPseudos();
foreach($listePseudo as $row){
echo $row;
echo "<br/>";
}

$pseudoE = $bd->pseudoExists("titi");
var_dump($pseudoE);
echo $bd->majPartie("titi", 1, 5);
echo "<br/>";
echo $bd->majPartie("titi", 0, 10);
echo "<br/>";
echo $bd->majPartie("titi", 0, 10);
echo "<br/>";
echo $bd->majPartie("titi", 1, 2);
echo "<br/>";

$listepartie = $bd->getAllPartiesJoueurs("titi");
foreach($listepartie as $row){
echo " id : " . $row['id'] . " pseudo : " . $row['pseudo'] . " partie Gagnée? : " . $row['partieGagnee'] . " nombreCoups : " . $row['nombreCoups'];
echo "<br/>";
}
echo "<br/>";

$listeMeilleurPartie = $bd->getMeilleuresParties();

foreach($listeMeilleurPartie as $row){
echo " id : " . $row['id'] . " pseudo : " . $row['pseudo'] . " partie Gagnée? : " . $row['partieGagnee'] . " nombreCoups : " . $row['nombreCoups'];
echo "<br/>";
}
echo "<br/>";

$mdp = $bd->getMdp("titi");
echo $mdp['motDePasse'];*/
/*
?>

<html>
<body>
<br/>
<br/>
<form method="POST" action="">
Entrer votre pseudo	<input type="text" name="pseudo"/>
Entrer votre mdp	<input type="password" name="pwd"/>
</br>
</br>
<input type="submit" name="soumettre" value="envoyer"/>
</form>
<br/>
<br/>

<?php

$valeurSaisie = $_POST['pwd'];
//$bd->setMdp($_POST['pseudo'], $valeurSaisie);

$mdpBD = $bd->getMdp($_POST['pseudo']);


if(crypt($valeurSaisie, $mdpBD)	== $mdpBD)
{
	echo 'bon mdp';
}
else
{
	echo 'mauvais mdp';
}*/

?>
