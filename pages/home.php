<div class="row">
	<div class="col-md-8">
		<?php  foreach (App\Tables\Article::getLast() as $post): ?>
		  <h2>
		    <a href="<?= $post->Url; ?>">
		      <?= $post->titre;?>  
		    </a>
		  </h2>
		  <p><em><?= $post->category;?></em></p>
		  <p><?= $post->Extrait; ?></p>
		<?php endforeach; ?>
	</div>
	<div class="col-md-4">
		<ul>
			<?php foreach (App\Tables\Categorie::all() as $categorie) : ?>

				<li><a href="<?= $categorie->Url; ?>"><?= $categorie->titre; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>
