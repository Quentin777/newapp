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

	public static function all(){

		return App::getDb()->query(" 
			SELECT * 
			FROM ".static::getTable()."
			", get_called_class());
	} 
	
	public function __get($key){
		$method = 'get'.ucfirst($key);
		$this->$key = $this->$method();
		return $this->$key;

	}

	public static function find($id){
		return App::getDb()->prepare("
			SELECT * 
			FROM ".static::getTable()." 
			WHERE id = ?",
			[$id],
			get_called_class(),
			true);
	}
	public static function query($statement, $atribute = null, $one = false){
		if ($atribute){
			return App::getDb()->prepare($statement, $atribute, get_called_class(), $one);
		}else{
		 return App::getDb()->query($statement, get_called_class(), $one);
		}
		

	}

}