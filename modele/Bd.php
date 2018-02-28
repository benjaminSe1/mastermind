<?php

/**
*Classe generale de definition d'exception
*/

class MonException extends Exception{
	private $chaine;

/**
*Constructeur de la classe
*/

	public function __construct($chaine){
	$this->chaine=$chaine;
	}

/**
*Fonction qui permet d'afficher "mysql:host=localhost;dbname=e155530e"
*@return $chaine contenant un raccourci pour la connection à la base de donnees
*/

	public function afficher(){
	return $this->chaine;
	}

}

/**
*Exception relative à un probleme de connexion
*/

class ConnexionException extends MonException{
}

/**
*Exception relative à un probleme d'accès à une table
*/

class TableAccesException extends MonException{
}

/**
*Classe qui gère les accès à la base de données
*/

class Bd{
private $connexion;

/**
*Constructeur de la classe
*@throws ConnexionExcpetion une exception est lancee si l'utilisateur n'a pas rentre les bons identifiants
*/

	public function __construct(){
	 try{
		$chaine="mysql:host=localhost;dbname=E145725X";
      	$this->connexion = new PDO($chaine,"E145725X","E145725X");
		$this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	 }
	catch(PDOException $e){
		$exception=new ConnexionException("problème de connection à la base");
		throw $exception;
	}
}



/**
*Fonction qui permet de se deconnecter de la base
*/
public function deconnexion(){
	 $this->connexion=null;
}

/**
*méthode qui permet de récupérer les pseudos dans la table pseudo
*post-condition:
*retourne un tableau à une dimension qui contient les pseudos.
*@throws TableAccesException une exception est lancee si l'utilisateur n'a pas acces a une table partie
*/

public function getAllPseudos(){
	try{
		$requete = "select * from pseudonyme;";
		$statement = $this->connexion->query($requete);
		$tabResult = $statement->fetchAll();
		foreach($tabResult as $row)
		{
		$pseudo[] = $row['pseudo'];
		}
		return $pseudo;
	}
	catch(PDOException $e)
	{
		throw new TableAccesException("problème avec la table parties");
	}
}

/**
*Fonction qui vérifie qu'un pseudo existe dans la table pseudonyme
*post-condition retourne vrai si le pseudo existe sinon faux
*@throws TableAccesException une exception est lancee si l'utilisateur n'a pas acces a une table partie
*/

public function pseudoExists($pseudo){
	 try{
	$statement = $this->connexion->prepare("select pseudo from joueurs where pseudo=?;");
	$statement->bindParam(1, $pseudoParam);
	$pseudoParam=$pseudo;
	$statement->execute();
	$result=$statement->fetch(PDO::FETCH_ASSOC);

	if (isset($result["pseudo"])){
	return true;
	}
	else{
	return false;
	}
}
		catch(PDOException $e)
		{
		$this->deconnexion();
		throw new TableAccesException("problème avec la table parties");
		}
}



/**
*Fonction qui permet d'insérer une partie dans la table partie
*@throws TableAccesException une exception est lancee si l'utilisateur n'a pas acces a une table partie
*/

public function majPartie($pseudo, $partieGagnee, $nombreCoups){
	try{
		$statement = $this->connexion->prepare("INSERT INTO parties (pseudo, partieGagnee, nombreCoups) VALUES (?,?,?)");
		$statement->bindParam(1, $pseudo);
		$statement->bindParam(2, $partieGagnee);
		$statement->bindParam(3, $nombreCoups);
		$statement->execute();
	}
		catch(PDOException $e){
		$this->deconnexion();
		throw new TableAccesException("problème avec la table parties");
		}
}





/**
*méthode qui permet de récupérer toutes les parties d'un joueur de la table partie
*@param $pseudo du joueur pour qui on va récupérer les parties
*post-condition:
*retourne un tableau contenant les parties (une partie par ligne)
*@throws TableAccesException une exception est lancee si l'utilisateur n'a pas acces a une table partie
*/
public function getAllPartiesJoueurs($pseudo){
		try{
		$requete = "SELECT * FROM parties where pseudo ='".$pseudo."';";
		$statement=$this->connexion->query($requete);
		 return($statement->fetchAll(PDO::FETCH_ASSOC));
		}
		catch(PDOException $e){
		$this->deconnexion();
		throw new TableAccesException("problème avec la table parties");
		}
}


/**
*méthode qui permet de récupérer les 5 meilleurs parties de la table partie
*post-condition:
*retourne un tableau contenant les parties (une partie par ligne)
*@throws TableAccesException une exception est lancee si l'utilisateur n'a pas acces a une table partie
*/

public function getMeilleuresParties(){
	try
	{
	$statement=$this->connexion->query("SELECT * FROM parties ORDER BY nombreCoups LIMIT 0, 5");
	return($statement->fetchAll(PDO::FETCH_ASSOC));
	}
	catch(PDOException $e){
	$this->deconnexion();
	throw new TableAccesException("problème avec la table parties");
	}
}

/**
*Fonction qui permet de récupérer un mot de passe associé au pseudo passé en paramètre
*@param $pseudo du joueur pour qui on va récupérer le mot de passe
*post-condition:
*retourne le mot de passe sous la forme d'un string
*@throws TableAccesException une exception est lancee si l'utilisateur n'a pas acces a une table partie
*/

public function getMdp($pseudo){
	try
	{
	$statement=$this->connexion->query("SELECT motDePasse FROM joueurs where pseudo = '".$pseudo."';");
	$res = $statement->fetch();
	return $res['motDePasse'];
	}
	catch(PDOException $e)
	{
	$this->deconnexion();
	throw new TableAccesException("problème avec la table parties");
	}
}

/**
*Fonction qui permet de modifier le mot de passe d'un joueur
*@param $pseudo du joueur pour qui on va modifier le mot de passse
*@param $mdp nouveu mdp du joueur
*post-condition:
*@throws TableAccesException une exception est lancee si l'utilisateur n'a pas acces a une table partie
*/

public function setMdp($pseudo, $mdp){
	try
	{
	$statement = $this->connexion->prepare("UPDATE joueurs SET motDePasse = ? where pseudo = ?;");
	$statement->bindParam(1, $mdp);
	$statement->bindParam(2, $pseudo);
	$statement->execute();
	}
	catch(PDOException $e)
	{
	$this->deconnexion();
	throw new TableAccesException("problème avec la table parties");
	}
}

/**
*Fonction qui permet de créer un joueur dans la table joueur
*@param $pseudo du joueur que l'on va créer
*@param $mdp du joueur que l'on va créer
*post-condition:
*@throws TableAccesException une exception est lancee si l'utilisateur n'a pas acces a une table partie
*/

public function newJoueur($pseudo, $mdp){
	try
	{
	//"INSERT INTO parties (pseudo, partieGagnee, nombreCoups) VALUES (?,?,?)"
	$statement = $this->connexion->prepare("INSERT INTO joueurs (pseudo, motDePasse) Values(?, ?)");
	$statement->bindParam(1, $pseudo);
	$statement->bindParam(2, crypt($mdp));
	$statement->execute();
	}
	catch(PDOException $e)
	{
	$this->deconnexion();
	throw new TableAccesException("problème avec la table parties");
	}
}



}

?>
