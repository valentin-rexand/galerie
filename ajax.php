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
		$result['date']=$ligne;
	break;
	case 'nav':
		global$db;
		global$config;//utiliser fonction get-image()?
		$current_page=$db->quote($_GET['page']-1);
		$query="SELECT id, nom, nom_fichier FROM galerie_php ORDER BY `date` DESC LIMIT ".($current_page*$config['img_par_page']).','.$config['img_par_page'];
		$resultat=$db->query($query);
		$result['images'] = $resultat->fetchAll();
	break;
	}
}
echo json_encode($result);