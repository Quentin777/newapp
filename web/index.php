<?php
require '../app/Autoloader.php'; // appelle la page Autoloader.php depuis le dossier pages
App\Autoloader::register();

if (isset($_GET['p'])){ // 
	$page = $_GET['p']; 
}else{  // si $_GET n'est pas 'p' renvoie dans la page home.php
	$page = 'home';
}

//initialisation de la base de donnée
$db = new App\Database('newapp'); 

ob_start(); // démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon(cache).

	if($page==='home'){

		require '../pages/home.php'; // appelle la page home.php depuis le dossier pages
	}elseif($page=== "article"){
		require '../pages/single.php'; // appelle la page single.php depuis le dossier pages
	}elseif($page=== "categorie"){
		require '../pages/categorie.php'; // appelle la page categorie.php depuis le dossier pages
	}else{
		require '../pages/404.php'; // appelle la page 404.php depuis le dossier pages
	}
	
$content = ob_get_clean(); // Lit le contenu courant du tampon de sortie puis l'efface

require '../pages/templates/default.php'; // appelle la page templates.php depuis le dossier pages
