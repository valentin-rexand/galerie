<?php
header ('Content-Type: application/json');
require_once('config.php');
require_once('connexion.php');


$query="SELECT `date` FROM galerie_php ORDER BY `date` DESC";
$resultat=$db->query($query);
$ligne=$resultat->fetchColumn();
echo json_encode($ligne);
