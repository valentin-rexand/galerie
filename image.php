<?php
	$titre='image';
	require_once('header.inc.php');
	require_once('config.php');

	if(isset($_GET['id'])){
		$id=htmlspecialchars($_GET['id']);
		$sql="SELECT * FROM galerie_php WHERE id=".$db->quote($id);
		$resultat=$db->query($sql);
		foreach ($resultat as $ligne) {
			echo '<h2>'.$ligne['nom'].'</h2>';
			echo '<p>'.$ligne['date'].' - '.$ligne['auteur'].'</p>';
			echo '<img src="images/'.$ligne['nom_fichier'].'" alt="Image '.$ligne['nom'].'"/>';
			echo '<p>'.$ligne['description'].'</p>';
		}
	}

	if(isset($_SESSION['admin'])){
		echo'<p><a href="modif.php?id='.$id.'">Modifier</a></p>';
		echo'<p><a href="suppr.php?id='.$id.'">Supprimer</a></p>';
	}

	echo '<p><a href="index.php">&lt;&ndash; Retour galerie</a></p>';

	require_once('footer.inc.php');
