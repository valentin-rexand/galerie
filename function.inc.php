<?php

// vérification de l'existence de l'utilisateur en base de donnée
	function connect_user($login, $mdp){
		global$db;
		$query="SELECT id, login FROM user WHERE login=".$db->quote($login)." AND password=".$db->quote($mdp)." LIMIT 1";
		$resultat=$db->query($query);
		$ligne=$resultat->fetch();
		return $ligne;
	}

	function nbpage(){
		global$db;
		global$config;
		$sql="SELECT COUNT(id) AS count FROM galerie_php";
		$result=$db->query($sql);
		$taille_tableau=$result->fetchColumn();
		$nbrpage=ceil($taille_tableau/$config['img_par_page']);
		return $nbrpage;
	}