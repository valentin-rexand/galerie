<?php
	
	$titre='image';
	require_once('header.inc.php');
	require_once('config.php');

	if(isset($_GET['id'])){
			$id=$db->quote($_GET['id']);
			$requete="SELECT * FROM galerie_php WHERE id=".$id;
			$resultat=$db->query($requete);
			foreach($resultat as $ligne){
				$ligne_nom=$ligne['nom'];
				$ligne_auteur=$ligne ['auteur'];
				$ligne_description=$ligne ['description'];
			}
		}
	?>


	<form method="post">
		<label for="nom">Nom de l'image<span class="star"> *</span></label>
		<p><input type="text" id="nom" name="nom" value="<?php if(isset($_POST['nom'])){ $nom=htmlspecialchars($_POST['nom']); echo $nom;}else{ echo '';}?>"></p>
		<label for="auteur">Auteur<span class="star"> *</span></label>
		<p><input type="text" id="auteur" name="auteur" value="<?php if(isset($_POST['auteur'])){ $auteur=htmlspecialchars($_POST['auteur']); echo $auteur;}else{ echo '';}?>"></p>
		<label for="description">Description<span class="star"> *</span></label>
		<p><textarea name="description" id="description" cols="100" rows="20"><?php if(isset($_POST['description'])){ $description=htmlspecialchars($_POST['description']);echo $description;}else{ echo '';}?></textarea></p>
		<p><input type="submit" value="valider"></p>
	</form>

	<?php

		if(isset($_POST['nom']) && (!empty($_POST['nom'])) && (isset($_POST['auteur'])) && (!empty($_POST['auteur'])) && (isset($_POST['description'])) && (!empty($_POST['description']))){

			//modification du contenu par l'utilisateur
			$id=$db->quote($_GET['id']);
			$query="UPDATE galerie_php SET nom=".$db->quote($_POST['nom']).", auteur=".$db->quote($_POST['auteur']).", description=".$db->quote($_POST['description']).", `date`=NOW() WHERE id=".$id;
			$resultat=$db->exec($query);

			echo '<p>Les informations ont été modifiées</p>';
		} else {
			echo '<p>Veuillez modifier les champs<span class="star"> *</span></p>';
		}

	$id=htmlspecialchars($_GET['id']);
	echo '<p><a href="image.php?id='.$id.'">Annuler</a></p>';
	echo '<p><a href="index.php">&lt;&ndash; Retour galerie</a></p>';

	require_once('footer.inc.php');