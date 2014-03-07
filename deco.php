<?php
session_start();
if(isset($_GET['deco'])){
	$deco=htmlspecialchars($_GET['deco']);
    session_destroy();
    header('Location: index.php');
}