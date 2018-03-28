<?php 
	include "include/menu-new.php";
	
	$path = realpath(dirname(__FILE__));
	
	$zip = new ZipArchive;
if ($zip->open($path.'/kaio/ima.zip') === TRUE) {
    $zip->extractTo($path.'/kaio/');
    $zip->close();
    echo '<div class="alert alert-success" role="alert">Flux dézippé et enregistré à la bonne destination</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Problème lors du dézippage du flux</div>';
}

?>

<meta http-equiv="Content-Type" content="text/html;  charset="UTF-8"> 

<?php
//ini_set('display_errors', 0);
set_time_limit (300); // Temps max du script 0=illimit�
include "./inc/openDB.txt";

$erreur = 0;

// 1 SIMPLEXML PARSE
	$fichierXML = file_get_contents($path.'/kaio/ima.xml');
	
	$fichierXML = preg_replace('/xmlns[^=]*="[^"]*"/i', '',preg_replace('/(<\/?)(\w+):([^>]*>)/', '$1$3', $fichierXML));
	$fichierXML = str_replace(']]&gt;','',str_replace('&lt;![CDATA[','',$fichierXML));
	$fichierXML = preg_replace('/"/',"'",stripslashes($fichierXML));


	try {
	   $xml = new SimpleXMLElement($fichierXML);
	   echo '<div class="alert alert-success" role="alert">Flux valide</div>';
	} catch (Exception $e) {
	   // handle the error
	   	echo '<div class="alert alert-danger" role="alert">$fichierXML est invalide</div>';
	   	$message = '<div class="alert alert-danger" role="alert">Flux invalide</div>';
		$erreur = 1;
	}

	// On affiche le flux, si besoin
	//var_dump($xml); 
	
	// On compte le nombre de biens présents dans le flux.
	$Nbr = $xml->count();
	echo "<div class='alert alert-success' role='alert'>Le flux comporte : ".$Nbr." biens</div>";
	

// 2 - VIDE LA TABLE BIENS
// ! Ne pas oublier de réactiver l'effacement de la table !
	if ($Nbr>10 ) { 
		
		if (mysqli_query($link,"TRUNCATE ".$table_prefix."_biens")) {
			echo '<div class="alert alert-success" role="alert">La table précédente a correctement été effacée</div>';
		} else {
			$erreur = 1;
			echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'effacement de la table précédente</div>';
			
		}
	}	
	
	
	$n=0;
// 3 RECUPERATION DES VALEURS

	foreach ($xml->bien as $bien) {
		
		$n++;
		
		// On crée nos variables
		$ref = $bien->reference;
		$venduloue = NULL;
		$mandat = $bien->num_mandat;
		$nom_agence = preg_replace("/'/","`",stripslashes($bien->nom_agence));
		$ville_agence = preg_replace("/'/","`",stripslashes($bien->ville_agence));
		// On créé un num pour l'agence
		if($ville_agence=='Tourcoing') {
			// Tourcoing : 1
			$agence = 1;
		} else {
			// Lys les Lannoy : 2
			$agence = 2;
		}
		$nannee = NULL;
		$pays = $bien->nom_pays;
		$codepostal = $bien->code_postal;
		$localite=preg_replace("/'/","`",stripslashes($bien->ville));
		$quartier = preg_replace("/'/","`",stripslashes($bien->proximite));
		$titre=preg_replace("/'/","`",stripslashes($bien->type_bien));
		$descrlight=preg_replace("/'/","`",stripslashes($bien->description_internet));
		$type_transaction = $bien->type_transaction;
		if($type_transaction=='vente' || $type_transaction=='Vente') {
			$cat = "V";
		} else {
			$cat = NULL;
		}
		
		$surfjardin = $bien->surface_jardin;
		if($surfjardin >=1) {
			$jardin = 1;
		} else {
			$jardin = 0;
		}
		$surfhab = $bien->surface_habitable;
		$terrasse = $bien->terrasse;
		$cetat = NULL;
		$type = preg_replace("/'/","`",stripslashes($bien->type_bien));
		$dbu=date("Y-m-d");
		$dmod=date("Y-m-d");
		$prix = $bien->prix;
		$prix_fai = $bien->fai;
		$cacherprix = 0;
		$qgarages = $bien->nb_parking_interieur;
		$qparking = $bien->nb_parking_exterieur;
		$qpieces = $bien->nb_piece;
		$qchambres = $bien->nb_chambre;
		$qsdb = $bien->nb_sdb;
		$qwc = $bien->nb_wc;
		$etage = $bien->etage;
		$nb_etage = $bien->nb_etage;
		$longitude = $bien->gps_longitude;
		$latitude = $bien->gps_latitude;
		$masquer_adresse = 0;
		$cave = $bien->nb_cave;
		$ascenseur = $bien->ascenseur;
		$balcon = $bien->balcon;
		$chauffage = preg_replace("/'/","`",stripslashes($bien->type_chauffage));
		$type_cuisine = $bien->type_cuisine;
		$dispoquand = NULL;
		$virtuel = $bien->url_vv;
		$dep = $bien->valeur_energie;
		$ges = $bien->valeur_ges;
		$bilan_energie = $bien->bilan_energie;
		$bilan_ges = $bien->bilan_ges;
		$composition = NULL;
		
		$nouveaute = 1;
		
		// On récupére les photos
		$set_image = $bien->images;
		$image_path = base_url().'kaio';
		
		if($set_image->image[0]) {
			$photo_01 = $image_path."/".$set_image->image[0];
		} else {
			$photo_01 = NULL;
		}
		
		if($set_image->image[1]) {
			$photo_02 = $image_path."/".$set_image->image[1];
		} else {
			$photo_02 = NULL;
		}
		
		if($set_image->image[2]) {
			$photo_03 = $image_path."/".$set_image->image[2];
		} else {
			$photo_03 = NULL;
		}
		
		if($set_image->image[3]) {
			$photo_04 = $image_path."/".$set_image->image[3];
		} else {
			$photo_04 = NULL;
		}
		
		if($set_image->image[4]) {
			$photo_05 = $image_path."/".$set_image->image[4];
		} else {
			$photo_05 = NULL;
		}
		
		if($set_image->image[5]) {
			$photo_06 = $image_path."/".$set_image->image[5];
		} else {
			$photo_06 = NULL;
		}
		
		if($set_image->image[6]) {
			$photo_07 = $image_path."/".$set_image->image[6];
		} else {
			$photo_07 = NULL;
		}
		
		if($set_image->image[7]) {
			$photo_08 = $image_path."/".$set_image->image[7];
		} else {
			$photo_08 = NULL;
		}
		
		if($set_image->image[8]) {
			$photo_09 = $image_path."/".$set_image->image[8];
		} else {
			$photo_09 = NULL;
		}
		
		if($set_image->image[9]) {
			$photo_10 = $image_path."/".$set_image->image[9];
		} else {
			$photo_10 = NULL;
		}
		
		if($set_image->image[10]) {
			$photo_11 = $image_path."/".$set_image->image[10];
		} else {
			$photo_11 = NULL;
		}
		
		if($set_image->image[11]) {
			$photo_12 = $image_path."/".$set_image->image[11];
		} else {
			$photo_12 = NULL;
		}
		
		if($set_image->image[12]) {
			$photo_13 = $image_path."/".$set_image->image[12];
		} else {
			$photo_13 = NULL;
		}
		
		if($set_image->image[13]) {
			$photo_14 = $image_path."/".$set_image->image[13];
		} else {
			$photo_14 = NULL;
		}
		
		if($set_image->image[14]) {
			$photo_15 = $image_path."/".$set_image->image[14];
		} else {
			$photo_15 = NULL;
		}
		
		if($set_image->image[15]) {
			$photo_16 = $image_path."/".$set_image->image[15];
		} else {
			$photo_16 = NULL;
		}
		
		if($set_image->image[16]) {
			$photo_17 = $image_path."/".$set_image->image[16];
		} else {
			$photo_17 = NULL;
		}
		
		if($set_image->image[17]) {
			$photo_18 = $image_path."/".$set_image->image[17];
		} else {
			$photo_18 = NULL;
		}
		
		if($set_image->image[18]) {
			$photo_19 = $image_path."/".$set_image->image[18];
		} else {
			$photo_19 = NULL;
		}
		
		if($set_image->image[19]) {
			$photo_20 = $image_path."/".$set_image->image[19];
		} else {
			$photo_20 = NULL;
		}
		
		
	
		// On crée les variables des images
		//$p=1;
	
		
/*
		foreach ($set_image->image as $image) {
			//$compteur = sprintf("%02d", $p);

			$liste_colonnes .= "`PHOTO_".$p."`,";
			
			$liste_photos .= "'".${"PHOTO_".$p} = $image_path."/".$image."',";
			
			
			$p++;
		}
*/
		
		
		
		
// 3 ON REMPLIT LA TABLE
		if ($n>0) {
			
			mysqli_query($link,"INSERT INTO ".$table_prefix."_biens ( 
			`ID`,
			`ref`,
			`venduloue`,
			`mandat`,
			`nom_agence`,
			`ville_agence`,
			`agence`,
			`nannee`,
			`pays`,
			`codepostal`,
			`localite`,
			`quartier`,
			`titre`,
			`descrlight`,
			`type_transaction`,
			`cat`,
			`surfjardin`,
			`jardin`,
			`surfhab`,
			`terrasse`,
			`cetat`,
			`type`,
			`dbu`,
			`dmod`,
			`PHOTO_01`,
			`PHOTO_02`,
			`PHOTO_03`,
			`PHOTO_04`,
			`PHOTO_05`,
			`PHOTO_06`,
			`PHOTO_07`,
			`PHOTO_08`,
			`PHOTO_09`,
			`PHOTO_10`,
			`PHOTO_11`,
			`PHOTO_12`,
			`PHOTO_13`,
			`PHOTO_14`,
			`PHOTO_15`,
			`PHOTO_16`,
			`PHOTO_17`,
			`PHOTO_18`,
			`PHOTO_19`,
			`PHOTO_20`,
			`prix`,
			`prix_fai`,
			`cacherprix`,
			`qgarages`,
			`qparking`,
			`qpieces`,
			`qchambres`,
			`qsdb`,
			`qwc`,
			`etage`,
			`nb_etage`,
			`longitude`,
			`latitude`,
			`masquer_adresse`,
			`cave`,
			`ascenseur`,
			`balcon`,
			`chauffage`,
			`type_cuisine`,
			`dispoquand`,
			`virtuel`,
			`dep`,
			`ges`,
			`bilan_energie`,
			`bilan_ges`,
			`composition`,
			`nouveaute`
			) 
			VALUES (
			'',
			'".$ref."',
			'".$venduloue."',
			'".$mandat."',
			'".$nom_agence."',
			'".$ville_agence."',
			'".$agence."',
			'".$nannee."',
			'".$pays."',
			'".$codepostal."',
			'".$localite."',
			'".$quartier."',
			'".$titre."',
			'".$descrlight."',
			'".$type_transaction."',
			'".$cat."',
			'".$surfjardin."',
			'".$jardin."',
			'".$surfhab."',
			'".$terrasse."',
			'".$cetat."',
			'".$type."',
			'".$dbu."',
			'".$dmod."',
			'".$photo_01."',
			'".$photo_02."',
			'".$photo_03."',
			'".$photo_04."',
			'".$photo_05."',
			'".$photo_06."',
			'".$photo_07."',
			'".$photo_08."',
			'".$photo_09."',
			'".$photo_10."',
			'".$photo_11."',
			'".$photo_12."',
			'".$photo_13."',
			'".$photo_14."',
			'".$photo_15."',
			'".$photo_16."',
			'".$photo_17."',
			'".$photo_18."',
			'".$photo_19."',
			'".$photo_20."',
			'".$prix."',
			'".$prix_fai."',
			'".$cacherprix."',
			'".$qgarages."',
			'".$qparking."',
			'".$qpieces."',
			'".$qchambres."',
			'".$qsdb."',
			'".$qwc."',
			'".$etage."',
			'".$nb_etage."',
			'".$longitude."',
			'".$latitude."',
			'".$masquer_adresse."',
			'".$cave."',
			'".$ascenseur."',
			'".$balcon."',
			'".$chauffage."',
			'".$type_cuisine."',
			'".$dispoquand."',
			'".$virtuel."',
			'".$dep."',
			'".$ges."',
			'".$bilan_energie."',
			'".$bilan_ges."',
			'".$composition."',
			'".$nouveaute."'
			)
			");	
			
			
			
						
			
			echo $n." : Enregistrement du bien réf.: ".$ref."<br />";
			
			$erreur = 0;
			$message = "<div class='alert alert-success' role='alert'>Félicitations, tous les enregistrements ont été réalisés avec succès</div>";
			
		} else {
			$erreur = 1;
			$message = "<div class='alert alert-danger' role='alert'>Problème au niveau de la taille du flux</div>"; 
		}
		
		
	} 

		echo $message;
		
		// Deconnexion de la base de donnees
mysqli_close($link);
	
?>