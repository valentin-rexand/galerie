<?php

	require_once('function.inc.php');
	require_once('config.php');
	require_once('connexion.php');

	$nbrpage=nbpage();

	if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0 && $_GET['page']<=$nbrpage){
		$current_page=$_GET['page']-1;//htmlspecialchars pas obligatoire car par le "is_numeric" aucun code html ne peut être rentré
	} else {
		$current_page=0;
	}


	$titre='accueil - page'.($current_page+1);
	require_once('header.inc.php');

	if(!isset($_SESSION['admin'])){
		echo'<p><a href="connect.php" class="buttonco">Se connecter</a></p>';
	} else {
		echo'<p><a href="deco.php?deco=1" class="buttonco">Se déconnecter</a></p>';
		echo '<p><a href="form_img.php">Ajouter une image</a></p>';
	}


	echo '<div class="gallery">'.PHP_EOL;

	$images=get_image($current_page);

	echo '<div class="image">'.PHP_EOL;
	foreach ($images as $ligne) {
		echo '<a href="image.php?id='.$ligne['id'].'&page='.($current_page+1).'"><img src="images/'.$ligne['nom_fichier'].'" alt="'.$ligne['nom'].'" title="'.$ligne['nom'].'" width="150"/></a>';
	}
	echo '</div>'.PHP_EOL;
	echo '</div>'.PHP_EOL;


	echo '<p class="clear">'.PHP_EOL;
	if ($current_page>0){//($current_page+1)-1 donc $current_page (ce que croit l'utilisateur $current_page+1 et la page réelle -1)
		echo '<a href="index.php?page=1" class="first"><- first</a>'.PHP_EOL;
		echo '<a href="index.php?page='.$current_page.'" class="previous">Précédent</a>'.PHP_EOL;
	}
	if($current_page<$nbrpage-1){//$current_page+1 pr ce que l'on fait mais comme utilisateur sur page +1 ça donne +2
		echo '<a href="index.php?page='.($current_page+2).'" class="next">Suivant</a>'.PHP_EOL;
		echo '<a href="index.php?page='.$nbrpage.'" class="last">last -></a>'.PHP_EOL;
	}
	echo '</p>'.PHP_EOL;
?>
	<div class="date_img">
		<p>Date de l'image la plus récente :</p>
		<button id="mon_bouton">clic</button>
	</div>

	<input type="hidden" class="inputnumpage" value="<?php echo (htmlspecialchars($_GET['page'])) ?>">

<?php

	require_once('footer.inc.php');