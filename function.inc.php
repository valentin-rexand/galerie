<?php
	function get_image_by_page($current_page){
		global$db;
		global$config;
		$query="SELECT * FROM ".$config['table_image']." ORDER BY `date` DESC LIMIT ".($current_page*$config['img_par_page']).','.$config['img_par_page'];
		$resultat=$db->query($query);
		return $resultat;
	}

	function nbpage(){
		global $db;
		global $config;
		$sql="SELECT COUNT(id) AS count FROM ".$config['table_image'];
		$result=$db->query($sql);
		$taille_tableau=$result->fetchColumn();
		$nbrpage=ceil($taille_tableau/$config['img_par_page']);
		return $nbrpage;
	}

	function insert_img($nom, $auteur, $descript, $files){
		global$db;
		global$config;
		$query="INSERT INTO ".$config['table_image']." (nom, auteur, description, `date`, nom_fichier) 
				VALUES (".$db->quote($nom).", ".$db->quote($auteur).", ".$db->quote($descript).", NOW(), ".$db->quote($files).")";
		$resultat=$db->exec($query);
		return $resultat;
	}

	function get_image($id){
		global$db;
		global$config;
		$sql="SELECT * FROM ".$config['table_image']." WHERE id=".$db->quote($id);
		$resultat=$db->query($sql);
		return $resultat;
	}

	function update_image($nom, $auteur, $description, $id){
		global$db;
		global$config;
		$query="UPDATE ".$config['table_image']." SET nom=".$db->quote($nom).", auteur=".$db->quote($auteur).", description=".$db->quote($description).", `date`=NOW() WHERE id=".$db->quote($id);
		$resultat=$db->exec($query);
		return $resultat;
	}

	function delete_image($id){
		global$db;
		global$config;
		$supp="DELETE FROM ".$config['table_image']." WHERE id=".$db->quote($id)."LIMIT 1";
		$resultat=$db->exec($supp);
		return $resultat;
	}

	function navig ($current_page, $nbrpage){
		echo '<p class="nbr_nav">';
		if ($current_page>0){//($current_page+1)-1 donc $current_page (ce que croit l'utilisateur $current_page+1 et la page réelle -1)
			echo '<a href="index.php?page=1" class="first"><- first</a>'.PHP_EOL;
			echo '<a href="index.php?page='.$current_page.'" class="previous">Précédent</a>'.PHP_EOL;
		}
		
		for($i=1;$i<=$nbrpage;$i++){
			echo'<a href="index.php?page='.$i.'" class="chiffrenav">'.$i.'</a>';
		}
		
		if($current_page<$nbrpage-1){//$current_page+1 pr ce que l'on fait mais comme utilisateur sur page +1 ça donne +2
			echo '<a href="index.php?page='.($current_page+2).'" class="next">Suivant</a>'.PHP_EOL;
			echo '<a href="index.php?page='.$nbrpage.'" class="last">last -></a>'.PHP_EOL;
		}
		echo '</p>';
	}