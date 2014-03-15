<?php
	
	$titre='ajout image';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');
	require_once('function.inc.php');
?>

	<form enctype="multipart/form-data" method="post">
		<label for="nom">Nom de l'image<span class="star"> *</span></label>
		<p><input type="text" id="nom" name="nom" value="<?php if(isset($_POST['nom'])){ $nom=htmlspecialchars($_POST['nom']); echo $nom;}else{ echo '';}?>"></p>
		<label for="description">Description<span class="star"> *</span></label>
		<p><textarea name="description" id="description" cols="100" rows="20"><?php if(isset($_POST['description'])){ $description=htmlspecialchars($_POST['description']);echo $description;}else{ echo '';}?></textarea></p>
		<input type="file" name="image"/>
		<input type="submit" value="upload"/>
	</form>

<?php
	if(isset($_SESSION['user'])){
		if(isset($_POST['nom']) && (!empty($_POST['nom'])) && (isset($_POST['description'])) && 
		 (!empty($_POST['description'])) && (isset($_FILES['image'])) && 
		 (!empty($_FILES['image']['name']))){
			
			$nom=htmlspecialchars($_POST['nom']);
			$descript=htmlspecialchars($_POST['description']);
			$files=htmlspecialchars($_FILES['image']['name']);

			// vérification du format de l'image soumise
			if((stripos($_FILES['image']['type'], 'jpg') || (stripos($_FILES['image']['type'], 'jpeg')) || (stripos($_FILES['image']['type'], 'png')) || (stripos($_FILES['image']['type'], 'gif')) || (stripos($_FILES['image']['type'], 'tiff'))) && (stripos($_FILES['image']['name'], ".php")===false)){

				echo '1 - '.$FILES['image']['type'].PHP_EOL;
				echo '2 - '.$FILES['image']['name'].PHP_EOL;
				echo $_SESSION['user']['login'];
				$succes_insert=insert_img($nom, $descript, $files, $_SESSION['user']['login']);

				if($succes_insert){
					move_uploaded_file($_FILES['image']['tmp_name'], "images/".$_FILES['image']['name']);

					echo '3 - '.$FILES['image']['tmp_name'].PHP_EOL;
					echo '4 - '.$FILES['image']['name'].PHP_EOL;
					echo '5 - '."images/".$_FILES['image']['name'];

					echo '<p>L\'image a été envoyée</p>';
				} else {
					echo '<p>une erreur est survenue</p>';
				}
			} else {
				echo '<p>Le format de l\'image est incorrect</p>';
			}
		} else {
			echo '<p>Veuillez remplir les champs<span class="star"> *</span></p>';
		}
	} else {
		echo '<p>vous devez être connecté pour ajouter une image</p>';
	}

	echo '<p><a href="index.php">accueil</a></p>';

	require_once('footer.inc.php');