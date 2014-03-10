<?php
header ('Content-Type: application/json');
require_once('config.php');
require_once('connexion.php');
require_once('function.inc.php');


$result=array();
if(isset($_GET['action'])){
	switch($_GET['action']){
	case 'date':
		$query="SELECT `date` FROM galerie_php ORDER BY `date` DESC";
		$resultat=$db->query($query);
		$ligne=$resultat->fetchColumn();
		$result=$ligne;
	break;
	case 'next':
		global$db;
		global$config;
		$current_page=1;
		$query="SELECT * FROM galerie_php ORDER BY `date` DESC LIMIT ".($current_page*$config['img_par_page']).','.$config['img_par_page'];
		$resultat=$db->query($query);
		foreach ($resultat as $ligne) {
			echo '<a href="image.php?id='.$ligne['id'].'&page='.($current_page+1).'"><img src="images/'.$ligne['nom_fichier'].'" alt="'.$ligne['nom'].'" title="'.$ligne['nom'].'" width="150"/></a>';
		}
		return $resultat;
	break;
	}
}
echo json_encode($result);