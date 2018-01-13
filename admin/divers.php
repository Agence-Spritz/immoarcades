<?
include "include/menu-new.php";

// VARIABLES
$titrepage= "Email formulaire / Coordonn&eacute;es";
$tableencours = $table_prefix."_divers";
//$page = "actu"; 										// Variable pour definir la sous cat page
$modif=1;

// PHOTOS
$photosize = "990x250";									// Dimensions idéales d'information pour la photo
//$chemin = "../img/pages/";  							// "/" à la fin
$wmax = 100; $hmax = 80;  $tdvisuphoto = $wmax*2+20;  	// Dimension pour affichage des vigettes
$redim_w=990; $redim_h=250;
$masquervignette=1;
$nbr=0; // Nombre de photos

// CHAMPS
$chps=array('mail1','coordonnees');
$chpsNb = count($chps);
?>
 		<section class="padding-top-30 padding-bottom-30 section-bloc bloc-titre">
		    <div class="row">
		        <div class="col-sm-6 col-md-6">
			        <h2><?=$titrepage?></h2>
		        </div>
			    <div class="col-sm-6 col-md-6">
		        </div>
				<div class="clearfix"></div>
		    </div>
	    </section>
<?php    
// EFFACEMENT
if ( $del ) {	
	mysqli_query($link, "DELETE FROM $tableencours WHERE ID=$del");
	@unlink($chemin.$del.".jpg");
	for ($a=1; $a<=$nbr; $a++){@unlink($chemin.$del."-".$a.".jpg");}
}
elseif ($delphoto) {@unlink($chemin.$delphoto);}
unset ($del,$delphoto);
	
// TRAITEMENT DES TEXTES
if (!$dbu) {$dbu=date(Y-m-d);} else {$dbu=date_tiret($dbu);}
for ($a=0; $a<$chpsNb; $a++){ 
	$$chps[$a]=preg_replace('/"/',"'",trim($$chps[$a]));							// " => '
	if ($a==5 || $a==6 || $a==10) {$$chps[$a]=preg_replace('/,/',".",$$chps[$a]);}		// PRIX , => . 
}

// ADDQUERY ET LISTE
for ($a=0; $a<$chpsNb; $a++){	$addquery1.=$chps[$a]."=\"".$$chps[$a]."\","; $liste1.=$chps[$a].",";}
$addquery1 = substr($addquery1,0,strlen($addquery1)-1);
$liste1 = substr($liste1,0,strlen($liste1)-1); //echo $liste1;
	
// MODIF / AJOUT
if ( $Submit ) 
{	if ( $modif ) 
	{	mysqli_query($link, "UPDATE $tableencours SET $addquery1 WHERE ID='$modif'");
		if ( $vignette ) { $updatevign="$modif.jpg"; }
		for ($a=1; $a<=$nbr; $a++){		if ( $_FILES['photo'.$a]['name'] ) { $updatefile[$a]=$modif."-".$a.".jpg";} else {$updatefile[$a]="";} }
		$msg.= "<i class='fa fa-check-circle fa-2x'></i> Mise &agrave; jour r&eacute;ussie";
    } 
	unset($ID,$mail1,$coordonnees);
	
} // FIN DU SUBMIT

// RECUPERATION DES VALEURS ENREGISTREES
if ( $modif ) 
{	$result = mysqli_fetch_array( mysqli_query($link, " SELECT ID,$liste1 FROM $tableencours WHERE ID=$modif ") );
	list($ID,$mail1,$coordonnees) = $result;
}  
?>
		<!-- Messages d'alertes ou de confirmation -->
		<div class="row">
	        <div class="col-sm-12 col-md-12">
				<?php if ($msg) {?>
					<div class="alert alert-success" role="alert"><?=$msg?></div>
				<?php } ?>
				<?php if ($msgerror) {?>
				<div class="alert alert-danger" role="alert"><?=$msgerror?></div>
				<?php } ?>
	        </div>
		</div>
		
		<section class="padding-top-30 padding-bottom-30 section-bloc">
		    <div class="row">

				<form method="post" action="" enctype="multipart/form-data">
				    <input type="hidden" name="modif" value="<?=$modif?>">
				    <input type="hidden" name="word" value="<?=$word?>">
    
						<div class="col-sm-12 col-md-6">
							<?	// BOUTON LANGUES    
					        if (isset($langues) && count($langues)>1) {
					            echo "<h4><i class='fa fa-flag '></i> Langue</h4>";
					            echo '<div class="radio" style="margin-bottom: 25px;">';
					            for ( $a=0 ; $a<count($langues) ; $a++ ) {
					                if ( $lg == $langues[$a] || (!$a&&!$lg) ) { $addselected = " checked"; } else { $addselected = ""; }
					                if ( $a ) { print ",&nbsp;"; } 
					            echo '<label class="radio-inline">';
					            echo "<input type=\"radio\" name=\"lg\" value=\"".$langues[$a]."\"$addselected>".$langues[$a];
					            echo "</label>";
					            }
					            echo '</div>';
					            
					        } else { echo '<input type="hidden" name="lg" value="'.$langues[0].'">';}
					        ?> 
					        
			        		<h4><i class='fa fa-envelope '></i> Email</h4>
					        <div class="form-group">
						        <input name="<?=$chps[0]?>" value="<?=$$chps[0]?>" class="form-control" type="text" required  />
					        </div>
					               
    					</div>
    					
    					<div class="col-sm-12 col-md-6">
							<!-- Colonne vide, déstinée à accueillir les photos-->
						</div>
						<div class="clearfix"></div>

						<div class="col-sm-12 col-md-12 texte-principal">
						    
						<h4><i class='fa fa-align-justify '></i> Coordonn&eacute;es</h4>
						<textarea name="<?=$chps[1]?>" row contenu-admins="10" cols="50" ><?=$$chps[1]?></textarea><script type="text/javascript">CKEDITOR.replace( '<?=$chps[1]?>' );</script>
						<div class="clearfix"></div>
						<button type="submit" name="Submit" value="Enregistrer" class="btn btn-default bouton-submit">Enregistrer</button>
						
						</div>

				</form>
		    </div>
		</section>

	</div>
</body>
</html>