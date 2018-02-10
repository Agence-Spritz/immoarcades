<?php  
// META NOM DE SOCIETE	
	$Q=mysqli_query($link, "SELECT nom_titre_meta FROM ".$table_prefix."_divers WHERE ID=1 ");
	
	list($nom_titre_meta) = mysqli_fetch_array($Q);

	list($titre,$keywords,$description) = mysqli_fetch_array(mysqli_query($link, "SELECT titre,keywords,description FROM ".$table_prefix."_referencement WHERE page=\"$pg\" AND lg=\"$lg\""));

  	if ( !$titre ) 
	{	if ( is_array($sousmenus) ) 
		{	$titre = $sousmenus[1][array_search($pg,$sousmenus[0])];
    	} else {	list($titre) = mysqli_fetch_array(mysqli_query($link, "SELECT titre FROM ".$table_prefix."_referencement WHERE page=\"DEFAULT\" AND lg=\"$lg\""));	  }
  	}
  	


  	if ( !$keywords ) 
	{	list($keywords) = mysqli_fetch_array(mysqli_query($link, "SELECT keywords FROM ".$table_prefix."_referencement WHERE page=\"DEFAULT\" AND lg=\"$lg\""));
  	}

  	if ( !$description ) 
	{	list($description) = mysqli_fetch_array(mysqli_query($link, "SELECT description FROM ".$table_prefix."_referencement WHERE page=\"DEFAULT\" AND lg=\"$lg\""));
  	}
	 
// OPEN GRAPH
$ogimg='http://'.$_SERVER[HTTP_HOST].dirname($_SERVER["PHP_SELF"]).'/apple-touch-icon.png';
$ogtitre='Immobilière des Arcades, vente et location de biens immobilier à Tourcoing et Lys-lez-Lannoy.';
$ogdescr='Depuis 2 générations, l’agence IMA de Tourcoing compte parmi les plus actives agences immobilières tourquennoise. Ceci, grâce en partie à son équipe expérimentée et  pro-active dans les démarches d’achats/ventes de votre maison, appartement, villa ou immeuble de rapport. ';


  // METAS SPECIAUX PAGES

  
  
  
  // Actualités
  if ($pg=='detail-actu' )
  {	
	$table = $table_prefix."_pages"; 
	  
  	$Q = mysqli_query($link, "SELECT ID,titre,texte FROM $table WHERE ID='$id'");
  	list($IDmeta,$titremeta,$textemeta,$rubmeta) = mysqli_fetch_array($Q);
	$textemeta=strip_tags($textemeta);
	$titre=$titremeta;
	
	$description=substr($textemeta,0,250);
	$keywords=motcle($titremeta).",".motcle($description);
  	$ogimg='http://'.$_SERVER[HTTP_HOST].dirname($_SERVER["PHP_SELF"]).'/images/pages-immobilier-tourcoing-lys-les-lannoy/'.$id.'.jpg';
	$ogtitre=$titremeta;
	$ogdescr=$description;
  } 
  
    // Fiche bien
  if ($pg=='fiche' )
  {	
	$table = $table_prefix."_biens"; 
	
	$req = mysqli_query($link,"SELECT ID,type,localite,cat,titre,descrlight, PHOTO_01 FROM ".$table." WHERE ID='$id'"); 
		$data = mysqli_fetch_array($req);
	  
  	
  		$offre = $data['cat'];
  		$IDmeta = $data['ID'];
  		$typemeta = $data['type'];
  		$titremeta = $data['titre'];
  		$textemeta = $data['descrlight'];
  		$localite = $data['localite'];
  		$image = $data['PHOTO_01'];
		
		if ($offre=='L') {
			$libele_offre = "à louer";
		} else if ($offre=='V') {
			$libele_offre = "à vendre";
		} else if ($offre=='N') {
			$libele_offre = "projet neuf";
		}
  	
	$textemeta=strip_tags($textemeta);
	$titre=$typemeta.' '.$libele_offre.' : '.$titremeta;
	
	$description=substr($textemeta,0,250);
	$keywords=motcle($titremeta).",".motcle($description);
  	$ogimg=$image;
	$ogtitre=$titremeta;
	$ogdescr=$description;
  } 
  
  
   

  
$titre = preg_replace("/''/","`",strip_tags($titre)); $titre = preg_replace("/(\r\n|\n|\r)/", " ", $titre); 
$description = preg_replace("/'/","`",strip_tags($description )); $description = preg_replace("/(\r\n|\n|\r)/", " ", $description); 
$keywords= preg_replace("/'/","`",strip_tags($keywords)); 
  
  ?>
<title><?=$titre?></title>
<meta name="description" content="<?=$description?>">
<meta name="keywords" content="<?=$keywords?>">
<link rel="icon" href="favicon.ico" type="image/ico">
<link rel="apple-touch-icon" type="image/png" href="apple-touch-icon.png" />

<meta property="og:type" content="website" />
<meta property="og:url" content="http://<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>" />
<meta property="og:image" content="<?=$ogimg?>" /><!-- minimum 200x200px -->
<meta property="og:title" content="<?=$ogtitre?>" />
<meta property="og:description" content="<?=$ogdescr?>" />