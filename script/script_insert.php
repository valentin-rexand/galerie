<?php
	require_once('../config.php');

	function filtre ($ligne){
		if ($ligne[0]!= '.'){
			return true;
		} else {
			return false;
		}
	}

	$dossier='../images/';
	$images=scandir($dossier);
	$images=array_filter($images,"filtre");

	for($i=0;$i<count($images);$i++){
		$ins_sql="INSERT INTO galerie_php (`date`, nom, nom_fichier, auteur, description) VALUES (NOW(), 'image n-ième', '8c12a2de.jpg', 'valentin', 'n-ième image'); ";
		//echo $ins_sql;
		$result_ins=$db->exec($ins_sql);
	}
	