<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
?>


<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	<div class="section section-bg-21 section-fixed pt-14 pb-3">
		<div class="bg-overlay-dark"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center">
						<h2 class="page-title"><?php echo $titrep; ?></h2>
					
						<div class="breadcrumb">
							<ul class="breadcrumbs">
								<li><a href="<?php echo $defaultpg; ?>.php">Accueil</a></li>
								<li><?php echo $titrep; ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<!-- Corps de la page
	================================================== -->	
	<div class="section pt-10 pb-10">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-5 col-md-5">
					<div class="mb-4">
						<h3 class="heading wg-title">Jorion & Desmet - Un service sur mesure</h3>
						<h2 class="sub-heading">
							<span class="f2">Construire</span> 
							<span class="f1"> une relation</span><br />
							<span class="f2"> de confiance</span>
						</h2>
					</div>
					<p class="mb-3">
						Dans la vente de votre bien immobilier, nous vous accompagnons en tant que véritable partenaire, experts de notre métier, et sommes là pour vous conseiller, vous guider, en toute confiance et transparence.
						
					</p>
					<ul class="bullet-list mb-5">
						<li>Nous sommes humains, proches de vous</li>
						<li>Respectueux de vos interêts, de vos idées</li>
						<li>Efficaces dans notre métier</li>
					</ul>
				</div>
				<div class="col-sm-12 col-lg-7 col-md-7">
					<?php if (is_file('./images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$id.'.jpg')) { ?>
						<img src="<?php echo './images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$id.'.jpg'; ?>" alt="<?php echo $titrep; ?>" title="<?php echo $titrep; ?>" />
					<?php } else { ?>
						<img src="images/image_659x402.jpg" alt="Jorion Desmet" />
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="section bg-light">
		<div class="container">
			<div class="row">
				<div class="full-left p-0 col-sm-12 col-lg-5 col-md-5 hidden-sm hidden-xs">
					<div class="fullwidth section-bg-9" style="background: url(images/vendre.jpg) no-repeat center;"></div>
				</div>
				<div class="col-sm-12 col-lg-offset-6 col-lg-6 col-md-offset-5 col-md-7 pt-5">
					<div class="col-sm-6">
						<div class="service-item mb-5">
							<i class="fa fa-desktop dark fullwidth"></i>
							<div class="service-content-wrap pl-0">
								<h2 class="service-title">VISIBILITE ABSOLUE</h2>
								<p>
									En tant qu’agence hyper spécialisée, l’ensemble de notre communication et de nos démarches tendent vers un unique flux spécialisé adapté à votre bien.
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="service-item mb-5">
							<i class="fa fa-star-o dark fullwidth"></i>
							<div class="service-content-wrap pl-0">
								<h2 class="service-title">LA QUALITE GARANTIE</h2>
								<p>
									Plus de <?=date("Y")-2007?> ans d’expérience dans la vente immobilière, de quoi vous garantir un travail de pro et une qualité de prestation en adéquation avec nos biens.
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="service-item mb-5">
							<i class="fa fa-mobile dark fullwidth"></i>
							<div class="service-content-wrap pl-0">
								<h2 class="service-title">REACTIF & DISPONIBLE</h2>
								<p>
									Nous exploitons l’ensemble des technologies pour servir nos clients, mais à ce jour, rien ne remplace le contact humain pour gérer vos affaires. Restons en contact !
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="service-item mb-5">
							<i class="fa fa-heart-o dark fullwidth"></i>
							<div class="service-content-wrap pl-0">
								<h2 class="service-title">UNE VRAIE RELATION</h2>
								<p>
									Nos clients se distinguent par un trait commun : «L’exigence». La discrétion, le dévouement et les résultats créent un bon climat de confiance, pour une relation durable.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section pt-10 pb-10">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="mb-6">
						<h3 class="heading wg-title">Process de vente</h3>
					</div>
				</div>
				<div class="col-md-9">
					<div class="mb-6">
						<h2 class="sub-heading text-right">
							<span class="f1">Etapes d'une mise en vente</span> 
						</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 p-0">
					<div class="team-carousel" data-auto-play="true" data-desktop="4" data-laptop="4" data-tablet="2" data-mobile="1">
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape1.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Rencontre</a></h5>
							<div class="position extra-font italic">Vos souhaits</div>
							<div class="description">
								Définition de vos souhaits et mise en valeur de votre bien.
							</div>
						</div>
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape2.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Mise en vente</a></h5>
							<div class="position extra-font italic">Photos, Vidéos, Pubs</div>
							<div class="description">
								Préparation des différents médias de diffusion et de publicité.
							</div>
						</div>
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape3.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Suivi de la vente</a></h5>
							<div class="position extra-font italic">Analyse et compte rendu</div>
							<div class="description">
								Parce qu'il est indispensable que nos clients soient tenus informés.
							</div>
						</div>
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape4.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">C'est vendu</a></h5>
							<div class="position extra-font italic">Rédaction des contrats</div>
							<div class="description">
								Prise en charge totale jusqu’à la conclusion de la vente. 
							</div>
						</div>
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape5.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Cheers</a></h5>
							<div class="position extra-font italic">.Santé ! </div>
							<div class="description">
								Il est temps de sceller notre collaboration.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
</div>