<?php if ( substr($_SERVER['HTTP_HOST'],0,9) == "127.0.0.1" ) {?><link href="../inc/style.css" rel="stylesheet" type="text/css"><?php } ?>
<?
include("../inc/openDB.txt"); include("emailhtml.php"); include("../include/fonction.php");

// SELECTION DES INSCRITS EN ALERTE MAIL
$Qmembre = mysqli_query($link,"SELECT `date`,`mail`,`type`,min,max  FROM ".$table_prefix."_alertmail WHERE mail!='' ");
while (list($date_update,$mail,$type,$min,$max) = mysqli_fetch_array($Qmembre))
{	print "<br><br>#### $mail $date, $type de $min &agrave; $max ####<br>";
	if($type) {$addQ=" AND type=\"$type\" ";}
	if($min || $max) {$addQ.=" AND prix>='$min' AND prix<='$max' ";}
	$Qbien_du_membre = mysqli_query($link, "SELECT ID FROM ".$table_prefix."_biens WHERE dbu>'$date_update' AND cat='V' ".$addQ." ");
	while (list($IDbien) = mysqli_fetch_array($Qbien_du_membre) )
	{	
	print "- $mail POUR bien = $IDbien<br>"; mail_alertemail($mail,"contacts@neuville-habitat.com","Neuville habitat",$titre,$nom,$mail,$IDbien,$status); 
		//Mise à jour de la date d'actualisation
		mysqli_query ($link,"UPDATE ".$table_prefix."_alertmail SET `date`='".date("Y-m-d")."' WHERE `mail`='$mail'"); 
	}
	
}
?>