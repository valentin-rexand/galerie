<?php
	$titre='accueil';
	require_once('header.inc.php');

	$dossier='images/';
	$images=scandir($dossier); //$images est un tableau

	$taille_tableau=count($images);
	$nbrpage=ceil($taille_tableau/5);
	if(isset($_GET['page'])){
		$numpage=htmlspecialchars($_GET['page']);
	} else {
		$numpage=0;
	}
	$page=array_slice($images,($numpage*5),5);

	echo '<div class="gallery">'.PHP_EOL;
	foreach($page as $ligne){ //$ligne est une chaîne de caractères représentant un fichier
		if ($ligne != '.'&& $ligne !='..'){
			echo '<div class="image">'.PHP_EOL;
			echo '<a href="image.php?name='.$ligne.'"><img src="images/'.$ligne.'" alt="Image '.$ligne.'" width="150"/></a>'.PHP_EOL;
			echo '</div>'.PHP_EOL;
		}
	}
	echo '</div>'.PHP_EOL;

	echo '<p class="clear">'.PHP_EOL;
		if ($numpage<=$nbrpage&&$numpage>0){
			echo '<a href="index.php?page='.($numpage-1).'">Précédent</a>'.PHP_EOL;
		}
		if($numpage>=0&&$numpage<$nbrpage){
			echo '<a href="index.php?page='.($numpage+1).'">Suivant</a>'.PHP_EOL;
		}
	echo '</p>'.PHP_EOL;

	require_once('footer.inc.php');