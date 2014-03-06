<?php
	$titre='suppression';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');

	if(isset($_GET['page'])){
		$page=htmlspecialchars($_GET['page']);
	}

	if (isset($_GET['id'])){
		if(isset($_GET['confirmation'])){
			$id=$db->quote($_GET['id']);
			$supp="DELETE FROM galerie_php WHERE id=".$id."LIMIT 1";
			$confirm=$db->exec($supp);
			if($confirm){
				echo '<p>L\'article a bien été supprimé</p>';
				echo '<p><a href="index.php?page='.$page.'">retour galerie</a></p>';
			}
		}else{
			$id=htmlspecialchars($_GET['id']);
			echo '<p>Voulez-vous supprimer?</p>';
			echo '<p><a href="suppr.php?id='.$id.'&page='.$page.'&confirmation=1">oui</a></p>';
			echo '<p><a href="image.php?id='.$id.'&page='.$page.'">non</a></p>';
		}
	}

	require_once('footer.inc.php');