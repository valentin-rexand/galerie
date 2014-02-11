<?php
	
	$titre='image';
	require_once('header.inc.php');

	if(isset($_GET['name'])&&file_exists('images/'.$_GET['name'])){
			$chars=htmlspecialchars($_GET['name']);
	echo '<img src="images/'.$chars.'" alt="Image '.$chars.'"/>';
	}

	echo '<p><a href="index.php">&lt;&ndash; Retour galerie</a></p>';

	require_once('footer.inc.php');
