<?php
	$titre='connection';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');
?>


<?php
	if(isset($_SESSION['admin'])){
		echo '<p>Bonjour Admin<br/><a href="index.php">Accueil</a></p>';
	} else {
		if(isset($_POST['mdp']) && ($_POST['mdp']==$config['adminpass'])){
			$_SESSION['admin']=true;
			echo '<p>Bonjour Admin<br/><a href="index.php">Accueil</a></p>';
		} else {
?>
		<form method="post">
			<label for="mdp">password</label>
			<p><input type="password" id="mdp" name="mdp"/></p>
			<p><input type="submit" value="Valider"/></p>
		</form>
<?php
		}
	}

	require_once('footer.inc.php');