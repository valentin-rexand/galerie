<?php
	
	$titre='ajout image';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');

?>

	<form enctype="multipart/form-data" method="post">
		<label for="nom">Nom de l'image<span class="star"> *</span></label>
		<p><input type="text" id="nom" name="nom" value="<?php if(isset($_POST['nom'])){ $nom=htmlspecialchars($_POST['nom']); echo $nom;}else{ echo '';}?>"></p>
		<label for="auteur">Auteur<span class="star"> *</span></label>
		<p><input type="text" id="auteur" name="auteur" value="<?php if(isset($_POST['auteur'])){ $auteur=htmlspecialchars($_POST['auteur']); echo $auteur;}else{ echo '';}?>"></p>
		<label for="description">Description<span class="star"> *</span></label>
		<p><textarea name="description" id="description" cols="100" rows="20"><?php if(isset($_POST['description'])){ $description=htmlspecialchars($_POST['description']);echo $description;}else{ echo '';}?></textarea></p>
		<input type="file" name="image"/>
		<input type="submit" value="upload">
	</form>

<?php
	if(isset($_POST['nom']) && (!empty($_POST['nom'])) && (isset($_POST['auteur'])) && (!empty($_POST['auteur'])) && (isset($_POST['description'])) && (!empty($_POST['description'])) && (isset($_FILES['image'])) && (!empty($_FILES['image']['name']))){
		
		$nom=$db->quote($_POST['nom']);
		$auteur=$db->quote($_POST['auteur']);
		$descript=$db->quote($_POST['description']);
		$files=$db->quote($_FILES['image']['name']);

		$query="INSERT INTO galerie_php (nom, auteur, description, `date`, nom_fichier) 
		VALUES (".$nom.",".$auteur.",".$descript.",NOW(),".$files.")";
		$resultat=$db->exec($query);

		move_uploaded_file($_FILES['image']['tmp_name'], "images/".$_FILES['image']['name']);
		echo '<p>L\'image a été envoyée</p>';
	} else {
		echo '<p>Veuillez remplir les champs<span class="star"> *</span></p>';
	}


	echo '<p><a href="index.php">accueil</a></p>';

	require_once('footer.inc.php');