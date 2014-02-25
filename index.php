<?php

	require_once('function.inc.php');
	require_once('config.php');
	

	$sql='SELECT COUNT(id) AS count FROM galerie_php';
	$result=$db->query($sql);
	$compte=$result->fetchColumn();
	$taille_tableau=$compte;

	$nbrpage=ceil($taille_tableau/$config['img_par_page']);

	if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0 && $_GET['page']<=$nbrpage){
		$numpage=$_GET['page']-1;//htmlspecialchars pas obligatoire car par le "is_numeric" aucun code html ne peut être rentré
	} else {
		$numpage=0;
	}


	$titre='accueil - page'.($numpage+1);
	require_once('header.inc.php');

	
	echo '<div class="gallery">'.PHP_EOL;

	$query='SELECT * FROM galerie_php ORDER BY `date` DESC LIMIT '.($numpage*$config['img_par_page']).','.$config['img_par_page'];
	$resultat=$db->query($query);

	echo '<div class="image">'.PHP_EOL;
	foreach ($resultat as $ligne) {
		echo '<a href="image.php?name='.$ligne['nom_fichier'].'"><img src="images/'.$ligne['nom_fichier'].'" alt="'.$ligne['nom'].'" width="150"/></a>';
		echo '<div class="hover"><p>'.$ligne['nom'].'</p><p>'.$ligne['auteur'].'</p><p>'.$ligne['date'].'</p></div>';
	}
	echo '</div>'.PHP_EOL;
	echo '</div>'.PHP_EOL;


	echo '<p class="clear">'.PHP_EOL;
	if ($numpage>0){//($numpage+1)-1 donc $numpage (ce que croit l'utilisateur $numpage+1 et la page réelle -1)
		echo '<a href="index.php?page='.$numpage.'">Précédent</a>'.PHP_EOL;
	}
	if($numpage<$nbrpage-1){//$numpage+1 pr ce que l'on fait mais comme utilisateur sur page +1 ça donne +2
		echo '<a href="index.php?page='.($numpage+2).'">Suivant</a>'.PHP_EOL;
	}
	echo '</p>'.PHP_EOL;

	require_once('footer.inc.php');