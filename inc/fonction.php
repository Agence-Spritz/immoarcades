<?php
  function prixsepar($valeur) {
  // Insère des séparateurs de milliers dans les valeurs monétaires
    $valeur = strrev($valeur);
    for ( $e = 0 ; $e <= strlen($valeur) ; $e++ ) {
      if ( $f == 6 || $f == 9 ) {
	if ( substr($valeur, $e, 1) != "" ) {
	  $conv = $conv . " " . substr($valeur, $e, 1);
	  $f = 0;
	}
      } else {
	$conv = $conv . substr($valeur, $e, 1);
      }
      $f++;
    }
    return( strrev($conv) ) ;
  }

//Date en français
// DATE EN FRANCAIS
function date_fr($ladate) { 
if ($ladate>0) 
	{	$expld=explode('-',$ladate,3); $annee=$expld[0]; $mois=$expld[1]; $jour=$expld[2];
		$jours = array("Le dimanche", "Le lundi", "Le mardi", "Le mercredi", "Le jeudi", "Le vendredi", "Le samedi"); 
		$lemois = array("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "D&eacute;cembre"); 
	}	return $jours[date("w", mktime(0, 0, 0, $mois, $jour , $annee))]." ".date("j", mktime(0, 0, 0, $mois, $jour, $annee)).(date("j", mktime(0, 0, 0, $mois, $jour, $annee)) == 1 ? "er " : " "). $lemois[date("n", mktime(0, 0, 0, $mois, $jour, $annee))-1]." $annee";
}

// VERIFIE LES EMAILS
function check_mail($email){
	if ( $_SERVER['HTTP_HOST']=="127.0.0.1" || $_SERVER['HTTP_HOST']=="" ) {return (TRUE); print "en local";} //Pour chunter la vérification mail MX en LOCAL
	else{
		$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]'; 
		$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; 								   
		$regex = '/^' . $atom . '+' .'(\.' . $atom . '+)*' .'@' .'(' . $domain . '{1,63}\.)+' .$domain . '{2,63}$/i';          
			// test de l'adresse e-mail
			$ledomaine = explode ('@',$email,2);
			if (preg_match($regex, $email) && checkdnsrr($ledomaine[1],"MX") === TRUE) {return true;} else {return false;}
	}
}

// Mois EN FRANCAIS
function mois_fr($date) { 

$date=str_replace("January","Janvier",$date);
$date=str_replace("February","Février",$date);
$date=str_replace("March","Mars",$date);
$date=str_replace("April","Avril",$date);
$date=str_replace("May","Mai",$date);
$date=str_replace("June","Juin",$date);
$date=str_replace("July","Juillet",$date);
$date=str_replace("August","Août",$date);
$date=str_replace("September","Septembre",$date);
$date=str_replace("October","Octobre",$date);
$date=str_replace("November","Novembre",$date);
$date=str_replace("December","Décembre",$date);
//... et ainsi de suite pour tout les jours et mois
return ($date);
}	

// NETTOYAGE TEXTE
function clean_texte($txt)
{	$txt = trim($txt); $txt = preg_replace("/\n/","<br>",stripslashes($txt));
	print $txt;
}

// VERIFIE LES EMAILS
function check_email($email){
	if ( $_SERVER['HTTP_HOST']=="127.0.0.1" || $_SERVER['HTTP_HOST']=="" ) {return (TRUE); print "en local";} //Pour chunter la vérification mail MX en LOCAL
	else{
		$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]'; 
		$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; 								   
		$regex = '/^' . $atom . '+' .'(\.' . $atom . '+)*' .'@' .'(' . $domain . '{1,63}\.)+' .$domain . '{2,63}$/i';          
			// test de l'adresse e-mail
			$ledomaine = explode ('@',$email,2);
			if (preg_match($regex, $email) && checkdnsrr($ledomaine[1],"MX") === TRUE) {return true;} else {return false;}
	}
}

// SECURITE : FONCTION TRAITEMENT DES TEXTES DU FORMULAIRE 
function clean_form($data){
	$data=addslashes(strip_tags(trim($data)));
	return $data;
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

function aleatoire($taille) {
	$bloc = array("48,57","65,90","97,122");
	for ( $a=0 ; $a<3 ; $a++ ) {
		list($dbu,$fin) = split(",",$bloc[$a]);
		for ( $b=$dbu ; $b<=$fin ; $b++ ) {
			$total[] = chr($b);
		}
	}
  for ( $a=0 ; $a<$taille ; $a++ ) {
		$alea .= $total[rand(0,count($total)-1)] ; // numeric
	}
	return ($alea);
}

// REWRITE URL PREPARATION 
function rewrite($chaine){
$chaine=strip_tags(trim($chaine));
$chaine=utf8_decode($chaine);
$tofind = " ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ()[]'~$&%*@ç!?;,:/\^¨€{}|+-`";
$replac = "-AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn--------------------E------";
$mrpropre =(strtr($chaine,$tofind,$replac));
$mrpropre = preg_replace("/\"/","-", $mrpropre);
$mrpropre = preg_replace("/[-]{2,}/", "-", $mrpropre);
$explod=explode('-',$mrpropre); // supprime les mot de moins de 2 caractères
    foreach($explod as $clief=>$morceaux) {
        if(strlen($morceaux)>2) {
        $newmrpropre.=$morceaux.'-';
        }
    }
$mrpropre=rtrim($newmrpropre,'-'); // efface le dernier "-"
return $mrpropre;
}

function motcle($str){
    $str=preg_replace('/$nbsp;/', " ",$str);
	$strArray = preg_split("/[\s,\.\:\"\'\?\!]+/", $str);
    $return = "";
    if(count($strArray)>0){
        foreach($strArray as $s){
            if(!preg_match(
"/^([le|les|la|du|de|des|un|une|en|dans|dedans|[0-9]|ceci|cela|ce|se|ces|ses|" .
"ca|ça|tes|ta|ton])$/i", $s) && strlen($s)>3){
                if(!empty($return)) $return.=",";
                $return.=$s;
            }
        }
    }
    return   $return;
} 

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

// FONCTION ENVOI DES PHOTOS
function sent_photo($updatefile,$nom_tmp,$chemin)
{	global $msg, $msgerror;
	if ( $updatefile ) 
	{	if ( is_uploaded_file($nom_tmp) ) 
		{	if ( ! @move_uploaded_file($nom_tmp,$chemin.$updatefile) ) 
			{	$msgsent=" - Echec de l'envoi du fichier.<br />"; }
			else {  $msgsent=" - Photo(s) envoy&eacute;e(s).<br />";  }
      	} 
    }
}

// ETOILES
function etoile($note){
	if ($note==1) { echo "<i class='fa fa-star' style='color:#ffcc33'></i>";}
	if ($note==2) { echo "<i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i>";}
	if ($note==3) { echo "<i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i>";}
	if ($note==4) { echo "<i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i>";}
	if ($note==5) { echo "<i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i> <i class='fa fa-star' style='color:#ffcc33'></i>";}
}

// COUPE TEXTE AU MOT
function cleanCut($string,$length,$cutString = ' [..]')
{
	if(strlen($string) <= $length)
	{
		return $string;
	}
	$str = substr($string,0,$length-strlen($cutString)+1);
	return substr($str,0,strrpos($str,' ')).$cutString;
}

// LETTRE PEB
function peblettre($peb){
	if ($peb<=0){echo "a++";}
	if ($peb>0 && $peb<=45){echo "a+";}
	if ($peb>45 && $peb<=85){echo "a";}
	if ($peb>85 && $peb<=170){echo "b";}
	if ($peb>170 && $peb<=255){echo "c";}
	if ($peb>255 && $peb<=340){echo "d";}
	if ($peb>340 && $peb<=425){echo "e";}
	if ($peb>425 && $peb<=510){echo "f";}
	if ($peb>510){echo "g";}	
}

// permet de convertir une chaine en slug
function slugify($text)
{ 
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
}

?>
