<?php
namespace App; // Initialise app.php dans le dossier app qui contient toutes les classes.


class App
{
	public $titre = 'mon super site';
	private static $_instance; 

	public static function getInstance(){
		if(is_null(self::$_instance)){
			self::$_instance = new app(); // self appelle $_instance / (::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou méthodes surchargées d'une classe. 
		}
		return self::$_instance;
	}

}
	//Déclaration de constante qui vont nous permettre de faire la connexion avec la base de donnée. (toujours respecter cette ordre)
	const DB_NAME='newapp'; 
	const DB_USER='live';
	const DB_PASS='live';
	const DB_HOST='localhost';

	private static $database;
	private static $title = 'mon super site';

	public static function getDb(){
		if(self::$database===null){ // si $database === null on crée une nouvelle database
			self::$database = new Database(
				self::DB_NAME,  // self appelle la function DB_NAME / (::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou méthodes surchargées d'une classe. 
				self::DB_USER,	// self appelle la function DB_NAME / (::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou méthodes surchargées d'une classe.
				self::DB_PASS,	// self appelle la function DB_NAME / (::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou méthodes surchargées d'une classe.
				self::DB_HOST	// self appelle la function DB_NAME / (::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou ////méthodes surchargées d'une classe.
				);
		}
		return self::$database; 

	}
	public static function notFound(){
		header("HTTP/1.0 404 Not Found");
		header('location: index.php?p=404'); //retourne sur la page index.php avec la ////requete $GET de l'erreur 404
	}
	public static function getTitle()
	{
		return self::$title;
	}
		public static function setTitle($name)
	{
		self::$title = $name." | ".self::$title; //ajoute à $titre un attribut qui ////s'appelle $name et qui est égale à la page actuelle 
	}
