<?php
namespace App\Tables;

use App\App;

/**
* 
*/
class Article extends Table
{
	public static function getLast(){
		return self::query("
			SELECT 	articles.id,
					articles.titre,
					articles.contenu,
					articles.date,
					categories.titre as category
			FROM articles
			LEFT JOIN categories
				ON category_id = categories.id");
	}
	public function __get($key){
		$method = 'get'.ucfirst($key);
		$this->$key = $this->$method();
		return $this->$key;

	}
	
	public function getUrl()
	{
		return 'index.php?p=article&id='.$this->id;
	}
	 
	 public function getExtrait()
	{
		$html = '<p>'.substr($this->contenu, 0, 100).'...</p>';
		$html .= '<p><a href="'.$this->getUrl().'">voir la suite</a></p>';
		return $html;
	}

	public static function lastByCategory($category_id){
		return self::query("
			SELECT 	articles.id,
					articles.titre,
					articles.contenu,
					articles.date,
					categories.titre as category
			FROM articles
			LEFT JOIN categories
				ON category_id = categories.id
			WHERE category_id = ?", [$category_id]);
	}
}