<?php

	require_once('function.inc.php');
	require_once('config.inc.php');

	$dossier=$config['dossier'];
	$images=scandir($dossier); //$images est un tableau

	//écrasement du tableau d'images par le nouveau avec application du filtre ->filtre sur le tableau par le biai de la fonction
	$images=array_filter($images,"filtre");
	
	$taille_tableau=count($images);
	$nbrpage=ceil($taille_tableau/$config['img_par_page']);

	if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0 && $_GET['page']<=$nbrpage){
		$numpage=$_GET['page']-1;//htmlspecialchars pas obligatoire car par le "is_numeric" aucun code html ne peut être rentré
	} else {
		$numpage=0;
	}

	$titre='accueil - page'.($numpage+1);
	require_once('header.inc.php');

	$page=array_slice($images,($numpage*$config['img_par_page']),$config['img_par_page']);

	echo '<div class="gallery">'.PHP_EOL;

	foreach($page as $ligne){ //$ligne est une chaîne de caractères représentant un fichier
		echo '<div class="image">'.PHP_EOL;
		echo '<a href="image.php?name='.$ligne.'"><img src="images/'.$ligne.'" alt="Image '.$ligne.'" width="150"/></a>'.PHP_EOL;
		echo '</div>'.PHP_EOL;
	}

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