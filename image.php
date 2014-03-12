<?php
	$titre='image';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');

	if(isset($_GET['id'])){
		$id=htmlspecialchars($_GET['id']);

		$sql="SELECT * FROM galerie_php JOIN user ON galerie_php.auteur=user.id WHERE galerie_php.id=".$db->quote($id);
		$resultat=$db->query($sql);

		echo '<div class="page_img">'.PHP_EOL;
		foreach ($resultat as $ligne) {
			echo '<h2>'.$ligne['nom'].'</h2>';
			echo '<p>'.$ligne['date'].' - '.$ligne['login'].'</p>';
			echo '<img src="images/'.$ligne['nom_fichier'].'" alt="Image '.$ligne['nom'].'"/>';
			echo '<p>'.$ligne['description'].'</p>';
		}
		echo '</div>'.PHP_EOL;

		if(isset($_GET['page'])){
			$page=htmlspecialchars($_GET['page']);
		}

		if(isset($_SESSION['user'])){

		$query="SELECT auteur FROM galerie_php WHERE id=".$db->quote($id);
		$resultat=$db->query($query);
		$ligne=$resultat->fetch();

		if(($ligne['auteur']==$_SESSION['user']['id']) || $_SESSION['user']['id']==0){
			echo'<p><a href="modif.php?id='.$id.'&page='.$page.'" class="modif">Modifier</a><a href="suppr.php?id='.$id.'&page='.$page.'">Supprimer</a></p>';
		}
	}
	echo '<p><a href="index.php?page='.$page.'">&lt;&ndash; Retour galerie</a></p>';
	}
	
	require_once('footer.inc.php');