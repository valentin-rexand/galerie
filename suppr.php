<?php
	$titre='suppression';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');
	require_once('function.inc.php');

	if(isset($_GET['page'])){
		$page=htmlspecialchars($_GET['page']);
	}
	if(isset($_SESSION['admin'])){
		if (isset($_GET['id'])){
			if(isset($_GET['confirmation'])){

				$id=htmlspecialchars($_GET['id']);
				$image=get_image($id);
				$nom_fichier=$image->fetch();

				if(file_exists("images/".$nom_fichier['nom_fichier'])){
					unlink("images/".$nom_fichier['nom_fichier']);
					
					$confirm=delete_image($id);

					if($confirm){
						echo '<p>L\'article a bien été supprimé</p>';
						echo '<p><a href="index.php?page='.$page.'">retour galerie</a></p>';
					} else {
						echo '<p>Le fichier n\'a pas pu être supprimé</p>';
						echo '<p><a href="image.php?id='.$id.'&page='.$page.'">précédent</a></p>';
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