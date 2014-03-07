<?php
	$titre='suppression';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');

	if(isset($_GET['page'])){
		$page=htmlspecialchars($_GET['page']);
	}
	if(isset($_SESSION['admin'])){
		if (isset($_GET['id'])){
			if(isset($_GET['confirmation'])){
				$id=$db->quote($_GET['id']);
				$query="SELECT nom_fichier FROM galerie_php where id=".$id;
				$result=$db->query($query);
				$nom_fichier=$result->fetchColumn();
				if(file_exists("images/".$nom_fichier)){
					unlink("images/".$nom_fichier);
					$supp="DELETE FROM galerie_php WHERE id=".$id."LIMIT 1";
					$confirm=$db->exec($supp);
					if($confirm){
						echo '<p>L\'article a bien été supprimé</p>';
						echo '<p><a href="index.php?page='.$page.'">retour galerie</a></p>';
					}
				} else {
					echo '<p>le fichier n\'existe pas !</p>';
				}
			}else{
				$id=htmlspecialchars($_GET['id']);
				echo '<p>Voulez-vous supprimer?</p>';
				echo '<p><a href="suppr.php?id='.$id.'&page='.$page.'&confirmation=1">oui</a></p>';
				echo '<p><a href="image.php?id='.$id.'&page='.$page.'">non</a></p>';
			}
		}
	} else {
		echo '<p>Vous devez être connecté pour effectuer cette action</p>';
		echo '<p><a href="index.php">accueil</a></p>';
	}

	require_once('footer.inc.php');