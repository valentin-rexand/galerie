<?php
	
	$titre='ajout image';
	require_once('header.inc.php');
	require_once('config.php');

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
	if(isset($_POST['nom']) && (!empty($_POST['nom'])) && (isset($_POST['auteur'])) && (!empty($_POST['auteur'])) && (isset($_POST['description'])) && (!empty($_POST['edescription'])) && (isset($_FILES['image']))){
		$query="INSERT INTO galerie_php (nom, auteur, description, `date`, nom_fichier) 
		VALUES (".$db->quote($_POST['nom']).",".$db->quote($_POST['auteur']).",".$db->quote($_POST['description']).",NOW(),".$db->quote($_FILES['image']).")";
		//$resultat=$db->exec($query);
		echo '<p>L\'image a été envoyée</p>';
	} else {
		echo '<p>Veuillez remplir les champs<span class="star"> *</span></p>';
	}

	/*if(isset($_FILES['image'])){
		move_uploaded_file($_FILES['image']['tmp_name'], $_FILES['image']['image']);
	}*/

	echo '<p><a href="index.php">accueil</a></p>';

	require_once('footer.inc.php');