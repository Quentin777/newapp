<?php
namespace App\Tables; // Initialise table.php dans le dossier app du dossier Tables qui contient toutes les classes.

use App\App; 

/**
* 
*/
class Table
{
	protected static $table; // on initialise une variable static protected 

	private static function getTable(){ // on crée la function getTable static protected
		if(static::$table===null){ // si $table === null alors 
			$class_name = explode('\\', get_called_class()); //$class_name = explode (separe une chaine de caractère (exemple : USER\Table\mika) \ USER= array(0) \Table = array(1) \mika = array(2))  get_called_class retourne le parent de la class qu'on appelle
			static::$table = strtolower(end($class_name))."s";
		}	// strtolower transforme tout en minuscule et rajoute un "s" à la fin
		return static::$table; // retourne $table
		
	}

	public static function all(){ // on crée la function all en public static
		return App::getDb()->query(" 
			SELECT * 
			FROM ".static::getTable()."
			", get_called_class()); // return la function getDb dans app.php, query execute une requête sql
		//Selectione tout depuis ".static::getTable()" renvoie le nom de la table.
	} 
	
	public function __get($key){ // on crée la function __get en public static avec $key 
		$method = 'get'.ucfirst($key); //ucfirst met la première lettre de $key en majuscule et on transforme une variable ('get.($Key)') en url.
		$this->$key = $this->$method(); //(objet-> $key = objet -> method (get)
		return $this->$key; 

	}

	public static function find($id){ //Permet de selectioner tout dans la table et retourne tout depuis la class sur laquelle elle à était appeller depuis la function getDb ".static::getTable()" depuis App.php
		return App::getDb()->prepare("
			SELECT * 
			FROM ".static::getTable()." 
			WHERE id = ?", // cherche la ou l'id est égale ce que l'on cherche (exemple id = 32 retourne la ligne de l'id 32)
			[$id],
			get_called_class(),
			true); // voir la ligne 47
	}
	public static function query($statement, $atribute = null, $one = false)
		if ($atribute){
			return App::getDb()->prepare($statement, $atribute, get_called_class(), $one); // si atribute = null -> prepare 
		}else{
		 return App::getDb()->query($statement, get_called_class(), $one); // si atribute != null -> execute query
		}
		

	}

}