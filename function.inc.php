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
/*
	function nav($current_page, $navigation){
		global$current_page;
		switch($navigation){
			case 'next';
				echo $current_page;
				echo 'next';
			break;
			case 'prev';
				echo $current_page;
				echo 'prev';
			break;
			case 'last';
				echo $current_page;
				echo 'last';
			break;
			case 'first';
				echo $current_page;
				echo 'first';
			break;
		}
	}*/
/*
	function nav($navigation){
		global$db;
		global$config;
		$sql='SELECT COUNT(id) AS count FROM galerie_php';
		$result=$db->query($sql);
		$compte=$result->fetchColumn();
		$taille_tableau=$compte;
		$nbrpage=ceil($taille_tableau/$config['img_par_page']);
		switch ($navigation){
			case 'next':
				$current_page=$current_page+1;
				$query="SELECT * FROM galerie_php ORDER BY `date` DESC LIMIT".($current_page*$config['img_par_page']).','.$config['img_par_page'];
				$resultat=$db->query($query);
				break;
			case 'prev':
				$current_page=$current_page-1;
				$query="SELECT * FROM galerie_php ORDER BY `date` DESC LIMIT".($current_page*$config['img_par_page']).','.$config['img_par_page'];
			$resultat=$db->query($query);
				break;
			case 'first':
				$current_page=1;
				$query="SELECT * FROM galerie_php ORDER BY `date` DESC LIMIT".($current_page*$config['img_par_page']).','.$config['img_par_page'];
			$resultat=$db->query($query);
				break;
			case 'last':
				$current_page=$nbrpage;
				$query="SELECT * FROM galerie_php ORDER BY `date` DESC LIMIT".($nbrpage*$config['img_par_page']).','.$config['img_par_page'];
				$resultat=$db->query($query);
				break;
		}
		
		echo '<div class="image">'.PHP_EOL;
		foreach ($resultat as $ligne){
			echo '<a href="image.php?id='.$ligne['id'].'&page='.($current_page+1).'"><img src="images/'.$ligne['nom_fichier'].'" alt="'.$ligne['nom'].'" title="'.$ligne['nom'].'" width="150"/></a>';
		}
		echo '</div>'.PHP_EOL;
	}*/