<?php
	require_once('../config.php');

	$dossier='../images/';
	$images=scandir($dossier);

	foreach ($images as $ligne){
		$query="INSERT INTO galerie_php (`date`, nom, nom_fichier, auteur, description) VALUES (NOW(), 'image n-ième', '8c12a2de.jpg', valentin, 'n-ième image')";
		echo $query;
		//$resultat=$db->exec($query);
	}
	