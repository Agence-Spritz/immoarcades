<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
?>


<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	<div class="section section-bg-atouts section-fixed pt-14 pb-3">
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
	
	
	<div class="section pt-8 pb-11">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-5">
					<div class="mb-4">
						<h3 class="heading wg-title">Agence immobilière des Arcades</h3>
						<h2 class="sub-heading">
							<span class="f1">Spécialistes de l'immobilier</span> 
							<span class="f2"> depuis plus de 60 ans</span> 
						</h2>
					</div>
					<p>
						Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus, Luscus quidam curator urbis subito visus: eosque ut heiulans baiolorum praecentor ad expediendum quod orsi sunt incitans vocibus crebris. qui haut longe postea ideo vivus exustus est.
					</p>
				</div>
				<div class="col-sm-6 col-lg-offset-1 col-lg-6">
					<div class="text-left">
						<img src="images/background/fond-histoire-2.jpg" title="Tourcoing 1972" alt="Tourcoing 1972" />
					</div>
					<div class="text-right image-overlay">
						<img src="images/background/tram-actuel.jpg" alt="Centre ville de Tourcoing" title="Centre ville de Tourcoing" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-bg-atouts-2 section-fixed pt-11 pb-3">
		<div class="bg-overlay-dark-total"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="service-item mb-9">
						<i class="fa fa-desktop white"></i>
						<div class="service-content-wrap white">
							<h2 class="service-title white">ATOUT 1</h2>
							<p>
								Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="service-item mb-9">
						<i class="fa fa-star-o white"></i>
						<div class="service-content-wrap white">
							<h2 class="service-title white">ATOUT 2</h2>
							<p>
								Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="service-item mb-9">
						<i class="fa fa-mobile white"></i>
						<div class="service-content-wrap white">
							<h2 class="service-title white">ATOUT 3</h2>
							<p>
								Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="service-item mb-9">
						<i class="fa fa-heart-o white"></i>
						<div class="service-content-wrap white">
							<h2 class="service-title white">ATOUT 4</h2>
							<p>
								Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section pt-11 pb-13 bg-gray">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-5 col-md-5">
					<div class="mb-3">
						<h3 class="heading wg-title">Ce qui fait notre force</h3>
						<h2 class="sub-heading">
							<span class="f1">Expertise</span> 
							<span class="f2"> et notoriété</span> 
						</h2>
					</div>
					<p>
						Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus, Luscus quidam curator urbis subito visus
					</p>
				</div>
				<div class="col-sm-12 col-lg-offset-1 col-lg-6 col-md-offset-1 col-md-6">
					<div class="progress-wraper group-progressbar pt-6">
						<div class="block-progressbar wow fadeInUp">
							<h3 class="progress-title">+ de 150 biens à la vente</h3>
							<div class="progresswrap">
								<div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%" class="progressbar"></div>
							</div>
						</div>
						<div class="block-progressbar wow fadeInUp">
							<h3 class="progress-title">une équipe de 6 personnes à votre service</h3>
							<div class="progresswrap">
								<div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%" class="progressbar"></div>
							</div>
						</div>
						<div class="block-progressbar wow fadeInUp">
							<h3 class="progress-title">des outils de diffusion modernes</h3>
							<div class="progresswrap">
								<div role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%" class="progressbar"></div>
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
						<h3 class="heading wg-title">Notre équipe</h3>
					</div>
				</div>
				<div class="col-md-9">
					<div class="mb-6">
						<h2 class="sub-heading text-right">
							<span class="f1">Nous travaillons</span> 
							<span class="f2"> pour vous</span> 
						</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 p-0">
					<div class="team-carousel" data-auto-play="false" data-desktop="4" data-laptop="4" data-tablet="1" data-mobile="1">
						<div class="team-item">
							<div class="team-media">
									<img src="images/team/team_370x420.jpg" alt="" />
							</div>
							<h5>John Doe</h5>
							<div class="position extra-font italic">Agent immobilier</div>
							<div class="description">
								Incenderat autem audaces usque ad insaniam homines ad haec
							</div>
						</div>
						<div class="team-item">
							<div class="team-media">
									<img src="images/team/team_370x420.jpg" alt="" />
							</div>
							<h5>John Doe</h5>
							<div class="position extra-font italic">Agent immobilier</div>
							<div class="description">
								Incenderat autem audaces usque ad insaniam homines ad haec
							</div>
						</div>
						<div class="team-item">
							<div class="team-media">
									<img src="images/team/team_370x420.jpg" alt="" />
							</div>
							<h5>John Doe</h5>
							<div class="position extra-font italic">Agent immobilier</div>
							<div class="description">
								Incenderat autem audaces usque ad insaniam homines ad haec
							</div>
						</div>
						<div class="team-item">
							<div class="team-media">
									<img src="images/team/team_370x420.jpg" alt="" />
							</div>
							<h5>John Doe</h5>
							<div class="position extra-font italic">Agent immobilier</div>
							<div class="description">
								Incenderat autem audaces usque ad insaniam homines ad haec
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-bg-atouts-3 section-fixed pt-11 pb-11">
		<div class="bg-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="testimonial-carousel text-center white">
						<div class="carousel-item">
							<i class="quote-icon circle fa fa-quote-right"></i>
							<div class="description extra-font italic">
								Great theme! Fast response and excellent technical support. Code is clean and the entire site is so flexible.
							</div>
							<div class="author-name white">Andy Murray</div>
							<div class="author-position extra-font italic white">Project Manager</div>
						</div>
						<div class="carousel-item">
							<i class="quote-icon circle fa fa-quote-right"></i>
							<div class="description extra-font italic">
								I’m completely amazed. I got this theme set up and running in no time. The design quality is amazing.
							</div>
							<div class="author-name white">John Smith</div>
							<div class="author-position extra-font italic white">Project Manager</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>