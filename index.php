<?php
	$titre='accueil';
	require_once('header.inc.php');

	$dossier='images/';
	$images=scandir($dossier); //$images est un tableau

	if(isset($_GET['page'])){
		$numpage=htmlspecialchars($_GET['page']);
	} else {
		$numpage=0;
	}

	//function de filtre, création d'un paramètre ligne, si l'image commence par un point elle renvoie true
	function filtre ($ligne){
		if ($ligne[0]!= '.'){
			return true;
		} else {
			return false;
		}
	}//écrasement du tableau d'images par le nouveau avec application du filtre ->filtre sur le tableau par le biai de la fonction
	$images=array_filter($images,"filtre");
	
	$taille_tableau=count($images);
	$nbrpage=ceil($taille_tableau/5);

	$page=array_slice($images,($numpage*5),5);

	echo '<div class="gallery">'.PHP_EOL;

	foreach($page as $ligne){ //$ligne est une chaîne de caractères représentant un fichier
		echo '<div class="image">'.PHP_EOL;
		echo '<a href="image.php?name='.$ligne.'"><img src="images/'.$ligne.'" alt="Image '.$ligne.'" width="150"/></a>'.PHP_EOL;
		echo '</div>'.PHP_EOL;
	}

	echo '</div>'.PHP_EOL;

	echo '<p class="clear">'.PHP_EOL;
	if ($numpage>0){
		echo '<a href="index.php?page='.($numpage-1).'">Précédent</a>'.PHP_EOL;
	}
	if($numpage<$nbrpage-1){
		echo '<a href="index.php?page='.($numpage+1).'">Suivant</a>'.PHP_EOL;
	}
	echo '</p>'.PHP_EOL;

	require_once('footer.inc.php');