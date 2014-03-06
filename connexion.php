<?php
	require_once('config.php');
	try{
		$db= new PDO($config['dsn'], $config['username'], $config['password']);
		$db->exec('SET CHARACTER SET UTF8');
	} catch (Exception $e){
		die('Impossible de se connecter');
	}