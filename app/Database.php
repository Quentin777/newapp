<?php
namespace App; // Initialise database.php dans le dossier app qui contient toutes les classes.
use \PDO; // on quitte le dossier virtuel app pour pouvoir utiliser la class pdo qui est utilisée par défaut en php. 

/**
* connexion a la base de donnée
*/
class Database
{
	
	private $db_name; // nom de la table 
	private $db_user; // nom utilisateur
	private $db_pass; // mots de passe
	private $db_host; // methode d'hebergement
	private $pdo; // table sql


	function __construct($db_name, $db_user='live', $db_pass='live', $db_host='localhost') // __ construct permet utiliser les methode privates et leur definir une variable, les paramètres construct deviennent obligatoire quand on appelle la class.
	{
			$this->db_name= $db_name; 
			$this->db_user= $db_user;
			$this->db_pass= $db_pass;
			$this->db_host= $db_host;
	}

	private function getPdo(){
		if($this->pdo === null){ // si pdo est strictement égale à null , demande de se connecter a votre propre bases de données.
		 	$pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.';charset=UTF8', $this->db_user, $this->db_pass);
  			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  			$this->pdo = $pdo;
  		}
  		return $this->pdo; // si pdo existe déjà retourne $this->pdo;
	}

	public function query($statement, $class_name){

		$req = $this->getPdo()->query($statement); // execute une req depuis la fonction getPdo, query execute une requête sql
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name); //Définit le mode de récupération par défaut pour cette requête 
		$datas = $req->fetchAll(); //fetchAll récupère tout les élements d'une base de donnée et les mets dans un tableau
		return $datas; //retourne dans la variable $datas;
	}
	public function prepare($statement, $parametre, $class_name, $one=false){
		
		$req = $this->getPdo()->prepare($statement); //Prépare une requête à l'exécution et retourne un objet
		$req->execute($parametre); // execute $parametre
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name); //Définit le mode de récupération par défaut pour cette requête
		if ($one===false){ // Si $one est strictement égale à false 
			$datas= $req->fetchAll(); // execute si false et le met dans un tableau
		}else{
			$datas= $req->fetch(); // execute si true et genere une ligne
		}
		return $datas; // retourne dans la variable $datas;
	}
}