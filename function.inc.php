<?php
	function get_image($current_page){
		global$db;
		global$config;
		$query="SELECT * FROM galerie_php ORDER BY `date` DESC LIMIT ".($current_page*$config['img_par_page']).','.$config['img_par_page'];
		$resultat=$db->query($query);
		return $resultat;
	}

	function nbpage(){
		global $db;
		global $config;
		$sql='SELECT COUNT(id) AS count FROM galerie_php';
		$result=$db->query($sql);
		$compte=$result->fetchColumn();
		$taille_tableau=$compte;
		$nbrpage=ceil($taille_tableau/$config['img_par_page']);
		return $nbrpage;
	}