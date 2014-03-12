<?php

// vérification de l'existence de l'utilisateur en base de donnée
	function connect_user($login, $mdp){
		global$db;
		$query="SELECT id, login FROM user WHERE login=".$db->quote($login)." AND password=".$db->quote($mdp)." LIMIT 1";
		$resultat=$db->query($query);
		$ligne=$resultat->fetch();
		return $ligne;
	}