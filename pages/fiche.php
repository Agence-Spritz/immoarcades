<?php	// Requête pour récupérer le contenu de la page concernée
		$req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE ID='$id'"); 
		$data = mysqli_fetch_array($req);
		
		$venduloue = $data['venduloue'];
		$titre = $data['titre'];
		$localite = $data['localite'];
		$region = $data['cregion'];
		$quartier = $data['quartier'];
		$typesimple = $data['typesimple'];
		$type = $data['type'];
		$type = str_replace(' ', '', $type);
		$prix = $data['prix'];
		$prixnet = $data['prixnet'];
		$honoraires = $data['honoraires'];
		$cacherprix = $data['cacherprix'];
		$description = $data['descrlight'];
		$composition = $data['composition'];
		// On remplace les doubles sauts de ligne
		$composition = str_replace('<br><br>', '<br>', $composition); 
		$surface = $data['qsurfhab'];
		$nb_chambres = $data['chambre'];
		$nb_garages = $data['qgarages'];
		$nb_sdb = $data['sdb'];
		$surface_terrain = $data['qsurfterrain'];
		$surface_terrasse = $data['qsurfterrasse'];
		$annee = $data['nannee'];
		$ref = $data['ref'];
		$style = $data['stylemaison'];
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
		
		if($data['peb']!="") {
			$PEB = $data['peb'];
		} else {
			$PEB = 'N.C.';
		}
		
		if($data['ges']!="") {
			$GES = $data['ges'];
		} else {
			$GES = 'N.C.';
		}
		
		
		$masquer_adresse = $data['masquer_adresse'];
		
		if($masquer_adresse!=1 && $data['adresse']!="") {
			$adresse = $data['adresse'];
		} else {
			$adresse = $data['localite'];
		}	
			
			
?>

<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA5VUcLfsIR19n-mkuTd-OkQ5w4uA7nPnU&sensor=false&extension=.js'></script>
<script >
var geocoder;
var map;
var address = "<?php echo $adresse; ?>";

function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(50.7210333, 3.1226551);
  var myOptions = {
    zoom: 8,
    center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
  if (geocoder) {
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

          var marker = new google.maps.Marker({
            position: results[0].geometry.location,
            map: map,
            title: address
          });
          

        } else {
          alert("Aucune adresse trouvée");
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div id="main">
	
	<!-- Corps de la page
	================================================== -->
	
	
	<div class="section single-portfolio pt-11 pb-9">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-lg-8">
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
										
										<?php  } 
										} ?>
										
									</ul>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<h5 class="wg-title"><?php echo $localite; ?></h5>
								<h3 class="entry-title fw-bolder"><?php echo $titre; ?></h3>
								
								<ul class="entry-meta single-meta">
									<li class="extra-font dark"><i><?php if ($cacherprix!=1){ echo "<h3 style=' display: inline;'>".number_format($data['prix'], 0, ',', ' ').'<sup>€</sup></h3>'; } else {echo "<h3>Prix sur demande</h3>";} ?></i>
									
									<?php if ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
									<?php echo ' <h3 style="display: inline; margin-left: 25px; color: #d90102; text-align: right;" class="sub-heading"><i>--'.$venduloue.'--</i></h3>'; ?>
									<?php } ?>
									
									</li>
									<li>
										<span class="meta-title">Type:</span> 
										<span class="extra-font"><i><?php echo $type; ?></i></span>
									</li>
									<li class="detail-categories">
										<span class="meta-title">Réf. : </span>
										<span class="extra-font">
											<a href="#"><i><?php echo $ref; ?></i></a>
										</span>
									</li>
								</ul>
								
								<ul class="social mb-2">
									<li><a target="_blank" href="http://twitter.com/intent/tweet/?url=<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>&text=<?=$ogtitre?>">
											<i class="fa fa-twitter dark"></i>
										</a>
									</li>
									<li><a target="_blank" href="http://www.facebook.com/sharer.php?u=http://<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>&t=<?=$ogtitre?>">
											<i class="fa fa-facebook dark"></i>
										</a>
									</li>
									<li><a target="_blank" href="https://plus.google.com/share?url=<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>">
											<i class="fa fa-google-plus dark"></i>
										</a>
									</li>
									<li><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>&title=<?=$ogtitre?>">
											<i class="fa fa-linkedin dark"></i>
										</a>
									</li>
								</ul>
								
								<?php
								
								// Compteur de MaSelection 
								$xpldSelection=explode("-",$_COOKIE['immo-selection']);
								$NbrSelection=count($xpldSelection)-1;
								
								// DEFINIT "Ajouter" ou "Supprimer" au chargement de la page
								if (!stristr($_COOKIE['immo-selection'],$id )){
									$msgSelection='<i class="flaticon-shopping-cart"></i> Ajouter à ma liste de sélections';
									$selectID="OK";
								} else {
									$msgSelection='<i class="fa fa-close" style="color: #fe0000;"></i> Supprimer de ma liste de sélections';
									$selectID="NO";
								}
								?>
								
								<ul class="selection">
									<li><a href="javascript: void(0);"><div class="AddMaselection"><?=($selectID=="OK")?($msgSelection):('')?></div></a></li>
									<li><a href="javascript: void(0);"><div class="DelMaselection"><?=($selectID=="NO")?($msgSelection):('')?></div></a></li>
								</ul>	
									
							</div>
						</div>
						
						<!-- Boutons d'action -->
						<div class="row">
							<div class="col-lg-12">
								<hr>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<a class="btn btn-alt btn-border fullwidth" href="contacter-agence-immo--73--contact?a=visite&ref_bien=<?php echo $ref; ?>">Demande de visite</a>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">	
								<a class="btn btn-alt btn-border fullwidth" href="contacter-agence-immo--73--contact?a=infos&ref_bien=<?php echo $ref; ?>">En savoir plus</a>
							</div>
							<div class="col-lg-12">
								<hr>
							</div>
						</div>
						
						<!-- Description -->
						<div class="row">
							<div class="col-sm-12">
								<h5 class="wg-title mt-3 mb-3">Description</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<p><?php echo $description; ?></p>
							</div>
						</div>
						
						<!-- Les plus -->
						<div class="row">
							<div class="col-sm-12">
								<h5 style="color: #d90102" class="wg-title mt-3 mb-2">Les plus</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="tags mb-2">
									<div class="entry-tags tagcloud">
										<?php if($surface) { ?>
											<a href="#"> <?php echo number_format($surface, 0, ',', ' '); ?>m<sup>2</sup></a> 
										<?php } ?>
										
										<?php if($nb_pieces) { ?>
											<a href="#"> <?php echo $nb_pieces; ?> pièces</a> 
										<?php } ?>
										
										<?php if($nb_chambres) { ?>
											<a href="#"> <?php echo $nb_chambres; ?> chambres</a>
										<?php } ?>
										
										<?php if($surface_terrain) { ?>
											<a href="#"> <?php echo number_format($surface_terrain, 0, ',', ' '); ?>m<sup>2</sup></a>
										<?php } ?>
										<?php if($nb_garages) { ?>
											<a href="#"> <?php echo $nb_garages; ?> garages</a>
										<?php } ?>
										<?php if($annee) { ?>
											<a href="#"> <?php echo $annee; ?></a>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<?php echo $composition; ?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3 mb-2">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#caracteristiques" aria-controls="caracteristiques" role="tab" data-toggle="tab">Caractéristiques principales</a></li>
									<li role="presentation" ><a href="#gaz" aria-controls="gaz" role="tab" data-toggle="tab">Energie GES</a></li>
								    <li role="presentation"><a href="#peb" aria-controls="peb" role="tab" data-toggle="tab">Indice énergétique DPE</a></li>
								    <li role="presentation"><a href="#honoraires" aria-controls="honoraires" role="tab" data-toggle="tab">Honoraires</a></li>
								    
								</ul>
							  
							  	<div class="tab-content">
								  	<div role="tabpanel" class="tab-pane fade in active" id="caracteristiques">
									  	<ul>
										  	<?php if($ref) { ?>
										  		<li>Référence : <?php echo $ref; ?></li>
										  	<?php } ?>
										  	
										  	<?php if($localite) { ?>
										  		<li>Localité : <?php echo $localite; ?></li>
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
										  	
										  	<?php if($annee) { ?>
										  		<li>Année de construction : <?php echo $annee; ?></li>
										  	<?php } ?>
										  	
										  	<?php if($nb_chambres) { ?>
										  		<li>Nombre de chambre(s) : <?php echo $nb_chambres; ?></li>
										  	<?php } ?>
										  	
										  	<?php if($nb_garages) { ?>
										  		<li>Nombre de garage(s) : <?php echo $nb_garages; ?></li>
										  	<?php } ?>
										  	
										  	<?php if($facade) { ?>
										  		<li>Nombre de façade(s) : <?php echo $facade; ?></li>
										  	<?php } ?>
										  	
										  	<?php if($chassis) { ?>
										  		<li>Chassis : <?php echo $chassis; ?></li>
										  	<?php } ?>
										  	
										  	<?php if($type_chauffage) { ?>
										  		<li>Type de chauffage : <?php echo $type_chauffage; ?></li>
										  	<?php } ?>
										  	
										  	<?php if($surface) { ?>
										  		<li>Surface totale : <?php echo number_format($surface, 0, ',', ' '); ?>m<sup>2</sup></li>
										  	<?php } ?>
										  	
										  	<?php if($surface_jardin) { ?>
										  		<li>Surface du jardin : <?php echo number_format($surface_jardin, 0, ',', ' '); ?>m<sup>2</sup></li>
										  	<?php } ?>
										  	
										  	<?php if($surface_sejour) { ?>
										  		<li>Surface du séjour : <?php echo number_format($surface_sejour, 0, ',', ' '); ?>m<sup>2</sup></li>
										  	<?php } ?>
										  	
										  	<?php if($surface_terrain) { ?>
										  		<li>Surface du terrain : <?php echo number_format($surface_terrain, 0, ',', ' '); ?>m<sup>2</sup></li>
										  	<?php } ?>
										  	
										  	<?php if($surface_terrasse) { ?>
										  		<li>Surface de la terrasse : <?php echo number_format($surface_terrasse, 0, ',', ' '); ?>m<sup>2</sup></li>
										  	<?php } ?>
										  	
								  		</ul>
								  	</div>
									<div role="tabpanel" class="tab-pane fade " id="gaz">
										  	<?php if($GES) { ?>
											<p><strong>Emissions de gaz à effet de serre (GES) : </strong><?php echo $GES.' kWhEP/m².an';?></p>	
											<?php } ?>
											<div id="ges"></div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="peb">
											<?php if($PEB) { ?>
												<p><strong>Indice de performance énergétique (DPE) : </strong><?php echo $PEB.' kgéqCO2/m².an';?></p>
											<?php } ?>
											<div id="dpe"></div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="honoraires">
										<?php if($honoraires=='vendeur') {
											echo "<strong>À charge du vendeur</strong>";
										} else {
											echo "<strong>À charge de l’acquéreur</strong> <br /><br />";
											echo number_format($prixnet, 0, ',', ' '). "&euro; honoraires exclus - Honoraires de " .round(100-($prixnet*100)/$prix,2)."% TTC à charge de l’acquéreur";
										}
										?>
									</div>
									
								</div>
							</div>
							
						</div>
						
						<!-- Plan -->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2">
								<?php if($masquer_adresse==0) { ?><div id="map-canvas"></div><?php } ?>
							</div>
						</div>
						
						<!-- Biens relatifs -->
						<?php 
							// On va calculer la tranche de prix des suggestions
							$prix_en_cours = $prix;
							$taux_fourchette = 0.25;
							
							$prix_recherche_min = $prix - ($prix*$taux_fourchette);
							$prix_recherche_max = $prix + ($prix*$taux_fourchette);
							
							$req_2 = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE (venduloue is null or venduloue = '') AND type ='".$type."' AND ID <> ".$id." AND prix > ".$prix_recherche_min." AND prix < ".$prix_recherche_max." LIMIT 0,4 "); 
							
						
						// On vérifie qu'il y ait des résultats
							if($req_2->num_rows>0) {
						?>
						
						<div class="row">
							<div class="col-sm-12">
								<h5 class="wg-title mt-3 mb-3">D'autres biens pourraient vous intéresser...</h5>
							</div>
						</div>
						<div class="row">
							
							<?php 
						  	while ($data_2 = mysqli_fetch_array($req_2)) { 
							?>
							
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="portfolio-grid-item overlay-wrap">
										<div class="entry-media">
											<img src="<?php echo $data_2['PHOTO_01']; ?>" alt="<?php echo $data_2['titre']; ?>" title="<?php echo $data_2['titre']; ?>" />
										</div>
										<div class="overlay left-right">
											<div class="overlay-inner">
												<div class="entry-header">
													<h3 class="entry-title">
														<a href="<?php echo $data_2['type']; ?>-nord-tourcoing-<?php echo $data['localite']; ?>--<?php echo $data_2['ID']; ?>--fiche"><?php echo $data_2['titre']; ?></a>
													</h3>
													<ul class="entry-meta extra-font italic">
														<li><a href="#"><?php echo $data_2['type']; ?></a></li>
													</ul>
												</div>
											</div>
											<div class="entry-footer text-right">
												<a class="entry-readmore" href="<?php echo $data_2['type']; ?>-nord-tourcoing-<?php echo $data_2['localite']; ?>--<?php echo $data_2['ID']; ?>--fiche">Découvrir</a>
											</div>
										</div>
									</div>
								</div>
							
							<?php } ?>
						
						</div>
						<?php } ?>
						
					</div>
				</div>

<!-- Pub financement
	================================================== -->
	<div class="section section-pub-financement section-fixed pt-14 pb-14">
		<div class="bg-overlay-dark"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center">
						<h2 class="page-title mb-4 ">Une solution pour financer votre projet ?</h2>
						<a class="btn btn-alt btn-border " href="contacter-agence-immo--73--contact">Contactez-nous !</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
</div>

 <script src="js/dpeges/dpeges.js"></script>
<script type="text/javascript">
  var dpe = new DpeGes();
  dpe.dpe({
    value: '<?php echo $PEB; ?>',
    domId: 'dpe',
    width: 350,
  });
  var ges = new DpeGes();
  ges.ges({
    domId: 'ges',
    value: '<?php echo $GES; ?>',
    width: 350,
  });
</script>
    

<!-- BOUTON COMPARER --> 
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
	/*Message ajouter ou supprimer + cookie update*/
	$('.AddMaselection').click(function(){
		$.post('./panier-biens/inc/MaSelectionCookie.php',{addselection:'<i class="fa fa-close" style="color:#fe0000"></i> Supprimer de ma liste de sélections', selectID:'OK-<?=$id?>', NbrSelection:<?=$NbrSelection?>},
		function(data){
			$('.DelMaselection').html(data),
			$('.AddMaselection').html('')
			$('.SelectionCompteur').html(<?=($selectID=="OK")?($NbrSelection+1):($NbrSelection)?>)/*Compteur*/
		});
	})
                                    
	$('.DelMaselection').click(function(){
		$.post('./panier-biens/inc/MaSelectionCookie.php',{addselection:'<i class="flaticon-shopping-cart"></i> Ajouter à ma liste de sélections', selectID:'NO-<?=$id?>', NbrSelection:<?=$NbrSelection?>},
		function(data){
			$('.AddMaselection').html(data),
			$('.DelMaselection').html(''),
			$('.SelectionCompteur').html(<?=($selectID=="NO")?($NbrSelection-1):($NbrSelection)?>)/*Compteur*/
		});
	})
</script>