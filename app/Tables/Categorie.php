<?php
namespace App\Tables;

use App\App;

/**
* 
*/
class Categorie extends Table
{
	protected static $table='categories';

	public function getUrl()
	{
		return 'index.php?p=categorie&id='.$this->id;
	}
	
}