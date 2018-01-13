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
	
	<div class="section pt-10 pb-10">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-5 col-md-5">
					<div class="mb-4">
						<h3 class="heading wg-title">Jorion & Desmet - Une agence spécialisée</h3>
						<h2 class="sub-heading">
										<span class="f1">Double compétence pour</span> 
										<span class="f2"> 2 experts en immobilier.</span> 
									</h2>
					</div>
					<p class="mb-3">
						<?php 
				        	$req = mysqli_query($link,"SELECT ID, titre, rub, texte FROM ".$table_prefix."_pages WHERE page='page' and rub='edito'");
							$data = mysqli_fetch_assoc($req);
						?>
								
						<?php echo $data['texte']; ?>
												
					</p>
					
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
	

	<!-- Corps de la page
	================================================== 	
	<div class="section pt-12 pb-7">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="mb-2">
						<h3 class="heading wg-title">FEATURES 01</h3>
						<h2 class="extra-font">
							<span class="f2">Supersonic import</span> 
						</h2>
					</div>
					<p>
						No more time wasting in data import. We rocket its speed by improving the progress which strikingly reduces your waiting time.
					</p>
					<div class="entry-footer mb-4">
						<a class="readmore" href="#">Explore &#10230;</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="mb-2">
						<h3 class="heading wg-title">FEATURES 02</h3>
						<h2 class="extra-font">
							<span class="f2">Effortless customize</span> 
						</h2>
					</div>
					<p>
						Never run into trouble when customizing your website. We created Nito with a mindset of ease your process.
					</p>
					<div class="entry-footer mb-4">
						<a class="readmore" href="#">Explore &#10230;</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="mb-2">
						<h3 class="heading wg-title">FEATURES 03</h3>
						<h2 class="extra-font">
							<span class="f2">Powerful shortcodes</span> 
						</h2>
					</div>
					<p>
						There may be some complicated establishing tasks. But no worry as all of those have been solved by Nito’s effective shortcodes system.
					</p>
					<div class="entry-footer mb-4">
						<a class="readmore" href="#">Explore &#10230;</a>
					</div>
				</div>
			</div>
		</div>
	</div>-->
	<div class="section bg-light">
		<div class="container">
			<div class="row">
				<div class="full-left p-0 col-sm-12 col-lg-5 col-md-5 hidden-sm hidden-xs">
					<div class="fullwidth section-bg-9" style="background: url(images/agence.jpg) no-repeat center;"></div>
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
	<div class="section pt-6">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="mb-6">
						<h3 class="heading wg-title">Notre agence</h3>
						<h2 class="sub-heading">
							<span class="f2">Spécialistes </span> 
							<span class="f1">de l'immobilier de prestige</span> 
						</h2>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-6">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container-fluid">
			<div class="row">
				<div class="portfolio-grid masonry-grid-post no-margin">
					<div class="masonry-item col-lg-2 col-md-2 col-sm-6 col-xs-12 creative-strategy">
						<div class="portfolio-grid-item overlay-wrap">
							<div class="entry-media">
								<img src="images/agence6.jpg" alt="" />
							</div>
							<!--<div class="overlay left-right">
								<div class="overlay-inner">
									<div class="entry-header">
										<h3 class="entry-title">
											<a href="portfolio-detail.html">A perfect day in New York</a>
										</h3>
										<ul class="entry-meta extra-font italic">
											<li><a href="#">Creative strategy</a></li>
										</ul>
									</div>
								</div>
								<div class="entry-footer text-right">
									<a class="entry-readmore" href="portfolio-detail.html">Explore</a>
								</div>
							</div>-->
						</div>
					</div>
					<div class="masonry-item col-lg-2 col-md-2 col-sm-6 col-xs-12 art-direction">
						<div class="portfolio-grid-item overlay-wrap">
							<div class="entry-media">
								<img src="images/agence5.jpg" alt="" />
							</div>
							<!--<div class="overlay left-right">
								<div class="overlay-inner">
									<div class="entry-header">
										<h3 class="entry-title">
											<a href="portfolio-detail.html">Giving back to your fans</a>
										</h3>
										<ul class="entry-meta extra-font italic">
											<li><a href="#">Art direction</a></li>
										</ul>
									</div>
								</div>
								<div class="entry-footer text-right">
									<a class="entry-readmore" href="portfolio-detail.html">Explore</a>
								</div>
							</div>-->
						</div>
					</div>
					<div class="masonry-item col-lg-4 col-md-4 col-sm-6 col-xs-12 art-direction">
						<div class="portfolio-grid-item overlay-wrap">
							<div class="entry-media">
								<img src="images/agence1.jpg" alt="" />
							</div>
							<!--<div class="overlay left-right">
								<div class="overlay-inner">
									<div class="entry-header">
										<h3 class="entry-title">
											<a href="portfolio-detail.html">Unifying a brand identity and experience</a>
										</h3>
										<ul class="entry-meta extra-font italic">
											<li><a href="#">Art direction</a></li>
										</ul>
									</div>
								</div>
								<div class="entry-footer text-right">
									<a class="entry-readmore" href="portfolio-detail.html">Explore</a>
								</div>
							</div>-->
						</div>
					</div>
					<div class="masonry-item col-lg-4 col-md-4 col-sm-6 col-xs-12 art-direction">
						<div class="portfolio-grid-item overlay-wrap">
							<div class="entry-media">
								<img src="images/agence2.jpg" alt="" />
							</div>
							<!--<div class="overlay left-right">
								<div class="overlay-inner">
									<div class="entry-header">
										<h3 class="entry-title">
											<a href="portfolio-detail.html">Explore nature</a>
										</h3>
										<ul class="entry-meta extra-font italic">
											<li><a href="#">Art direction</a></li>
										</ul>
									</div>
								</div>
								<div class="entry-footer text-right">
									<a class="entry-readmore" href="portfolio-detail.html">Explore</a>
								</div>
							</div>-->
						</div>
					</div>
					<div class="masonry-item col-lg-4 col-md-4 col-sm-6 col-xs-12 creative-strategy">
						<div class="portfolio-grid-item overlay-wrap">
							<div class="entry-media">
								<img src="images/agence3.jpg" alt="" />
							</div>
							<!--<div class="overlay left-right">
								<div class="overlay-inner">
									<div class="entry-header">
										<h3 class="entry-title">
											<a href="portfolio-detail.html">The end of social media?</a>
										</h3>
										<ul class="entry-meta extra-font italic">
											<li><a href="#">Creative strategy</a></li>
										</ul>
									</div>
								</div>
								<div class="entry-footer text-right">
									<a class="entry-readmore" href="portfolio-detail.html">Explore</a>
								</div>
							</div>-->
						</div>
					</div>
					<div class="masonry-item col-lg-4 col-md-4 col-sm-6 col-xs-12 art-direction">
						<div class="portfolio-grid-item overlay-wrap">
							<div class="entry-media">
								<img src="images/agence4.jpg" alt="" />
							</div>
							<!--<div class="overlay left-right">
								<div class="overlay-inner">
									<div class="entry-header">
										<h3 class="entry-title">
											<a href="portfolio-detail.html">Marrying high-end audio &amp; luxury fashion</a>
										</h3>
										<ul class="entry-meta extra-font italic">
											<li><a href="#">Art direction</a></li>
										</ul>
									</div>
								</div>
								<div class="entry-footer text-right">
									<a class="entry-readmore" href="portfolio-detail.html">Explore</a>
								</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
    <!-- TEMOGNAGES 
    <div class="section section-bg-2 section-fixed pt-11 pb-11">
		<div class="bg-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="testimonial-carousel text-center white">
						<div class="carousel-item">
							<i class="quote-icon circle fa fa-quote-right"></i>
							<div class="description extra-font italic">
								Un service au top, une équipe de professionnels à votre écoute et soucieux de vous fournir un service digne de ce nom !
							</div>
							<div class="author-name white">André Dupont</div>
							<div class="author-position extra-font italic white">Ostéopathe</div>
						</div>
						<div class="carousel-item">
							<i class="quote-icon circle fa fa-quote-right"></i>
							<div class="description extra-font italic">
								Entièrement satisfait de la prestation reçue, je recommande chaudement les services de Jorion Desmet.
							</div>
							<div class="author-name white">John Smith</div>
							<div class="author-position extra-font italic white">Restaurateur</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>-->
				
</div>