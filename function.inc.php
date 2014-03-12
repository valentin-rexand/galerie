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