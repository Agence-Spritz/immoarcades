<?
// FONCTION POUR REDIMENSIONNER LES IMAGES
function redimage($img_src,$img_dest,$dst_w,$dst_h) 
{	global $msg, $msgerror;

	// Lit les dimensions de l'image
	$size = GetImageSize($img_src);  
	$src_w = $size[0]; $src_h = $size[1]; 
			   
	// Teste les dimensions tenant dans la zone
	$test_h = round(($dst_w / $src_w) * $src_h);
	$test_w = round(($dst_h / $src_h) * $src_w);
	// Si Height final non précisé (0)
	if(!$dst_h) $dst_h = $test_h;
	// Sinon si Width final non précisé (0)
	elseif(!$dst_w) $dst_w = $test_w;
	// Sinon teste quel redimensionnement tient dans la zone
	elseif($test_h>$dst_h) $dst_w = $test_w;
		else $dst_h = $test_h;
		   
	// Crée une image vierge aux bonnes dimensions
	$dst_im = imagecreatetruecolor($dst_w,$dst_h);
	// Copie dedans l'image initiale redimensionnée
	$src_im = ImageCreateFromJpeg($img_src);
	
	//ImageCopyResized($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h); // moins bonne qualité + rapide
	imagecopyresampled ($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h); // meilleur qualité + lent + de ressources
		   
	// Sauve la nouvelle image
	if(ImageJpeg($dst_im,$img_dest)) {return($msg.="<br />Photo Redimenssionn&eacute;e : '".$img_dest."' (".$dst_w."x".$dst_h.")");}
	// Détruis les tampons
	ImageDestroy($dst_im); ImageDestroy($src_im);
				
	// Affiche le descritif de la vignette
	
}


// IMAGE EN FILIGRANE (EN PNG-8 UNIQUEMENT) 
function filigrane($photo,$filigrane)
{ 
$watermark = imagecreatefrompng($filigrane);  
$watermark_width = imagesx($watermark);  
$watermark_height = imagesy($watermark);  
$image = imagecreatetruecolor($watermark_width, $watermark_height);  
$image = imagecreatefromjpeg($photo);  
$size = getimagesize($photo);  
// Emplacement du filigrane
$dest_x = ($size[0]/2) - $watermark_width/2;
$dest_y = ($size[1]/2) - $watermark_height/2;

// impression du filigrane + transparence
imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 30);  
// affiche l'image BESOIN => NE PAS OUBLIER <?php header('content-type: image/jpeg');
//imagejpeg($image);  

// Sauve la nouvelle image
ImageJpeg($image,$photo,100);

imagedestroy($image);  
imagedestroy($watermark);  
}

// FONCTION ENVOI DES PHOTOS
function sent_photo($updatefile,$nom_tmp,$chemin)
{	global $msg, $msgerror;
	if ( $updatefile ) 
	{	//print "nom_tmp=$nom_tmp" ; 
      	if ( is_uploaded_file($nom_tmp) ) 
		{	if ( ! @move_uploaded_file($nom_tmp,$chemin.$updatefile) ) 
			{	$msgerror.=" - Echec de l'envoi du fichier.<br />"; }
			else {  $msg.=" - Photo(s) envoy&eacute;e(s).<br />";  }
      	} 
    }
}

//Vérifie l'existance d'une URL externe
function url_exists($url)
{	$fp=@fopen($url,"r");
	return ($fp)? 1 : 0;
}

// redim image
function redim_img_url($url,$largmax,$hautmax)
{	if (url_exists($url)==1) 
	{   list($w,$h) = getimagesize("$url") ;
		if ( $w > $largmax ) { $h = ( $h / $w ) * $largmax ; $w = $largmax ;}
    	if ( $h > $hautmax ) { $w = ( $w / $h ) * $hautmax ; $h = $hautmax ; }
		print "<img class='mignature' src='".$url."?".time()."' width=$w height=$h >";
	} /*else { 	print "<img src='img/no.jpg' width=$largmax height=146 border=0 class='tablebordrose'>";}*/
}

// redim image
function redim_img_url_carre($url,$largmax)
{	if (url_exists($url)==1) 
	{   echo "<img src='".$url."?".time()."' width='".$largmax."' style='padding:0' >";
	} /*else { 	print "<img src='img/no.jpg' width=$largmax height=146 border=0 class='tablebordrose'>";}*/
}

// DATE EN FORMAT JJ/MM/AAA
function date_barre($ladate)
{	$expld=explode('-',$ladate,3); $annee=$expld[0]; $mois=$expld[1]; $jour=$expld[2];
	return $jour."/".$mois."/".$annee ;
}
// DATE EN FORMAT AAAA-MM-JJ
function date_tiret($ladate)
{	$expld=explode('/',$ladate,3); $jour=$expld[0]; $mois=$expld[1]; $annee=$expld[2];
	return $annee."-".$mois."-".$jour ;
}

// FUNCTION EFFACER FOLDER+CONTENU
function del_dir($dirName) {
   if(empty($dirName)) {
       return;
   }
   if(file_exists($dirName)) {
       $dir = dir($dirName);
       while($file = $dir->read()) {
           if($file != '.' && $file != '..') {
               if(is_dir($dirName.'/'.$file)) {
                   delDir($dirName.'/'.$file);
               } else {
                   @unlink($dirName.'/'.$file) or die('File '.$dirName.'/'.$file.' couldn\'t be deleted!');
               }
           }
       }
       @rmdir($dirName.'/'.$file) or die('Folder '.$dirName.'/'.$file.' couldn\'t be deleted!');
   } else {
       echo 'Folder "<b>'.$dirName.'</b>" doesn\'t exist.';
   }
}


// AFFICHE LES RUBRIQUE EN TEXTE
function stock($valeur,$lg)
{	if ($valeur=="1 à 5 jours" && $lg=="fr") {echo "<span   title='Délai de livraison généralement constaté : 1 à 5 jours ouvrés'> <img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'></span>";}
	elseif ($valeur=="1 à 5 jours" && $lg=="nl") {echo "<span   title='Vasstelling van levering termijn in het algemeen waargenomen 1 tot 5 werkdagen'> <img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'></span>";}
	elseif ($valeur=="1 à 5 jours" && $lg=="uk") {echo "<span   title='Delivery time around 1 to 5 working days'> <img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'></span>";}
	
	elseif ($valeur=="1 à 10 jours" && $lg=="fr") {echo "<span   title='Délai de livraison généralement constaté : 1 à 10 jours ouvrés'><img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'><img src='../img/stock-rouge.gif'></span>";}
	elseif ($valeur=="1 à 10 jours" && $lg=="nl") {echo "<span   title='Vasstelling van levering termijn in het algemeen waargenomen 1 tot 10 werkdagen'><img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'><img src='../img/stock-rouge.gif'></span>";}
	elseif ($valeur=="1 à 10 jours" && $lg=="uk") {echo "<span   title='Delivery time around 1 to 10 working days'><img src='../img/stock-vert.gif'><img src='../img/stock-vert.gif'><img src='../img/stock-rouge.gif'></span>";}
	
	elseif ($valeur=="1 à 20 jours" && $lg=="fr") {echo "<span   title='Délai de livraison généralement constaté : 1 à 20 jours ouvrés'><img src='../img/stock-vert.gif'><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'></span>";}
	elseif ($valeur=="1 à 20 jours" && $lg=="nl") {echo "<span   title='Vasstelling van levering termijn in het algemeen waargenomen 1 tot 20 werkdagen'><img src='../img/stock-vert.gif'><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'></span>";}
	elseif ($valeur=="1 à 20 jours" && $lg=="uk") {echo "<span   title='Delivery time around 1 to 20 working days'><img src='../img/stock-vert.gif'><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'></span>";}
	
	elseif ($valeur=="Rupture" && $lg=="fr") {echo "<span   title='Rupture'><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'></span>";}
	elseif ($valeur=="Rupture" && $lg=="nl") {echo "<span   title=''><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'></span>";}
	elseif ($valeur=="Rupture" && $lg=="uk") {echo "<span   title='Out of stock'><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'><img src='../img/stock-rouge.gif'></span>";}

	else {print "Error Fonction rub !";}
}
?>