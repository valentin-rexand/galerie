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
		$result['images']=get_image_by_page($_GET['page']-1)->fetchAll();
	break;
	}
}
echo json_encode($result);