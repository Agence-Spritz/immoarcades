<?
include "include/menu.php";
// VARIABLES
$titrepage= "Alerte Email inscrits";
$tableencours = $table_prefix."_alertmail";
$page = ""; 										// Variable pour definir la sous cat page
// PHOTOS
$photosize = "1170x550";									// Dimensions idéales d'information pour la photo
$chemin = "../img/page-maison-a-vendre-comines-warneton-le-bizet-ploegsteert-houthem/";  							// "/" à la fin
$wmax = 100; $hmax = 80;  $tdvisuphoto = $wmax*2+20;  	// Dimension pour affichage des vigettes
$redim_w=1170; $redim_h=550;
$masquervignette=0;
$nbr=0; // Nombre de photos
// CHAMPS
//$chps=array('page','titre','texte','dbu','masquer','lg','texte2');
//$chpsNb = count($chps);
?>
<div id="GENERAL" style="width:<?=$largtabl?>px;">
<div id="titreadmin" style="width:<?=$largtabl?>px;" class='grandnoir'>
	<?=$titrepage?>
    <span class="normalgris link"><a href="?#chercher" style="float:right; margin-left:20px"><i class="fa fa-search"></i> Chercher</a></span>
    <span class="normalgris link"><a href="?partie=<?=$partie?>" style="float:right"><i class="fa fa-plus-square"></i> Ajouter</a></span>
    
</div>
<?php    
	// EFFACEMENT
	if ( $del ) {	mysqli_query($link,"DELETE FROM $tableencours WHERE ID='$del'");
				}
	unset ($del);
 
?>

  <?php // R&eacute;initialiser $keyword 
if ( $search != "ok" ) { unset($word); }
?>

<form method="post" action="">
    <span class="GrisNorm">Chercher :</span>
    <input name="word" type="text" value="<?php print(htmlentities($word)); ?>" size="25">
    <input type="submit" name="search"  class="OrNorm" value="ok" >
</form>
<p>
  <?
if ($word)  {$result = mysqli_query($link,"SELECT ID,`date`,`mail`,type,min,max FROM $tableencours WHERE (`mail` LIKE '%$word%' OR `date` LIKE '%$word%' OR type LIKE '%$word%') ORDER BY ID desc ");}
else {  $result = mysqli_query($link," SELECT ID,`date`,`mail`,type,min,max FROM $tableencours ORDER BY ID desc ");}
  print("<table width='$largtabl' border='0' cellspacing='0' cellpadding='3'><tr class='BleuNorm'> ");
  print("<td>&nbsp;</td>");
  print("<td><i class='fa fa-sort-numeric-asc fa-1x'></i>ID</td><td><i class='fa fa-calendar-o fa-1x'></i> Date</td><td><i class='fa fa-envelope fa-1x'></i> Email</td><td><i class='fa fa-list-ol fa-1x'></i> Filtres</td><td>&nbsp;</td></tr>");
  while ( list($ID,$dbu,$email,$type,$min,$max) = mysqli_fetch_array($result) ) 
  { if ($bgcolor=="#EEEEEE") {$bgcolor="#FFFFFF";} else {$bgcolor="#EEEEEE";}
    print("<tr bgcolor='$bgcolor' class='normalgris'>");
    print("<td><!--<a href=\"?modif=$ID\">Modif</a>--></td>");
    print("<td>$ID</td><td>$dbu</td><td>$email</td><td>Choix  : $type entre $min et $max</td><td><i class='fa fa-trash-o fa-1x'></i> <a href=\"?del=$ID\">Del</a></td>");
    print("</tr>");
  }
 ?>
</p>
</body>
</html>