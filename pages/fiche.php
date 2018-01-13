<?php	// Requête pour récupérer le contenu de la page concernée
		$req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE ID='$id'"); 
		$data = mysqli_fetch_array($req);
		
		$offre = $data['cat'];
		
		if ($offre=='L') {
			$libele_offre = "A louer";
		} else if ($offre=='V') {
			$libele_offre = "A vendre";
		} else if ($offre=='N') {
			$libele_offre = "Neuf";
		}
		
		
		$titre = $data['titre'];
		$localite = $data['localite'];
		$region = $data['cregion'];
		$quartier = $data['quartier'];
		$typesimple = $data['typesimple'];
		$type = $data['type'];
		$prix = $data['prix'];
		$cacherprix = $data['cacherprix'];
		$description = $data['descrlight'];
		$composition = $data['composition'];
		$surface = $data['qsurfhab'];
		$nb_chambres = $data['chambre'];
		$nb_garages = $data['qgarages'];
		$nb_sdb = $data['sdb'];
		$surface_terrain = $data['qsurfterrain'];
		$surface_terrasse = $data['qsurfterrasse'];
		$annee = $data['nannee'];
		$ref = $data['ref'];
		$style = $data['stylemaison'];
		$statut  = $data['venduloue'];
		$etat = $data['cetat'];
		
		$type_chauffage = $data['chaufdescrip'];
		$gaz = $data['gaz'];
		$elec_chiffre = $data['elecchiffre'];
		
		$facade = $data['facade'];
		$jardin = $data['jardin'];
		$etage = $data['etage'];
		$ascenseur = $data['ascenseur'];
		$cour = $data['cour'];
		$cave = $data['cave'];
		$PEB = $data['peb'];
		// VIDEO
		
		$virtuel = trim($data['virtuel']);
		
		
		
?>

<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	
	
	<div class="section section-bg-fiche section-fixed pt-0 pb-3" style="margin-bottom: -200px;">
		<div class="fiche bg-overlay-white"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 diapo-en-tete-fiche">
					
				</div>
			</div>
		</div>
	</div>
	
	

	<!-- Corps de la page
	================================================== -->	
	
		<div class="section">
			<div class="container">
				<div class="row">
					
					<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 MasquerMoins768" style="padding:10px 0 0 0">
						<div class="zone-pictos-fiche">
							<h3 class="heading wg-title white"><?php echo $localite; ?></h3>
							<p><?php echo $titre; ?></p>
						</div>
					</div>
                    
					<div class="col-xs-12 col-sm-8 col-md-10 col-lg-10 p-0">
                        <!-- VIDEO -->
                        <?php if ($virtuel) {?>
                        <link href="js/lity-2.2.0/dist/lity.css" rel="stylesheet">
						<script src="js/lity-2.2.0/vendor/jquery.js"></script>
						<script src="js/lity-2.2.0/dist/lity.js"></script>

                            <a data-lity target="_blank" href="<?php echo $virtuel;?>">
                            <div style="float:left; position:relative; width:75px; height:75px; margin:20px; background-color:RGBA(255,255,255,0.7); border-radius:60px; padding:15px; z-index:9999">
                                <img src="images/icon-video.png"style="width:80px"/> 
                            </div>
                            </a>
                        <?php } ?>
						
                        <!-- PEB -->
						<?php if($PEB>0) {?>
                        <div style="float:left; position:relative; width:100px; height:50px; margin:30px 0px 0 0;  padding:15px; z-index:9999">
                               	<img src="img-PEB/img/peb_<?=peblettre($PEB)?>.png" />
                        </div>
                        <?php } ?>

                    
						<div id="rev_slider_6" class="rev_slider fullscreenbanner">
							<ul>	
								<?php for ($i = 0; $i <= 20; $i++) { 
									if ($i<10){ $i="0".$i;}
									if ($data['PHOTO_'.$i]!='') {
								?>
								    <!-- SLIDE  -->
									<li data-transition="random" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-rotate="0" data-saveperformance="off"  data-title="Slide">
	
										<img src="<?php echo $data['PHOTO_'.$i]; ?>" alt="<?php echo $titre; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" />
	
									</li>
								
								<? 		} 
								} ?>
								
								
							</ul>
						</div>
						
						<div class="infos-principales">
							<h2>
								<?php echo '<span style="text-transform: uppercase;">'.$libele_offre.'</span> - '.$type.' à '.$localite; ?> - <?php echo '<span style="color: #325d82">'.number_format($prix, 0, ',', ' ').'<sup>€</sup></span>'; ?>
							</h2>
						</div>
                        

					</div>
                    
                    
				</div>
			</div>
		</div>
        

		
		<div style="margin-top: -150px;" class="section pt-5 pb-2 bg-gray principaux-pictos">
			<div class="container">
				<div class="row">
					
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<ul>
								<?php if($surface) { ?>
									<li style="margin-left:-4px"><img src="images/fiche-surf.png" /> <?php echo number_format($surface, 0, ',', ' '); ?>m<sup>2</sup></li>
								<?php } ?>
								
								<?php if($nb_chambres) { ?>
									<li><i class="glyph-icon flaticon-bed"></i> <?php echo $nb_chambres; ?></li>
								<?php } ?>
								
								<?php if($nb_sdb) { ?>
									<li><i class="glyph-icon flaticon-medical"></i> <?php echo $nb_sdb; ?></li>
								<?php } ?>
							</ul>
						</div>
						
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<ul>
								<?php if($surface_terrain) { ?>
									<li><i class="glyph-icon flaticon-home"></i> <?php echo number_format($surface_terrain, 0, ',', ' '); ?>m<sup>2</sup></li>
								<?php } ?>
								<?php if($nb_garages) { ?>
									<li><i class="glyph-icon flaticon-vehicle"></i> <?php echo $nb_garages; ?></li>
								<?php } ?>
								<?php if($annee) { ?>
									<li><i class="glyph-icon flaticon-annual"></i> <?php echo $annee; ?></li>
								<?php } ?>
							</ul>
						</div>
						
						
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<h3 class="heading wg-title">Description</h3>
						<p><?php echo $description; ?></p>
                        <?php if ($cacherprix!=1){ echo "<h3>".number_format($data['prix'], 0, ',', ' ').'<sup>€</sup></h3>'; } else {echo "<h3>Prix sur demande</h3>";} ?>
					</div>
						
						<div style="clear: both"></div>						
				</div>
			</div>
		</div>
		
		<div class="section ">
			<div class="container">
				<div class="row">
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class=" mt-5 mb-5 zone-contact">
							
							<div style="padding: 0" class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<a href="agence-jorion-desmet-tournai--73--contact?a=visite&ref_bien=<?php echo $ref; ?>" title="Visiter ce bien">
									<div class="item-zone-contact">
										<i class="flaticon-home-1"></i>
										Visiter ce bien
									</div>
								</a>
							</div>
							
							<div style="padding: 0" class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<a href="agence-jorion-desmet-tournai--73--contact?a=infos&ref_bien=<?php echo $ref; ?>" title="En savoir plus sur ce bien">
									<div class="item-zone-contact">
										<i class="flaticon-contract"></i>
										En savoir plus
									</div>
								</a>
							</div>
							<div style="clear: both"></div>	
						</div>
					</div>
					
												
				</div>
			</div>
		</div>
		
		<div class="section pt-5 pb-5">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#caracteristiques" aria-controls="caracteristiques" role="tab" data-toggle="tab">Détail</a></li>
					    <li role="presentation" ><a href="#composition" aria-controls="composition" role="tab" data-toggle="tab">Composition</a></li>
					    <li role="presentation"><a href="#peb" aria-controls="peb" role="tab" data-toggle="tab">Energies</a></li>
					    
					  </ul>
					  
					  	<div class="tab-content">
						  	<div role="tabpanel" class="tab-pane fade in active" id="caracteristiques">
							  	<ul>
								  	<?php if($ref) { ?>
								  		<li>Référence : <?php echo $ref; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($type) { ?>
								  		<li>Type de bien : <?php echo $type; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($style) { ?>
								  		<li>Style du bien : <?php echo $style; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($statut) { ?>
								  		<li>Statut du bien : <?php echo $statut; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($annee) { ?>
								  		<li>Année de construction : <?php echo $annee; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($region) { ?>
								  		<li>Région : <?php echo $region; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($quartier) { ?>
								  		<li>Quartier : <?php echo $quartier; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($etat) { ?>
								  		<li>Etat : <?php echo $etat; ?></li>
								  	<?php } ?>
								 
								 
								  	<?php if($surface) { ?>
								  		<li>Surface habitable : <?php echo number_format($surface, 0, ',', ' '); ?>m<sup>2</sup></li>
								  	<?php } ?>
								  	
								  	<?php if($surface_terrain) { ?>
								  		<li>Surface du terrain : <?php echo number_format($surface_terrain, 0, ',', ' '); ?>m<sup>2</sup></li>
								  	<?php } ?>
								  	
								  	<?php if($surface_terrasse) { ?>
								  		<li>Surface de la terrasse : <?php echo number_format($surface_terrasse, 0, ',', ' '); ?>m<sup>2</sup></li>
								  	<?php } ?>
								  	
								  	<?php if($nb_chambres) { ?>
								  		<li>Nombre de chambre(s) : <?php echo $nb_chambres; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($nb_sdb) { ?>
								  		<li>Nombre de salle(s) de bain : <?php echo $nb_sdb; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($type_chauffage) { ?>
								  		<li>Type de chauffage : <?php echo $type_chauffage; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($gaz=='1') { ?>
								  		<li>Equipé au Gaz</li>
								  	<?php } ?>
								  	
								  	<?php if($elec_chiffre) { ?>
								  		<li>Caractéristique électrique : <?php echo $elec_chiffre; ?></li>
								  	<?php } ?>
								  	
								  	<?php if($facade) { ?>
								  		<li>Nombre de façade(s) : <?php echo $facade; ?></li>
								  	<?php } ?>
								  	<?php if($jardin=='1') { ?>
								  		<li>Jardin</li>
								  	<?php } ?>
								  	<?php if($etage) { ?>
								  		<li>Etages : <?php echo $etage; ?></li>
								  	<?php } ?>
								  	<?php if($ascenseur =='1') { ?>
								  		<li>Ascenseur</li>
								  	<?php } ?>
								  	<?php if($cave=='1') { ?>
								  		<li>Cave</li>
								  	<?php } ?>
								  	<?php if($cour=='1') { ?>
								  		<li>Cour</li>
								  	<?php } ?>
								  	
								  	
								  	
						  		</ul>
	
						  	</div>
						  
							<div role="tabpanel" class="tab-pane fade " id="composition">
								  	<p><?php echo $composition; ?></p>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="peb">
								<?php include('./img-PEB/PEB.php'); ?>
							</div>
						  
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- VIDEO -->
        <?php if ($virtuel){ ?>
<!--
        <a name="video" id="video"></a>
        <a href="<?=$data['virtuel']?>" target="_blank">
        <div class="section">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12 p-0">
								<div id="rev_slider_3" class="rev_slider fullscreenbanner">
									<ul>
										
										<li data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-rotate="0" data-saveperformance="off" data-title="Slide 01">

											<img src="images/fiche-video.jpg" alt="" data-bgposition="center center" data-bgfit="cover" class="" />

											
											<div class="rs-background-video-layer" data-forcerewind="on" data-volume="50"
												 data-ytid="<?=$virtuel?>"
												 data-videoattributes="version=3&amp;enablejsapi=1&amp;html5=1&amp;volume=20&amp;autoplay=1&amp;loop=2&amp;hd=1&amp;wmode=opaque&amp;showinfo=0&amp;rel=0;"
												 data-videorate="1" data-videowidth="100%" data-videoheight="100%" data-videocontrols="none"
												 data-videostartat="00:00" data-videoendat="00:00" data-videoloop="loopandnoslidestop"
												 data-forceCover="1" data-aspectratio="16:9" data-autoplay="true"
												 data-autoplayonlyfirsttime="false" data-nextslideatend="true">
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
			</div>
			</a>
-->
           <?php } ?>
	

	
	
</div>