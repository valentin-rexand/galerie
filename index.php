<?php

	require_once('function.inc.php');
	require_once('config.php');
	require_once('connexion.php');

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

	if(!isset($_SESSION['user'])){
		echo'<p><a href="connect.php" class="buttonco">Se connecter</a></p>';
		echo'<p><a href="inscription.php">s\'inscrire</a></p>';
	} else {
		echo'<p><a href="deco.php?deco=1" class="buttonco">Se déconnecter</a></p>';
		echo '<p><a href="form_img.php">Ajouter une image</a></p>';
	}


	echo '<div class="gallery">'.PHP_EOL;

	$query='SELECT * FROM galerie_php ORDER BY `date` DESC LIMIT '.($numpage*$config['img_par_page']).','.$config['img_par_page'];
	$resultat=$db->query($query);

	echo '<div class="image">'.PHP_EOL;
	foreach ($resultat as $ligne) {
		echo '<a href="image.php?id='.$ligne['id'].'&page='.($numpage+1).'"><img src="images/'.$ligne['nom_fichier'].'" alt="'.$ligne['nom'].'" title="'.$ligne['nom'].'" width="150"/></a>';
	}
	echo '</div>'.PHP_EOL;
	echo '</div>'.PHP_EOL;


	echo '<p class="clear">'.PHP_EOL;
	if ($numpage>0){//($numpage+1)-1 donc $numpage (ce que croit l'utilisateur $numpage+1 et la page réelle -1)
		echo '<a href="index.php?page=1" class="first"><- first</a>'.PHP_EOL;
		echo '<a href="index.php?page='.$numpage.'" class="previous">Précédent</a>'.PHP_EOL;
	}
	if($numpage<$nbrpage-1){//$numpage+1 pr ce que l'on fait mais comme utilisateur sur page +1 ça donne +2
		echo '<a href="index.php?page='.($numpage+2).'" class="next">Suivant</a>'.PHP_EOL;
		echo '<a href="index.php?page='.$nbrpage.'" class="last">last -></a>'.PHP_EOL;
	}
	echo '</p>'.PHP_EOL;
?>
	<div class="date_img">
		<p>Date de l'image la plus récente :</p>
		<button id="mon_bouton">clic</button>
	</div>

<?php

	require_once('footer.inc.php');