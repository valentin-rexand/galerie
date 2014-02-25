<?php
	
	$titre='image';
	require_once('header.inc.php');
	require_once('config.php');

	if(isset($_GET['name'])){
			$chars=htmlspecialchars($_GET['name']);
			$sql="SELECT `date`, auteur, nom, description, nom_fichier FROM galerie_php WHERE nom_fichier=".$db->quote($chars);
			$resultat=$db->query($sql);
			foreach ($resultat as $ligne) {
				echo '<h2>'.$ligne['nom'].'</h2>';
				echo '<p>'.$ligne['date'].' - '.$ligne['auteur'].'</p>';
				echo '<img src="images/'.$ligne['nom_fichier'].'" alt="Image '.$ligne['nom'].'"/>';
				echo '<p>'.$ligne['description'].'</p>';
			}
	}

	echo '<p><a href="index.php">&lt;&ndash; Retour galerie</a></p>';

	require_once('footer.inc.php');
