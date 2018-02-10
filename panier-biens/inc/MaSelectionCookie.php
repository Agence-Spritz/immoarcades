<?php
echo $_POST['addselection']; // On ne récupère que les echo dans la page fiche

// SEPARATION DES INFOS
$expld=explode('-',$_POST['selectID'],2); $okselection=$expld[0]; $IDselection=$expld[1];

// Domaine du cookie
	
		$cookdomain = $_SERVER['HTTP_HOST']; $cookdir = "/"; /* Effacer v2/ */
		

// AJOUT - 30Jours
if ($IDselection>0 &&  $okselection=="OK") {
	if (!stristr($_COOKIE['immo-selection'],$IDselection)){ // SI PAS DEJA PRESENT
		$MaSelection=$_COOKIE['immo-selection'].$IDselection."-";
		setcookie('immo-selection', $MaSelection, (time() + 2592000),$cookdir ,$cookdomain);
	}
} 
// EFFACER
if (($IDselection>0 &&  $okselection=="NO") || $del>0) {
	if ($del>0){$IDselection=$del;}
	$remplacer=$IDselection.'-';
	$MaSelection=mb_ereg_replace($remplacer, '', $_COOKIE['immo-selection']); 
	setcookie('immo-selection', $MaSelection, (time() + 2592000),$cookdir ,$cookdomain);
	$_COOKIE['immo-selection']=$MaSelection;
} 
?>