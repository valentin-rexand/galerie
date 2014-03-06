<?php
	$titre='suppression';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');

	if (isset($_GET['id'])){
		if(isset($_GET['confirmation'])){
			$id=$db->quote($_GET['id']);
			$supp="DELETE FROM galerie_php WHERE id=".$id."LIMIT 1";
			$confirm=$db->exec($supp);
			if($confirm){
				echo '<p>L\'article a bien été supprimé</p>';
				echo '<p><a href="index.php">retour galerie</a></p>';
			}
		}else{
			$id=htmlspecialchars($_GET['id']);
			echo '<p>Voulez-vous supprimer?</p>';
			echo '<p><a href="suppr.php?id='.$id.'&confirmation=1">oui</a></p>';
			echo '<p><a href="image.php?id='.$id.'">non</a></p>';
		}
	}

	require_once('footer.inc.php');