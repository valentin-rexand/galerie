<?php
	$titre='inscription';
	require_once('header.inc.php');
	require_once('config.php');
	require_once('connexion.php');

	if((isset($_POST['login'])) && (!empty($_POST['login'])) && (isset($_POST['password'])) && (!empty($_POST['password'])) && (isset($_POST['mail'])) && (!empty($_POST['mail'])) && ($_POST['password']===$_POST['passwordconfirm'])){

		$sel='3a890dcdb';
		$login=htmlspecialchars($_POST['login']);
		$password=hash('sha512', $sel.htmlspecialchars($_POST['password']));
		$email=htmlspecialchars($_POST['mail']);

		$query="INSERT INTO user (`login`, `password`, `mail`)
		VALUES (".$db->quote($login).", ".$db->quote($password).", ".$db->quote($email).")";
		$resultat=$db->exec($query);

		if($resultat==false){
			echo '<p>erreur de création de votre compte</p>';
		} else {
			echo '<p>Votre compte utilisateur a été créé</p>';
			echo '<p><a href="index.php">retour galerie</a></p>';
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