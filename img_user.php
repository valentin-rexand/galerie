<?php
	$titre='vos images';
	require_once('header.inc.php');
	require_once('function.inc.php');
	require_once('config.php');
	require_once('connexion.php');

	if(isset($_SESSION['user'])){
		if(isset($_GET['user'])){
			$nbuser=htmlspecialchars($_GET['user']);
			$query="SELECT * FROM galerie_php WHERE auteur=".$db->quote($nbuser);
			$resultat=$db->query($query)->fetchAll();

			if (count($resultat)!==0){
				echo '<div class="gallery">'.PHP_EOL;
				echo '<div class="image">'.PHP_EOL;
				foreach ($resultat as $ligne) {
					echo '<a href="image.php?id='.$ligne['id'].'"><img src="images/'.$ligne['nom_fichier'].'" alt="'.$ligne['nom'].'" title="'.$ligne['nom'].'" width="150"/></a>';
				}
				echo '</div>'.PHP_EOL;
				echo '</div>'.PHP_EOL;
			} else {
				echo '<p>Vous n\'avez ajouté aucune image</p>';
				echo '<p><a href="form_img.php">Ajouter une image</a></p>';
			}
		} else {
			$_GET['user']=$_SESSION['user']['id'];
			$nbuser=htmlspecialchars($_GET['user']);
		}
	}
	echo '<p><a href="index.php?page=1">&lt;&ndash; Retour galerie</a></p>';

	require_once('footer.inc.php');