<?php
include "include/menu-new.php";

// VARIABLES
$titrepage= "Alertes prospects";
$tableencours = $table_prefix."_alertmail";

// CHAMPS
$chps=array('date', 'mail', 'type', 'min','max');
$chpsNb = count($chps);

?>

 		<section class="padding-top-30 padding-bottom-30 section-bloc bloc-titre">
		    <div class="row">
		        <div class="col-sm-6 col-md-6">
			        <h2><?=$titrepage?></h2>
		        </div>
			    <div class="col-sm-6 col-md-6">
					<a href="?#chercher" style="float:right; margin-left:20px"><i class="fa fa-search"></i> Chercher</a>
					<a href="?" style="float:right"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Ajouter</a> 
		        </div>
				<div class="clearfix"></div>
		    </div>
	    </section>
	    
<?php    
// EFFACEMENT
if ( $del ) {	
	mysqli_query($link, "DELETE FROM $tableencours WHERE ID=$del");

}

unset ($del);
	
// TRAITEMENT DES TEXTES
if (!$date) {$date=date(Y-m-d);} else {$date=date_tiret($date);}
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

		$msg.= "<i class='fa fa-check-circle fa-2x'></i> Mise &agrave; jour r&eacute;ussie";
    } 
	else 
	{	mysqli_query($link, "INSERT INTO $tableencours SET $addquery1");

	  	$msg.= "<i class='fa fa-check-circle fa-2x'></i> Enregistrement ajout&eacute;";
    }
	unset($ID, $date, $mail, $type, $min,$max);

	
} // FIN DU SUBMIT

// RECUPERATION DES VALEURS ENREGISTREES
if ( $modif ) 
{	$result = mysqli_fetch_array( mysqli_query($link, " SELECT ID,$liste1 FROM $tableencours WHERE ID=$modif ") );
	list($ID, $date, $mail, $type, $min,$max) = $result;
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
							        
							        <h4><i class='fa fa-user '></i> Date de l'alerte</h4>
							        <div class="form-group">
								        <input name="<?=$chps[0]?>" value="<?=$$chps[0]?>" class="form-control" type="text"   />
							        </div>
							        
							        <h4><i class='fa fa-user '></i> Email</h4>
							        <div class="form-group">
								        <input name="<?=$chps[1]?>" value="<?=$$chps[1]?>" class="form-control" type="text"   />
							        </div>
							        
							        <h4><i class='fa fa-user '></i> Type recherché</h4>
							        <div class="form-group">
								        <input name="<?=$chps[2]?>" value="<?=$$chps[2]?>" class="form-control" type="text"   />
							        </div>
							        
							        <h4><i class='fa fa-user '></i> Budget mini</h4>
							        <div class="form-group">
								        <input name="<?=$chps[3]?>" value="<?=$$chps[3]?>" class="form-control" type="text"   />
							        </div>
							        
							        <h4><i class='fa fa-calendar '></i> Budget maxi</h4>
							        <div class="form-group">
								        <input name="<?=$chps[4]?>" value="<?=$$chps[4]?>" class="form-control" type="text"   />
							        </div>
							        
							        
							</div>
							<div class="col-sm-12 col-md-6">
							<!-- Colonne vide, déstinée à accueillir les photos-->
							</div>
							<div class="clearfix"></div>
    
				</form>
		    </div>
		</section>
		
		<section class="padding-top-30 padding-bottom-30 margin-top-20 section-bloc">
		
			<div class="row">
				<div class="col-sm-12 col-md-12">


						<a name="chercher" id="chercher"></a>
						
						<form method="post" action="">
						  <?php if ($word) {?>
						  <span class="VertNorm"><i class='fa fa-check '></i> recherche exécutée</span>
						  <?php } ?>
						  
						  	<div class="input-group">
						      <input type="text" class="form-control" placeholder="Rechercher..." name="word" value="<?php print(htmlentities($word)); ?>">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="submit">OK</button>
						      </span>
						    </div><!-- /input-group -->
		
						  <?php if ($word) {?>
						  <span class="BleuNorm">
						  	<a href="?"><i class="fa fa-undo "></i> Reset</a>
						  </span>
						  <?php } ?>
						</form>
						
						<? if ($word)  {$result = mysqli_query($link, "SELECT ID,".$liste1." FROM $tableencours WHERE (".$chps[0]." LIKE '%$word%' OR ".$chps[1]." LIKE '%$word%' OR ".$chps[2]." LIKE '%$word%' OR ID LIKE '%$word%') ORDER BY date DESC ");}
						else {  $result = mysqli_query($link, "SELECT ID,".$liste1." FROM $tableencours WHERE 1 ORDER BY date DESC");}
						
						?>
						
						<table style="margin-top: 25px;" class="table table-bordered table-striped">
						  	<thead>
							    <tr>
							      <th>&nbsp;</th>
							      <th><i class='fa fa-sort-numeric-asc '></i> - <i class='fa fa-asterisk '></i></th>
							      <th><i class='fa fa-user '></i></th>
							      <th><i class='fa fa-pencil-square-o '></i></th>
							      <th><i class='fa fa-calendar '></i></th>
							      <th>&nbsp;</th>
						        </tr>
					      	</thead>
							<tbody>
							  	<?php 
								  while ( list($ID, $date, $mail, $type, $min,$max) = mysqli_fetch_array($result) )  
								  { 
								  	if ($masquer=="1") {$class="normalgrisclair";} else {$class="";}
								    echo "<tr class='".$class."'>";
								    echo "<td><a href=\"?modif=$ID&word=$word\"><i class='fa fa-pencil '></i></a></td>";
								    echo "<td>$ID</td><td>".$mail."</td><td>".$type."...</td><td>".$max."</td><td><a href=\"?del=$ID&word=$word\"><i class='fa fa-trash-o '></i></a></td>";
								    echo "</tr>";
								  }
						 		?>

							</tbody>
						</table>
						<div class="clearfix hidden-sm"></div>

					<div class="clearfix hidden-sm"></div>
				</div>
			</div>
		</section>

</div>
</body>
</html>