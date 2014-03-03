<?php
	$config=array();

	$config['img_par_page']=5;
	$config['dossier']='images/';

	$adminpass='adminpasswordgaleriephp';

	$sdn='mysql:dbname=3wa;host=localhost';
	$username='3wa';
	$password='berezina';
	try{
		$db= new PDO($sdn, $username, $password);
		$db->exec('SET CHARACTER SET UTF8');//pour afficher correctement les accents et autres
	} catch (Exception $e){
		die('Impossible de se connecter');
	}