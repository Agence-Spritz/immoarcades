<?php
echo $_POST['addselection']; // Test On ne récupère que les echo dans la page fiche

// SEPARATION DES INFOS
$expld=explode('-',$_POST['selectID'],2); $okselection=$expld[0]; $IDselection=$expld[1];

// Domaine du cookie
	if ( $_SERVER['HTTP_HOST'] == "127.0.0.1" ) {	
		$cookdomain = "127.0.0.1"; $cookdir = "/likeimmo.be/v2/"; 
	} else 	{
		$cookdomain = $_SERVER['HTTP_HOST']; $cookdir = "/v2/"; /* Effacer v2/ */
	}	

// AJOUT - 30Jours
if ($IDselection>0 &&  $okselection=="OK") {
	if (!stristr($_COOKIE['likeimmo-selection'],$IDselection)){ // SI PAS DEJA PRESENT
		$MaSelection=$_COOKIE['likeimmo-selection'].$IDselection."-";
		setcookie('likeimmo-selection', $MaSelection, (time() + 2592000),$cookdir ,$cookdomain);
	}
} 
// EFFACER
if (($IDselection>0 &&  $okselection=="NO") || $del>0) {
	if ($del>0){$IDselection=$del;}
	$remplacer=$IDselection.'-';
	$MaSelection=mb_ereg_replace($remplacer, '', $_COOKIE['likeimmo-selection']); 
	setcookie('likeimmo-selection', $MaSelection, (time() + 2592000),$cookdir ,$cookdomain);
	$_COOKIE['likeimmo-selection']=$MaSelection;
} 
?>