<?php

//function de filtre, création d'un paramètre ligne, si l'image commence par un point elle renvoie true
	function filtre ($ligne){
		if ($ligne[0]!= '.'){
			return true;
		} else {
			return false;
		}
	}