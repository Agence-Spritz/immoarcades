<?php // Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre,texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
	
	// On initialise la variable agence
	$agence = NULL;
	$add_agence = "AND agence = '$agence'";
	
	if ($id=='178' || $id=='179' || $id=='67'){
		// On adapte le titre en fonction de l'agence sélectionnée dans le menu
		
			if($id=='178' && !$_POST['agence']) {
				
				$fond = "section-bg-tourcoing";
				$agence = 1;
				$add_agence = "AND agence = '$agence'";
				
			} else if($id=='179' && !$_POST['agence']) {
				$fond = "section-bg-lys";
				$agence = 2;
				$add_agence = "AND agence = '$agence'";
				
			} else if($id=='67') {
			
				$fond = "section-bg-generique";
				$add_agence = "";
			} 
		
	} 
	?>
	
	<?php 	
		// On va adapter la requête en fonction des elements postés lors de la recherche
		if ($_POST['submit']=='Rechercher') {
			
			// recherche sur l'agence
			if ($_POST['agence']) {
				$agence = $_POST['agence'];
				$add_agence = "AND agence = '$agence'";
			} 
			
			//argument de type
			if ($_POST['type']) {
				$type = array();
				$type = $_POST['type'];
				$type = implode(',', $type);
				$add_type = "AND type IN ('$type')";
			} else {
				$type = "";
			}
			
			//argument de Code postal
			if ($_POST['codepostal']) {
				$codepostal = $_POST['codepostal'];
				$add_codepostal = "AND codepostal = '$codepostal'";
			} else {
				$codepostal = "";
			}
			
			//argument de localite
			if ($_POST['localite']) {
				$localite = $_POST['localite'];
				$add_localite = "AND localite = '$localite'";
			} else {
				$localite = "";
			}
			
			//argument de surface
			if ($_POST['surface_min']) {
				$surface_min = $_POST['surface_min'];
				$add_surface_min = "AND surfhab >= '$surface_min'";

			} else {
				$surface_min = "";
			}
			
			//argument de prix
			if ($_POST['prix_mini'] || $_POST['prix_maxi']) {
				
				// On va déterminer les prix min et max de la BDD
				$req = mysqli_query($link,"SELECT MAX(prix) as max, MIN(prix) as min FROM ".$table_prefix."_biens"); 
			  	$data = mysqli_fetch_array($req);

				
				if($_POST['prix_mini']!="") {
					$prix_min = $_POST['prix_mini'];	
				} else {
					$prix_min = $data['min'];
				}
				
				if($_POST['prix_maxi']!="") {
					$prix_max = $_POST['prix_maxi'];	
				} else {
					$prix_max = $data['max'];
				}
				
				$add_prix = "AND prix BETWEEN '$prix_min' AND '$prix_max'";
				
			} else {
				$prix_min = "";
				$prix_max = "";
			}
			
			//argument de terme clé
			if ($_POST['recherche_terme']) {
				$recherche_terme = $_POST['recherche_terme'];
				$add_terme = "AND (titre LIKE '%$recherche_terme%' OR descrlight LIKE '%$recherche_terme%' OR composition LIKE '%$recherche_terme%' OR type LIKE '%$recherche_terme%' OR localite LIKE '%$recherche_terme%' OR codepostal LIKE '%$recherche_terme%' OR ref LIKE '%$recherche_terme%')";
			} else {
				$recherche_terme = "";
			}
			
			
			
			 /*MOTS CLES*/
			if ($_POST['recherche_generale'])     
            {    
	              
                $search_keyword=addslashes($_POST['recherche_generale']);
                $motcle = explode(" ",$search_keyword,4); $nb_de_mot=count($motcle);
                // REQUETE RUBRIQUE
                for ($a=0; $a<$nb_de_mot; $a++) {$requete.=" OR (codepostal LIKE '%$motcle[$a]%' OR localite LIKE '%$motcle[$a]%' OR titre LIKE '%$motcle[$a]%' OR type LIKE '%$motcle[$a]%' OR ref LIKE '%$motcle[$a]%' OR quartier LIKE '%$motcle[$a]%' OR descrlight LIKE '%$motcle[$a]%' OR prix LIKE '%$motcle[$a]%')";}
                $requete=substr($requete,3,1000);
        
                $add_recherche = (" AND ".$requete);
            } else {
	            $add_recherche = "";
            }

		}
		
		//Enlever les commentaires pour afficher les valeurs postées

/*
				echo $add_agence.'<br />';
				echo $add_type.'<br />';
				echo $add_codepostal.'<br />';
				echo $add_localite.'<br />';
				echo $add_surface_min.'<br />';
				echo $add_prix.'<br />';
				echo $add_terme.'<br />';
				echo $add_recherche. '<br />';
*/
?>


<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	<div class="section <?php echo $fond; ?> section-fixed pt-14 pb-3">
		<div class="bg-overlay-dark"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center">
						<h2 class="page-title"><?php echo $texte2p; ?></h2>
					
						<div class="breadcrumb" style="color: #fff;">
							<?php if($textep) {?>
								<p><?php echo $textep; ?></p>
							<?php } ?>
						
							<ul class="breadcrumbs">
								<li><a href="<?php echo $defaultpg; ?>.php">Accueil</a></li>
								<?php if ($id=="178" || $id=="179") { ?>
								<li><a href="biens-immobiliers-nord-tourcoing--67--resultat">Acheter</a></li>
								<?php } ?>
								<li><?php echo $titrep; ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--  Biens à la une première ligne-->
	<div class="section liste-biens pt-4 mobile-hide">
		<div class="container">
			<div class="row">
				
				<div class="mb-5">
					<h2 class="sub-heading text-center text-surligne">
						<span class="f2">Belles opportunités</span>
					</h2>
				</div>
				
				<?php $req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE nouveaute IS NOT NULL ORDER BY dmod DESC LIMIT 0,3"); 
				  	while ($data = mysqli_fetch_array($req)) { 
						$venduloue = $data['venduloue'];
				?>
				
				<div class="col-sm-4 entry-media" style="<?php if ($n==4){ echo 'clear:both';} ?>">
					<div class="mb-2">
						<h3 class="heading wg-title"><?php echo $data['localite']; ?></h3>
						<h2 class="extra-font">
							<span class="f2">
							<?php if ($data['cacherprix']!=1){?>
								<?php echo number_format($data['prix'], 0, ',', ' ').'<sup>€</sup>'; ?>
                            <?php } else {echo "Prix sur demande";} ?>
							</span>
						</h2>
					</div>
					<div class="zone-titre-liste">
						<p class="description">
							<?php echo CleanCut($data['descrlight'],100); ?><br />
						</p>
					</div>
					<a href="<?php echo $data['type']; ?>-nord-tourcoing-<?php echo $data['localite']; ?>--<?php echo $data['ID']; ?>--fiche">
						<div style="position: relative;" class="visuel-bien mt-2 mb-3">
							<img src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
							<?php if ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
							<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
							<?php } ?>
							<div class="label"><a href="javascript: void(0)" title="Belle opportunité"><i class="flaticon-construction"></i></a></div>
						</div>
					</a>
				</div>
				
				<?php } ?>
			</div>
		</div>
	</div>


	<!-- Zone de filtres
	================================================== -->	
	
	<div class="section pt-2">
		<div class="container">
			<div class="row">
				
				<div class="col-md-12 col-lg-12">
					<div class="zone-recherche">
						<form id="recherche_generale" method="POST" action="">
							
							<div class="col-xs-12 col-md-6 col-lg-6 mb-2">
							<h4 class="heading wg-title"><i class="flaticon-house-search"></i>Que recherchez-vous ?</h4>
							</div>
							
							<div class="col-xs-12 col-md-6 col-lg-6 mb-2 text-right lien_recherche">
								<a id="lien_recherche" href="javascript: void(0);">Recherche avancée</a>
							</div>
							
							<div class="col-xs-12 col-md-12 col-lg-12 mb-2">
								<input type="text" name="recherche_terme" placeholder="tapez ici un mot clé" value="<?php if ($_POST['recherche_terme']) { echo $recherche_terme; } else if ($_POST['recherche_generale']) { echo $_POST['recherche_generale']; } ?>" />
							</div>
							
							<div class="col-xs-12 col-md-12 col-lg-12">
							<label>Recherche par prix</label>
							</div>
							
							<div class="col-xs-12 col-md-6 col-lg-6 mb-2">
								<select name="prix_mini">
									<option value="">-- prix mini --</option>
									<option value="0" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==0) {echo "selected";} ?>>0</option>
									<option value="25000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==25000) {echo "selected";} ?>>25 000</option>
									<option value="50000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==50000) {echo "selected";} ?>>50 000</option>
									<option value="75000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==75000) {echo "selected";} ?>>75 000</option>
									<option value="100000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==100000) {echo "selected";} ?>>100 000</option>
									<option value="125000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==125000) {echo "selected";} ?>>125 000</option>
									<option value="150000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==150000) {echo "selected";} ?>>150 000</option>
									<option value="175000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==175000) {echo "selected";} ?>>175 000</option>
									<option value="200000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==200000) {echo "selected";} ?>>200 000</option>
									<option value="250000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==250000) {echo "selected";} ?>>250 000</option>
									<option value="300000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==300000) {echo "selected";} ?>>300 000</option>
									<option value="350000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==350000) {echo "selected";} ?>>350 000</option>
									<option value="400000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==400000) {echo "selected";} ?>>400 000</option>
									<option value="500000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==500000) {echo "selected";} ?>>500 000</option>
									<option value="1000000" <?php if(isset($_POST['prix_mini']) && $_POST['prix_mini']==1000000) {echo "selected";} ?>>1 000 000</option>
								</select>
							</div>
							
							<div class="col-xs-12 col-md-6 col-lg-6 mb-2">
								<select name="prix_maxi">
									<option value="">-- prix maxi --</option>
									<option value="25000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==25000) {echo "selected";} ?>>25 000</option>
									<option value="50000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==50000) {echo "selected";} ?>>50 000</option>
									<option value="75000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==75000) {echo "selected";} ?>>75 000</option>
									<option value="100000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==100000) {echo "selected";} ?>>100 000</option>
									<option value="125000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==125000) {echo "selected";} ?>>125 000</option>
									<option value="150000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==150000) {echo "selected";} ?>>150 000</option>
									<option value="175000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==175000) {echo "selected";} ?>>175 000</option>
									<option value="200000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==200000) {echo "selected";} ?>>200 000</option>
									<option value="250000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==250000) {echo "selected";} ?>>250 000</option>
									<option value="300000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==300000) {echo "selected";} ?>>300 000</option>
									<option value="350000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==350000) {echo "selected";} ?>>350 000</option>
									<option value="400000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==400000) {echo "selected";} ?>>400 000</option>
									<option value="500000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==500000) {echo "selected";} ?>>500 000</option>
									<option value="1000000" <?php if(isset($_POST['prix_maxi']) && $_POST['prix_maxi']==1000000) {echo "selected";} ?>>1 000 000</option>
								</select>
							</div>
							<div class="clearfix"></div>
							
							<div id="recherche_simple" class="col-xs-12 col-md-6 col-lg-6 mb-1">
								<label>Recherche par zone géographique</label>
								<select name="agence">
									<option value="" selected=selected>toute zone</option>
									<option value="1" <?php if(isset($_POST['agence']) && $_POST['agence']==1) {echo "selected";} ?>>autour de Tourcoing</option>
									<option value="2" <?php if(isset($_POST['agence']) && $_POST['agence']==2) {echo "selected";} ?>>autour de Lys-lez-lannoy</option>
								</select>
							</div>
							
							<div id="recherche_avancee">
								<div class="col-xs-12 col-md-6 col-lg-6 mb-2">
									<label>Code Postal</label>
									<input type='text'
									       placeholder='Tapez un code postal'
									       class='flexdatalist'
									       data-min-length='1'
									       list='code_postal'
									       name='codepostal'
									       value='<?php if(isset($_POST['codepostal'])) {echo $_POST['codepostal'];} ?>'>
									
									<datalist id="code_postal">
									    <?php $req = mysqli_query($link,"SELECT DISTINCT codepostal FROM ".$table_prefix."_biens WHERE 1 AND codepostal<>'' ORDER BY codepostal ASC"); 
										  	while ($data = mysqli_fetch_array($req)) { 
										?>
											<option value="<?php echo $data['codepostal']; ?>"><?php echo $data['codepostal']; ?></option>
										<?php } ?>
									    
									</datalist>
								</div>
							
								<div class="col-xs-12 col-md-6 col-lg-6 mb-2 ">
									<label>Ville</label>
									<input type='text'
									       placeholder='Entrez la ville de votre choix'
									       class='flexdatalist'
									       data-min-length='1'
									       list='localite'
									       name='localite'
									       value='<?php if(isset($_POST['localite'])) {echo $_POST['localite'];} ?>'>
									
									<datalist id="localite">
									    <?php $req = mysqli_query($link,"SELECT DISTINCT localite FROM ".$table_prefix."_biens WHERE 1 AND localite<>'' ORDER BY localite ASC"); 
										  	while ($data = mysqli_fetch_array($req)) { 
										?>
											<option value="<?php echo $data['localite']; ?>"><?php echo $data['localite']; ?></option>
										<?php } ?>
									    
									</datalist>
								</div>
								<div class="col-xs-12 col-md-6 col-lg-6 mb-1">
									<label>Recherche par type</label>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" name="type[]" type="checkbox" id="maison" value="Maison" <?php if(isset($_POST['type']) && in_array("Maison", $_POST['type'])) {echo "checked";} ?>>
									  <label class="form-check-label" for="maison">Maison</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" name="type[]" type="checkbox" id="appartement" value="Appartement" <?php if(isset($_POST['type']) && in_array("Appartement", $_POST['type'])) {echo "checked";} ?>>
									  <label class="form-check-label" for="appartement">Appartement</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" name="type[]" type="checkbox" id="terrain" value="Terrain" <?php if(isset($_POST['type']) && in_array("Terrain", $_POST['type'])) {echo "checked";} ?>>
									  <label class="form-check-label" for="terrain">Terrain</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" name="type[]" type="checkbox" id="immeuble" value="Immeuble" <?php if(isset($_POST['type']) && in_array("Immeuble", $_POST['type'])) {echo "checked";} ?>>
									  <label class="form-check-label" for="immeuble">Immeuble de rapport</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" name="type[]" type="checkbox" id="autre" value="Autre" <?php if(isset($_POST['type']) && in_array("Autre", $_POST['type'])) {echo "checked";} ?>>
									  <label class="form-check-label" for="autre">Autre</label>
									</div>
								</div>
								
								<div class="col-xs-12 col-md-6 col-lg-6 mb-1">
									<label>Surface minimale</label>
									<input type='text'
									       placeholder='en m2'
									       class='flexdatalist'
									       data-min-length='1'
									       list='surface_min'
									       name='surface_min'
									       value='<?php if(isset($_POST['surface_min'])) {echo $_POST['surface_min'];} ?>'>
									
									<datalist id="surface_min">
											<option value="20" >20</option>
											<option value="30" >30</option>
											<option value="50" >50</option>
											<option value="75" >75</option>
											<option value="100" >100</option>
											<option value="130" >130</option>
											<option value="150" >150</option>
											<option value="200" >200</option>
											<option value="300" >300</option>
									</datalist>
								</div>
							
							</div>
							
							<div class="col-xs-12 col-md-12 col-lg-12 mb-1">
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
					<div class="blog-list" >
						
						<?php // Requête générale pour lister les biens
							
							// On met dans une variable le nombre de biens qu'on veut par page
							$nombreDeBiensParPage = 10;
							// On récupère le nombre total de biens
							$req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE 1 ".$add_type." ".$add_agence." ".$add_codepostal." ".$add_localite." ".$add_surface_min." ".$add_prix." ".$add_terme." ".$add_recherche.""); 
							
								// Calcule le nbr de biens retournés par la requête
								$nb_biens = mysqli_num_rows($req);
								
								
									// On calcule le nombre de pages à créer
									$nombreDePages  = ceil($nb_biens / $nombreDeBiensParPage);
									
									 
									if (isset($_GET['page']))
									{
									        $page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse
									}
									else // La variable n'existe pas, c'est la première fois qu'on charge la page
									{
									        $page = 1; // On se met sur la page 1 (par défaut)
									}
									  
									// On calcule le numéro du premier bien qu'on prend pour le LIMIT de MySQL
									$premierBienAafficher = ($page - 1) * $nombreDeBiensParPage;
									 
									$req1 = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE 1 ".$add_type." ".$add_agence." ".$add_codepostal." ".$add_localite." ".$add_surface_min." ".$add_prix." ".$add_terme." ".$add_recherche." ORDER BY dmod DESC LIMIT " . $premierBienAafficher . ", " . $nombreDeBiensParPage);
										
									echo "SELECT * FROM ".$table_prefix."_biens WHERE 1 ".$add_type." ".$add_agence." ".$add_codepostal." ".$add_localite." ".$add_surface_min." ".$add_prix." ".$add_terme." ".$add_recherche." ORDER BY dmod DESC LIMIT " . $premierBienAafficher . ", " . $nombreDeBiensParPage;	
						?>
				
							<?php if ($nb_biens=='0') { ?>
							
								<div class="alert alert-warning" role="alert">Désolé, aucun bien ne semble correspondre à votre recherche, merci d'élargir celle-ci.</div>
							
							<?php }  else { 
								
									while ($data = mysqli_fetch_array($req1)) {
										$venduloue = $data['venduloue'];
								  	
										// Détermination des variables
										if ($venduloue=="") {
											$url_fiche = slugify($data['type']).'-'.slugify($data['localite']).'--maison-luxe-tournai-mouscron--'.$data['ID'].'--fiche';
										} else {
											$url_fiche = "#";
										}
										
										
										$type_bien =  clean_form($data['type']); 
										
										if($type_bien=="Maison") {
											$icone_bien = '<i class="flaticon-construction-9"></i>';
										} else if ($type_bien=="Ferme") {
											$icone_bien = '<i class="flaticon-construction-7"></i>';
										} else if ($type_bien=="Commerce") {
											$icone_bien = '<i class="flaticon-interview"></i>';
										} else if ($type_bien=="Penthouse") {
											$icone_bien = '<i class="flaticon-construction-11"></i>';
										} else if ($type_bien=="Appartement") {
											$icone_bien = '<i class="flaticon-buildings-1"></i>';
										} else if ($type_bien=="Terrain") {
											$icone_bien = '<i class="flaticon-nature"></i>';
										} else if ($type_bien=="Villa") {
											$icone_bien = '<i class="flaticon-nature-1"></i>';
										} else {
											$icone_bien = NULL;
										}
										
							?>
							
															
										<div class="entry-blog list resultats">
											
											<div style="position: relative;" class="blog-item bg-white">
												
												<div class="zone-survol">
												
													<!-- Zone de survol
															================================================== -->
													<?php // On affiche la zone de survol que si on a au moins 1 autre photo
														if($data['PHOTO_02']!="") { ?>
															<div class="survol-photo">
																
																<a id="action_toogle" href="<?php echo $url_fiche; ?>" title="En savoir plus" > 
																	<img style="float: left;" src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['localite']; ?>" title="<?php echo $data['titre']; ?>" />
																</a>
																
																<?php if($data['PHOTO_02']!="") { ?>
																	<a href="<?php echo $url_fiche; ?>" title="En savoir plus" > 
																		<img style="float: left;" src="<?php echo $data['PHOTO_02']; ?>" alt="<?php echo $data['localite']; ?>" title="<?php echo $data['titre']; ?>" />
																	</a>
																<?php } ?>
																
																<?php if($data['PHOTO_03']!="") { ?>
																	<a href="<?php echo $url_fiche; ?>" title="En savoir plus" > 
																		<img style="float: left;" src="<?php echo $data['PHOTO_03']; ?>" alt="<?php echo $data['localite']; ?>" title="<?php echo $data['titre']; ?>" />
																	</a>
																<?php } ?>
																	
																	<?php if ($venduloue=="") { ?>
																	<a href="<?php echo $url_fiche; ?>" title="En savoir plus" class="carre-plus"> 
																		<i class="flaticon-search"></i>
																	</a>
																	<?php } ?>
																	
															</div>
													<?php } ?>
													
													<div class="col-md-4 col-lg-4">
														<div class="entry-media">
																<img class="photo-principale" src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['localite']; ?>" title="<?php echo $data['titre']; ?>" />
	
																<?php if ($venduloue=="") { ?>
																<a href="<?php echo $url_fiche; ?>" class="nectar-love right" title="En savoir plus"> 
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
																	<h3 class="heading wg-title"><?php echo $data['type']; ?> à <?php echo $data['localite'].''.$icone_bien; ?> </h3>
																</div>
															</div>
															<div style="position: relative;" class="content">
																<div class="description">
																	<p><?php echo $data['titre']; 
																		if($data['qpieces']!='' && $data['qpieces']!='0') {
																			echo ' '.$data['qpieces'].' pièces';
																		}
																	?>
																	</p>
																</div>
																
																<div class="zone-pictos">
																	<ul>
																	<?php if (($data['surfhab']!='')&&($data['surfhab']!='0')) { ?>
																		<li><i class="flaticon-home-6"></i> Surface habitable : <?php echo number_format($data['surfhab'], 0, ',', ' '); ?>m<sup>2</sup></li>
																	<?php } ?>
	                                                                <?php if ($data['jardin']=='1') { ?>
																		<li><i class="flaticon-nature-2"></i> Jardin</li>
																	<?php } ?>
																	<?php if ($data['qchambres']!='' && $data['qchambres']!='0') { ?>
																		<li><i class="flaticon-rest"></i> Nbr de chambres : <?php echo $data['qchambres']; ?></li>
																	<?php } ?>
																	<?php if ($data['qgarages']!='' && $data['qgarages']!='0') { ?>
																		<li><i class="flaticon-vehicle"></i> Garage(s) :  <?php echo $data['qgarages']; ?></li>
																	<?php } ?>
																	<?php if ($data['qparking']!='' && $data['qparking']!='0') { ?>
																		<li><i class="flaticon-vehicle"></i> Parking(s) :  <?php echo $data['qparking']; ?></li>
																	<?php } ?>
	                                                                <?php if($data['qsdb']!='' && $data['qsdb']!='0') { ?>
	                                                                    <li><i class="flaticon-bathtub"></i> Salle(s) de bain : <?php echo $data['qsdb']; ?></li>
	                                                                <?php } ?>
																	</ul>
																</div>
															</div>
															
	                                                        <?php if (!$venduloue) { ?>
		                                                        <div class="prix extra-font">
			                                                        <span class="f2">
																	<?php if ($data['cacherprix']!=1){?>
																		<?php echo number_format($data['prix'], 0, ',', ' ').'<sup>€</sup>'; ?>
		                                                            <?php } else {echo "Prix sur demande";} ?>
		                                                            </span>
																</div>
	                                                        <?php } ?>
	                                 
														</div>
													</div>
													<div style="clear: both;"></div>
												</div>
												<div id="action_toogle" class="croix_close"><a  href="javascript: void(0);"><i class="fa fa-times"></i></a></div>
											</div>
										</div>
							
							<?php } ?>
						
						<?php } ?>
						
						<nav aria-label="Page navigation example">
						  <ul class="pagination">
							<?php if ( (isset($_GET['page']))&&($_GET['page']!=1) ) { ?>
						    <li class="page-item">
						      <a class="page-link" href="<?php echo "?page="; echo $_GET['page']-1; ?>" aria-label="Previous">
						        <span aria-hidden="true">&laquo;</span>
						        <span class="sr-only">Précédent</span>
						      </a>
						    </li>
						    <?php } ?>
						    <?php 
							    for ($i = 1 ; $i <= $nombreDePages ; $i++)
								{ ?>
									
									<li class="page-item <?php if($_GET['page']==$i) { echo "active"; } ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?php }
									
						    ?>
						    
						    <?php if ( ((isset($_GET['page'])) || ($nb_biens>$nombreDeBiensParPage)) && ($_GET['page']<$nombreDePages)  ) { ?>
						    <li class="page-item">
						      <a class="page-link" href="<?php echo "?page="; echo $page+1; ?>" aria-label="Next">
						        <span aria-hidden="true">&raquo;</span>
						        <span class="sr-only">Suivant</span>
						      </a>
						    </li>
						    <?php } ?>
						  </ul>
						</nav>

					</div>
					
				</div>
				
			</div>
		</div>
	</div>

</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
	// Apparition de la zone de recherche avancée
$( document ).ready(function() {
   
   
   $('#recherche_avancee').hide();
   	$('#lien_recherche').click(function(){
    	$('#recherche_simple,#recherche_avancee').toggle();
	});
	
	$('.flexdatalist').flexdatalist({
	     minLength: 1
	});

});
</script>
