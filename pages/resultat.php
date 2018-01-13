<?php if ($id=='T'){
	
	$titrep = ' biens';
	$texte2p = 'Valérie et Christophe vous accompagnent dans l\'acquisition du bien de vos rêves';
	
	} else {
		
		// Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre,texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
		
	}
	
	?>


<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	<div class="section section-bg-1 section-fixed pt-6 pb-3">
		<div class="bg-overlay-dark"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<h2 class="page-title"><?php echo $titrep; ?></h2>
					<div class="breadcrumb mt-1 pl-0">
						<ul class="breadcrumbs">
							<li><a href="<?php echo $defaultpg; ?>.php">Accueil</a></li>
							<li><?php echo $titrep; ?></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-6">
					<div class="text-right">
						<div class="page-title-subtext extra-font">
							<?php if ($texte2p) { echo $texte2p; } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php // On détermine la nature de la recherche (vente, location, etc...)
		
		// Maisons
		if ($id==70) {
			$cat_v_l = "V";
			$add_cat = "AND cat = '$cat_v_l'";
			
		// Projets neufs
		} else if ($id==71) {
			$cat_v_l = "N";
			$add_cat = "AND cat = '$cat_v_l'";
		// Locations
		} else if ($id==72) {
			$cat_v_l = "L";
			$add_cat = "AND cat = '$cat_v_l'";
		// Terrains
		} else if ($id==84) {
			$cat_v_l = "T";
			$add_cat = "AND cat = '$cat_v_l'";
		// Appartements
		} else if ($id==85) {
			$cat_v_l = "V";
			$add_cat = "AND cat = '$cat_v_l'";
		
		} else if ($id=="T"){
			
			$add_cat = "";
		} else {
			
			$add_cat = "";
		}
		
		
		// Si on a un type en paramétre ds l'url ET qu'on n'est pas ds le cadre d'une recherche en POST
		if (!$_POST['submit']=='Rechercher') {
			if ($_GET['type']) {
					$add_type = "AND typesimple = '".$_GET['type']."'";
			} 
		}
		
		
		
		// On va adapter la requête en fonction des elements postés lors de la recherche
		if ($_POST['submit']=='Rechercher') {
			
			//argument de type
			if ($_POST['type']) {
				$type = $_POST['type'];
				$add_type = "AND typesimple = '$type'";
			} else {
				$type = "";
			}
			
			//argument de localite
			if ($_POST['localite']) {
				$localite = $_POST['localite'];
				$add_localite = "AND localite = '$localite'";
			} else {
				$localite = "";
			}
			
			//argument de chambres
			if ($_POST['chambres']) {
				$chambres = $_POST['chambres'];
				$add_chambres = "AND chambre = '$chambres'";

			} else {
				$chambres = "";
			}
			
			//argument de prix
			if ($_POST['prix']) {
				$fourchette_prix = array();
				$fourchette_prix = explode(';', $_POST['prix']);
				
				$prix_min_fourchette = $fourchette_prix[0];
				$prix_max_fourchette = $fourchette_prix[1];
				
				$add_prix = "AND prix BETWEEN '$prix_min_fourchette' AND '$prix_max_fourchette'";
				
			} else {
				$prix_min_fourchette = "";
				$prix_max_fourchette = "";
			}
			
			//argument de terme clé
			if ($_POST['recherche_terme']) {
				$recherche_terme = $_POST['recherche_terme'];
				$add_terme = "AND (titre LIKE '%$recherche_terme%' OR descrlight LIKE '%$recherche_terme%' OR composition LIKE '%$recherche_terme%' OR type LIKE '%$recherche_terme%' OR typesimple LIKE '%$recherche_terme%' OR localite LIKE '%$recherche_terme%' OR codepostal LIKE '%$recherche_terme%' OR cregion LIKE '%$recherche_terme%')";
			} else {
				$recherche_terme = "";
			}
			
			
			
			 /*MOTS CLES*/
			if ($_POST['recherche_generale'])     
            {    
	              
                $search_keyword=addslashes($_POST['recherche_generale']);
                $motcle = explode(" ",$search_keyword,4); $nb_de_mot=count($motcle);
                // REQUETE RUBRIQUE
                for ($a=0; $a<$nb_de_mot; $a++) {$requete.=" OR (codepostal LIKE '%$motcle[$a]%' OR localite LIKE '%$motcle[$a]%' OR titre LIKE '%$motcle[$a]%' OR type LIKE '%$motcle[$a]%' OR typesimple LIKE '%$motcle[$a]%' OR ref LIKE '%$motcle[$a]%' OR quartier LIKE '%$motcle[$a]%' OR descrlight LIKE '%$motcle[$a]%' OR prix LIKE '%$motcle[$a]%')";}
                $requete=substr($requete,3,1000);
        
                $add_recherche = (" AND ".$requete);
            } else {
	            $add_recherche = "";
            }

			
			//Enlever les commentaires pour afficher les valeurs postées
/*
				echo $add_type.'<br />';
				echo $add_localite.'<br />';
				echo $add_chambres.'<br />';
				echo $add_prix.'<br />';
				echo $add_terme.'<br />';
*/
			
			
		}
		
	
		
		
	?>
	

	<!-- Zone de filtres
	================================================== -->	
	
	<div class="section pt-9">
		<div class="container">
			<div class="row">
				
				
				<div class="col-md-12 col-lg-12">
					<div class="zone-recherche">
						<form id="recherche_generale" method="POST" action="">
							<div class="col-xs-12 col-md-4 col-lg-4">
								<label>Recherche par type</label>
								<select name="type">
									<option value="">Tous les types</option>
									<?php $req = mysqli_query($link,"SELECT DISTINCT typesimple FROM ".$table_prefix."_biens WHERE 1 ".$add_cat." AND typesimple<>''  ORDER BY typesimple ASC"); 
									  	while ($data = mysqli_fetch_array($req)) { 
									?>
										<option value="<?php echo $data['typesimple']; ?>" <?php if ( (($_POST['type'])&&($_POST['type']==$data['typesimple'])) || (($_GET['type'])&&($_GET['type']==$data['typesimple'])) ) { echo 'selected=selected';} ?>><?php echo $data['typesimple']; ?></option>
									<?php } ?>
						
								</select>
							</div>
							
							<div class="col-xs-12 col-md-4 col-lg-4">
								<label>Recherche par ville</label>
								<select name="localite">
									<option value="">Toutes les villes</option>
									<?php $req = mysqli_query($link,"SELECT DISTINCT localite FROM ".$table_prefix."_biens WHERE 1 ".$add_cat." AND localite<>'' ORDER BY localite ASC"); 
									  	while ($data = mysqli_fetch_array($req)) { 
									?>
										<option value="<?php echo $data['localite']; ?>" <?php if (($_POST['localite'])&&($_POST['localite']==$data['localite']) ) { echo 'selected=selected';} ?>><?php echo $data['localite']; ?></option>
									<?php } ?>
								</select>
							</div>
							
							<div class="col-xs-12 col-md-4 col-lg-4">
								<label>Nombre de chambre(s)</label>
								<select name="chambres">
									<option value="">Tout</option>
									<?php $req = mysqli_query($link,"SELECT DISTINCT chambre FROM ".$table_prefix."_biens WHERE 1 ".$add_cat." AND chambre<>'' ORDER BY chambre ASC"); 
									  	while ($data = mysqli_fetch_array($req)) { 
									?>
										<option value="<?php echo $data['chambre']; ?>" <?php if (($_POST['chambres'])&&($_POST['chambres']==$data['chambre']) ) { echo 'selected=selected';} ?>><?php echo $data['chambre']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div style="margin-bottom: 25px;" class="clearfix"></div>
							
							<div class="col-xs-12 col-md-12 col-lg-12">
								<label>Fourchette de Prix</label>
								<input type="text" id="prix" name="prix" value="" />
							</div>
							
							
							<div class="col-xs-12 col-md-4 col-lg-4">
								
							</div>
							
							
							<div class="clearfix"></div>
							
							<div class="col-xs-12 col-md-4 col-lg-4">
								<label><i style="margin-right: 10px;" class="fa fa-search" aria-hidden="true"></i> Recherche par mot clé</label>
								<input type="text" name="recherche_terme" placeholder="tapez votre mot clé" value="<?php if ($_POST['recherche_terme']) { echo $recherche_terme; } else if ($_POST['recherche_generale']) { echo $_POST['recherche_generale']; } ?>" />
							</div>
							
							<div class="col-xs-12 col-md-4 col-lg-4">
								
							</div>
							
							<div class="col-xs-12 col-md-4 col-lg-4">
								<input style="margin-top: 25px;float: right;" type="submit" name="submit" value="Rechercher" id="recherche_generale" />
							</div>
							<div class="clearfix"></div>
							
						</form>
						
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
	
	<!-- Liste des biens
	================================================== -->	
	
	<div class="section pt-11 pb-9">
		<div class="container">
			<div class="row">
				
				<div class="col-md-12 col-lg-12">
					<div class="blog-list">
						
						<?php // Requête générale pour lister les biens
							$req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE 1 ".$add_cat." ".$add_type." ".$add_localite." ".$add_chambres." ".$add_prix." ".$add_terme." ".$add_recherche." ORDER BY venduloue, dmod DESC"); 
							
							 //echo "SELECT * FROM ".$table_prefix."_biens WHERE 1 ".$add_cat." ".$add_type." ".$add_localite." ".$add_chambres." ".$add_prix." ".$add_terme." ".$add_recherche." ORDER BY ID DESC";
							
								// Calcule le nbr de biens retournés par la requête
								$nb_biens = mysqli_num_rows($req);
								
						?>
				
							<?php if ($nb_biens=='0') { ?>
							
								<div class="alert alert-warning" role="alert">Désolé, aucun bien ne semble correspondre à votre recherche, merci d'élargir celle-ci.</div>
							
							<?php }  else { 
								
									while ($data = mysqli_fetch_array($req)) {
										$venduloue = $data['venduloue'];
								  	
										// Détermination des variables
										if ($venduloue=="") {
											$url_fiche = slugify($data['typesimple']).'-'.slugify($data['localite']).'--maison-luxe-tournai-mouscron--'.$data['ID'].'--fiche';
										} else {
											$url_fiche = "#";
										}
							?>
							
										<div class="entry-blog list resultats">
											<div style="position: relative;" class="blog-item bg-white">
												
												<!-- Zone de survol
														================================================== -->
												<?php // On affiche la zone de survol que si on a au moins 1 autre photo
													if($data['PHOTO_02']!="") { ?>
														<div class="survol-photo">
															<a href="<?php echo $url_fiche; ?>" title="Découvrir ce bien" > 
																<img style="float: left;" src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['localite']; ?>" title="<?php echo $data['titre']; ?>" />
															</a>
															
															<?php if($data['PHOTO_02']!="") { ?>
																<a href="<?php echo $url_fiche; ?>" title="Découvrir ce bien" > 
																	<img style="float: left;" src="<?php echo $data['PHOTO_02']; ?>" alt="<?php echo $data['localite']; ?>" title="<?php echo $data['titre']; ?>" />
																</a>
															<?php } ?>
															
															<?php if($data['PHOTO_03']!="") { ?>
																<a href="<?php echo $url_fiche; ?>" title="Découvrir ce bien" > 
																	<img style="float: left;" src="<?php echo $data['PHOTO_03']; ?>" alt="<?php echo $data['localite']; ?>" title="<?php echo $data['titre']; ?>" />
																</a>
															<?php } ?>
																
																<?php if ($venduloue=="") { ?>
																<a href="<?php echo $url_fiche; ?>" title="Découvrir ce bien" class="carre-plus"> 
																	<i class="fa fa-arrow-circle-o-right fa-2x"></i>
																</a>
																<?php } ?>
														</div>
												<?php } ?>
												
												<div class="col-md-4 col-lg-4">
													<div class="entry-media">
													<?php if ($data[virtuel]) {?>
                                                        <div style="float:left; position:absolute; width:75px; height:75px; margin:20px; background-color:RGBA(255,255,255,0.7); border-radius:60px; padding:15px; z-index:9999">
                                                            <img src="images/icon-video.png"style="width:80px"/> 
                                                        </div>
                                                    <?php } ?>
															<img class="photo-principale" src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['localite']; ?>" title="<?php echo $data['titre']; ?>" />

															<?php if ($venduloue=="") { ?>
															<a href="<?php echo $url_fiche; ?>" class="nectar-love right" title="Découvrir ce bien"> 
																<i class="fa fa-plus"></i>
															</a>
															<?php } elseif ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
																<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
															<?php } else { ?>
																<div class="banniere-venduloue" style="background-color:RGBA(47,54,63,0.8)"><?php echo $venduloue; ?></div>
															<?php } ?>
														
													</div>
												</div>
												<div class="col-md-8 col-lg-8">
													
													<!-- Corps de la fiche
														================================================== -->
													<div  class="entry-content pl-0 pr-0">
														
														<div class="entry-header">
															<div class="mb-2">
																<h3 class="heading wg-title"><?php echo $data['type']; ?> à <?php echo $data['localite']; ?></h3>
																<h2 class="extra-font">
																		<!-- 	<a href="bien-de-prestige-tournai-mouscron--<?php echo $data['ID']; ?>--fiche"><span class="f2"><?php echo $data['type']; ?></span> </a> -->
																</h2>
															</div>
															
														</div>
														<div style="position: relative;" class="content">
															<div class="description">
																<p><?php echo $data['titre']; ?></p>
															</div>
															
															<div class="zone-pictos">
																<ul>
																<?php if (($data['qsurfhab']!='')&&($data['qsurfhab']!='0')) { ?>
																	<li><img src="images/fiche-surf.png" style="height:40px; margin-top:-15px" /> <?php echo number_format($data['qsurfhab'], 0, ',', ' '); ?>m<sup>2</sup></li>
																<?php } ?>
                                                                <?php if ($data['cat']=="T" && $data['qsurfterrain']!='' && $data['qsurfterrain']!='0') { ?>
																	<li><img src="images/fiche-surf.png" style="height:40px; margin-top:-15px" /> <?php echo number_format($data['qsurfterrain'], 0, ',', ' '); ?>m<sup>2</sup></li>
																<?php } ?>
																<?php if ($data['chambre']!='') { ?>
																	<li><i class="glyph-icon flaticon-bed"></i> <?php echo $data['chambre']; ?></li>
																<?php } ?>
																<?php if ($data['qgarages']!='') { ?>
																	<li><i class="glyph-icon flaticon-vehicle"></i>  <?php echo $data['qgarages']; ?></li>
																<?php } ?>
                                                                <?php if($data['sdb']>0) { ?>
                                                                    <li><i class="glyph-icon flaticon-medical"></i> <?php echo $data['sdb']; ?></li>
                                                                <?php } ?>
																</ul>
															</div>
														</div>
														
														
                                                        <?php if (!$venduloue) { ?>
                                                        <div class="prix">
															<?php if ($data['cacherprix']!=1){?>
																<?php echo number_format($data['prix'], 0, ',', ' ').'<sup>€</sup>'; ?>
                                                            <?php } else {echo "Prix sur demande";} ?>
                                                            <?php if ($data['peb']>0){?>
                                                            	<br /><img src="img-PEB/img/peb_<?=peblettre($data['peb'])?>.png" style="margin-top:-10px" />
                                                            <?php } ?>
														</div>
                                                        <?php } ?>
                                                        
                                                 <!-- PEB -->
												<div style="float:left; position:relative; width:auto; height:50px; margin:30px 0px 0 0;  padding:15px; z-index:9999">
                               	
                        </div>
														
													</div>
												</div>
												<div style="clear: both;"></div>
												
											</div>
										</div>
							
							<?php } ?>
						
						<?php } ?>
						
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
	
	
	
	
</div>