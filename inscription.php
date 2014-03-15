<?php
	$titre='inscription';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');
	require_once('function.inc.php');

	if((isset($_POST['login'])) && (!empty($_POST['login'])) && (isset($_POST['password'])) && (!empty($_POST['password'])) && (isset($_POST['mail'])) && (!empty($_POST['mail'])) && ($_POST['password']===$_POST['passwordconfirm'])){

		$login=$db->quote(htmlspecialchars($_POST['login']));
		$password=$db->quote(hash('sha512', $config['sel'].htmlspecialchars($_POST['password'])));
		$email=$db->quote(htmlspecialchars($_POST['mail']));

		//vérification de la non-existence du login rentré, dans la base de donné
		$query="SELECT id FROM user WHERE login=".$login;
		$resultat=$db->query($query);
		$ligne=$resultat->fetchColumn();

		//vérification de la non-existence du mail rentré, dans la base de donné
		$requete="SELECT id FROM user WHERE mail=".$email;
		$result=$db->query($requete);
		$ligne2=$result->fetchColumn();

			if($ligne){
				echo '<p>Ce nom d\'utilisateur existe déjà</p>';
				echo '<p><a href="inscription.php">annuler</a></p>';
			} elseif ($ligne2){
				echo '<p>Cet adresse email est déjà utilisée</p>';
				echo '<p><a href="inscription.php">annuler</a></p>';
			} else {
				$succes_inscript=user_inscript($login, $password, $email);

				if($succes_inscript==false){
					echo '<p>erreur de création de votre compte</p>';
				} else {
					echo '<p>Votre compte utilisateur a été créé</p>';
					echo '<p><a href="index.php">retour galerie</a></p>';
				}
			}
	} else {
?>
<form method="post">
	<label for="login">Login</label>
	<p><input type="text" id="login" name="login" value="<?php if(isset($_POST['login'])){$login=htmlspecialchars($_POST['login']);echo$login;}else{ echo '';}?>"/></p>

	<label for="password">Password</label>
	<p><input type="password" id="password" name="password"/></p>

	<label for="passwordconfirm">Confirm Password</label>
	<p><input type="password" id="passwordconfirm" name="passwordconfirm"/></p>


	<label for="mail">Email</label>
	<p><input type="email" id="mail" name="mail" value="<?php if(isset($_POST['mail'])){$email=htmlspecialchars($_POST['mail']);echo $email;}else{ echo '';}?>"/></p>

	<p><input type="submit" value="Valider"/></p>
</form>
<?php
	echo '<p>Veuillez remplir les champs</p>';
	}

	require_once('footer.inc.php');