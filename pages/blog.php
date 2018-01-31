<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre,texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
?>


<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	<div class="section section-bg-blog section-fixed pt-14 pb-3">
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
				
	<div class="section pt-9 pb-9">
		<div class="container">
			<div class="row">
				<div class="portfolio-grid masonry-grid-post">
					
					<?php $req = mysqli_query($link,"SELECT ID, titre, dbu, rub, texte FROM ".$table_prefix."_pages WHERE page='actu' AND masquer <> '1'  ORDER BY dbu DESC"); 
					  	while ($data = mysqli_fetch_array($req)) { 
						  	
						  	$date = date_fr($data['dbu']);
					?>
					
					<div class="masonry-item col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php echo slugify($data['rub']); ?>">
						<div class="portfolio-grid-item overlay-wrap">
							<div class="entry-media">
								<?php if (is_file('./images/pages-immobilier-tourcoing-lys-les-lannoy/'.$data['ID'].'.jpg')) { ?>
									<img src="<?php echo './images/pages-immobilier-tourcoing-lys-les-lannoy/'.$data['ID'].'.jpg'; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
								<?php } else { ?>
									<img src="images/blog/fond-agence.jpg" alt="Actualité Immobilière des Arcades, Tourcoing, Lys-les-Lannoy" title="Actualité Immobilière des Arcades, Tourcoing, Lys-les-Lannoy" />
								<?php } ?>
					
								
							</div>
							<div class="overlay left-right">
								<div class="overlay-inner">
									<div class="entry-header">
										<h3 class="entry-title">
											<a href="<?php echo slugify($data['titre']); ?>--agence-immobiliere-tourcoing-lys-les-lannoy--<?php echo $data['ID'] ?>--detail-actu"><?php echo $data['titre']; ?></a>
										</h3>
										<ul class="entry-meta extra-font italic">
											<li><?php echo $data['rub']; ?></li>
										</ul>
									</div>
								</div>
								<div class="entry-footer text-right">
									<a class="entry-readmore" href="<?php echo slugify($data['titre']); ?>--agence-immobiliere-tourcoing-lys-les-lannoy--<?php echo $data['ID'] ?>--detail-actu">En savoir plus</a>
								</div>
							</div>
						</div>
					</div>

					
					<?php } ?>
					
					
				</div>
				
			</div>
		</div>
	</div>
	
</div>