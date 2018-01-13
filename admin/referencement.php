<?
include "include/menu-new.php";

// VARIABLES
$titrepage= "R&eacute;f&eacute;rencement naturel";
$vert = "00CC00" ; $rouge = "CC3300" ;
$table_ref = $table_prefix."_referencement";
if (!$currentlg) {$currentlg="fr";}
 
// Création de la table si inexistante
mysqli_query($link, "CREATE TABLE IF NOT EXISTS `$table_ref` (
`ID` smallint(5) unsigned NOT NULL auto_increment,
`page` tinytext NOT NULL,
`lg` char(2) NOT NULL default '',
`titre` text NOT NULL,
`keywords` text NOT NULL,
`description` text NOT NULL,
PRIMARY KEY  (`ID`) ) TYPE=MyISAM;");

// MISE A JOUR DES METAS SUIVANT LES LANGUES ET LES PAGES
if ( $Submit ){
	$query = "UPDATE $table_ref SET titre=\"$titre\", keywords=\"$keywords\", description=\"$description\" WHERE page=\"$page\" AND lg=\"$currentlg\"";
    if ( mysqli_query($link, $query) ) { $msg = "Les Metas de la page $page sont &agrave; jour";} 
	else { $msgerror = "Echec de l'enregistrement, modifier et r&eacute;essayer";}
}

// CREATION DES LIGNES DANS LA TABLE REFERENCEMENT
$dir = opendir("../pages");
while ( $file = readdir($dir) ) 
{	if ( !preg_match("/^\./",$file) ) 
	{	if ( preg_match("/(.+)\.php$/",$file,$trouve) ) 
		{	for ( $a=0 ; $a<count($langues) ; $a++ ) 
			{	list($existe) = mysqli_fetch_array(mysqli_query($link, "SELECT count(*) FROM $table_ref WHERE page=\"".$trouve[1]."\" AND lg=\"".$langues[$a]."\""));
				if ( !$existe ) 
				{	mysqli_query($link, "INSERT INTO $table_ref SET page=\"".$trouve[1]."\", lg=\"".$langues[$a]."\", titre=\"\", keywords=\"\", description=\"\"");
				}
      		}
    	}
  	}
}

// PAGE PAR DEFAUT 
for ( $a=0 ; $a<count($langues) ; $a++ ) {
    list($existe) = mysqli_fetch_array(mysqli_query($link, "SELECT count(*) FROM $table_ref WHERE page=\"DEFAULT\" AND lg=\"".$langues[$a]."\""));
    if ( !$existe ) {
    	mysqli_query($link, "INSERT INTO $table_ref SET page=\"DEFAULT\", lg=\"".$langues[$a]."\", titre=\"\", keywords=\"\", description=\"\"");
    }
}

/*
for ( $a=0 ; $a<count($langues) ; $a++ ) {
    if (!$currentlg) { $currentlg=$langues[$a]; }
    $menulangue.=" <a href=\"referencement.php?pageactu=$pageactu&title=$title&currentlg=".$langues[$a]."\">".$langues[$a]."</a> ";
}
print("<br>");
*/
  
$result = mysqli_query($link, "SELECT page FROM $table_ref WHERE lg=\"$currentlg\" ORDER BY page");
while ( list($pageimprim) = mysqli_fetch_array($result) ) {
	$menupage.="<a  href=\"?pageactu=$pageimprim&title=$title&currentlg=$currentlg\"><button class='btn btn-primary' type='button'>$pageimprim</button></a>";
    if ( !$pageactu ) { $pageactu=$pageimprim; }
}

list ($titre,$keywords,$description) = mysqli_fetch_array(mysqli_query ($link, "SELECT titre,keywords,description FROM $table_ref WHERE page=\"$pageactu\" AND lg=\"$currentlg\""));

//Efface les lignes qui ne contiennent pas de langue
mysqli_query($link, "DELETE FROM `$table_ref` WHERE lg='' ");
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
					<form method="post" action="<?=$regs[1]?>">
					    <input type="hidden" name="title" value="<?=$title?>">
					    <input type="hidden" name="pageactu" value="<?=$pageactu?>">
					    <input type="hidden" name="page" value="<?=$pageactu?>">
					    <input type="hidden" name="currentlg" value="<?=$currentlg?>">
					    
						<div class="col-sm-12 col-md-12">
							
			    				<?	// BOUTON LANGUES    
						        if (isset($langues) && count($langues)>1) {
						            echo "<h4><i class='fa fa-flag '></i> Langue : ".$currentlg."</h4>";
						            echo '<div class="radio" style="margin-bottom: 25px;">';
						            for ( $a=0 ; $a<count($langues) ; $a++ ) {
						                if ( $a ) { print "<br />"; } 
										echo '<a href="?pageactu='.$pageactu.'&title='.$title.'&currentlg='.$langues[$a].'"><i class="fa fa-arrow-right" style="margin-right: 10px;" aria-hidden="true"></i>'.$langues[$a].'</a>';
						            //echo "<input type=\"radio\" name=\"lg\" value=\"".$langues[$a]."\"$addselected>".$langues[$a];
						            
						            }
						            echo '</div>';
						            
						        } else { echo '<input type="hidden" name="lg" value="'.$langues[0].'">';}
						        ?>
									        
							<h4><i class='fa fa-tag '></i> Pages</h4>		        
							<div class="liste-tags"><?=$menupage?></div>
							<div class="alert alert-warning" role="alert">Si les champs ne sont pas remplis, les metas seront remplis par les informations contenus dans la page DEFAUT.</div>
							
					    </div>
						<div style="clear:both"></div>
						
						<div class="col-sm-12 col-md-12 texte-principal">
							
							<h4><i class='fa fa-pencil-square-o '></i> Page</h4>
					        <div class="form-group">
						        <input type="text" name="no" value="<?=$pageactu?>" class="form-control" disabled>
					        </div>
					        
							<h4><i class='fa fa-pencil-square-o '></i> Titre</h4>
							<p><em>Pas plus de 3 lignes, faire des Phrases.</em></p>
					        <div class="form-group">
						        <textarea name="titre" cols="60" rows="3" class="form-control" ><?=$titre?></textarea>
					        </div>
					        
					        <h4><i class='fa fa-pencil-square-o '></i> Description</h4>
							<p><em>Pas plus de 3, 4 lignes, faire des Phrases.</em></p>
					        <div class="form-group">
						        <textarea name="description" cols="80" rows="5" class="form-control"><?=$description?></textarea>
					        </div>
							
							<button type="submit" name="Submit" value="Enregistrer" class="btn btn-default bouton-submit">Enregistrer</button>
						
						</div>
					</form>
		    </div>
		</section>


	</div><!-- Fin container ouvert dans menu.php -->
</body>
</html>

