<?php
	$titre='image';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');

	if(isset($_GET['id'])){
		$id=$db->quote($_GET['id']);
		$requete="SELECT * FROM galerie_php WHERE id=".$id;
		$resultat=$db->query($requete);
		foreach($resultat as $ligne){
			$ligne_nom=$ligne['nom'];
			$ligne_description=$ligne ['description'];
		}
	}
?>

	<form method="post">
		<label for="nom">Nom de l'image<span class="star"> *</span></label>
		<p><input type="text" id="nom" name="nom" value="<?php if(isset($_POST['nom'])){ $nom=htmlspecialchars($_POST['nom']); echo $nom;}else{ echo $ligne_nom;}?>"></p>

		<label for="description">Description<span class="star"> *</span></label>
		<p><textarea name="description" id="description" cols="100" rows="20"><?php if(isset($_POST['description'])){ $description=htmlspecialchars($_POST['description']);echo $description;}else{ echo $ligne_description;}?></textarea></p>
		<p><input type="submit" value="valider"></p>
	</form>

<?php
	if(isset($_SESSION['user'])){
		if(isset($_POST['nom']) && (!empty($_POST['nom'])) && (isset($_POST['description'])) && (!empty($_POST['description']))){

			//modification du contenu par l'utilisateur
			$id=$db->quote(htmlspecialchars($_GET['id']));
			$query="UPDATE galerie_php SET nom=".$db->quote(htmlspecialchars($_POST['nom'])).", description=".$db->quote(htmlspecialchars($_POST['description'])).", `date`=NOW() WHERE id=".$id;
			$resultat=$db->exec($query);

			echo '<p>Les informations ont été modifiées</p>';
		} else {
			echo '<p>Veuillez modifier les champs<span class="star"> *</span></p>';
		}
	} else {
		echo '<p>vous devez être connecté pour modifier les champs</p>';
	}

	$id=htmlspecialchars($_GET['id']);
	if(isset($_GET['page'])){
		$page=htmlspecialchars($_GET['page']);
	}
	echo '<p><a href="image.php?id='.$id.'&page='.$page.'">Annuler</a></p>';
	echo '<p><a href="index.php?page='.$page.'">&lt;&ndash; Retour galerie</a></p>';

	require_once('footer.inc.php');