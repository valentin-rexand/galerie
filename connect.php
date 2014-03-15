<?php
	$titre='connexion';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');
	require_once('function.inc.php');

	if(!isset($_SESSION['user'])){

		if((!isset($_POST['mdp'])) || (!isset($_POST['login'])) || (empty($_POST['mdp'])) || (empty($_POST['login']))){
?>
		<form method="post">
			<label for="login">Login</label>
			<p><input type="text" id="login" name="login"></p>

			<label for="mdp">Password</label>
			<p><input type="password" id="mdp" name="mdp"/></p>

			<p><input type="submit" value="Valider"/></p>
		</form>
<?php
		echo '<p><a href="index.php">Accueil</a></p>';
		} else {
			if((isset($_POST['mdp'])) && (isset($_POST['login']))){
				$login=htmlspecialchars($_POST['login']);
				$mdp=hash('sha512', $config['sel'].htmlspecialchars($_POST['mdp']));
				if($user = connect_user($login, $mdp)){
					$_SESSION['user']=$user;
					echo '<p>Bonjour '.$login.'<br/><a href="index.php">Accueil</a></p>';
				} else {
					echo '<p>Cet utilisateur n\'existe pas ou votre mot de passe est incorrect</p>';
					echo '<p><a href="connect.php">Annuler</a></p>';
				}
			}
		}
	} else {
		echo '<p>Bonjour '.$_SESSION['user']['login'].'<br/><a href="index.php">Accueil</a></p>';
	}

	require_once('footer.inc.php');