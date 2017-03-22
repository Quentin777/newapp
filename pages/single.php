<?php
	use \App\Tables\Article; 
	use \App\App;
	$post = Article::find($_GET['id']);

	if ($post===false){
		App::notFound();
	}
	App::setTitle($post->titre);
?>

<h1><?= $post->titre; ?></h1>
<p><?= $post->contenu; ?></p>