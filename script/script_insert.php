<?php
	require_once('../config.php');
	require_once('../functions.inc.php');


	function filtre ($ligne){
		if ($ligne[0]!= '.'){
			return true;
		} else {
			return false;
		}
	}

	$dossier='../'.$config['dossier'];
	$images=scandir($dossier);
	$images=array_filter($images,"filtre");

	$insert_data = array();
	$count = 0;
	$auteur = 'administrateur';

foreach($images as $file) {
    $filename = $file;
    $name = 'Image '.$count;
    $description = 'Description pour l’image '.$count;
    $insert_data[] = '('.$db->quote($name).', '
                        .$db->quote($description).', '
                        .$db->quote($auteur).', NOW(), '
                        .$db->quote($filename).')';
    $count++;
}

$insert_query = 'INSERT INTO '.$config['table_image'].'
    (nom, description, auteur, date, nom_fichier)
    VALUES '.implode(', ', $insert_data);
$insert_result = $db->exec($insert_query);

echo 'Import effectué : '.$insert_result.' enregistrements insérés.';