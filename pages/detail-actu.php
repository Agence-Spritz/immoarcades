<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $date, $rub, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, dbu, rub, texte, texte2 FROM ".$table_prefix."_pages WHERE page='actu' AND ID='$id' "));		
?>

<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	<div class="section section-bg-generique section-fixed pt-14 pb-3">
		<div class="bg-overlay-dark"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center">
						<h2 class="page-title"><?php echo $titrep; ?></h2>
					
						<div class="breadcrumb">
							<ul class="breadcrumbs">
								<li><a href="<?php echo $defaultpg; ?>.php">Accueil</a></li>
								<li><a href="actualite-immo-hauts-de-france--69--blog" title="Voir toutes les ">blog</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	

	<!-- Corps de la page
	================================================== -->	
	<div class="section pt-8 pb-8">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="blog-list">
						<div class="entry-blog">
							<div class="blog-item bg-white">
								<div class="entry-media">
									
									<?php if (is_file('./images/pages-immobilier-tourcoing-lys-les-lannoy/'.$id.'.jpg')) { ?>
									
										<?php if($texte2p) {?>
											<a href="<?php echo $texte2p; ?>" title="En savoir plus sur cette actualité" target="_blank">
										<?php } ?>
									
										<img src="<?php echo './images/pages-immobilier-tourcoing-lys-les-lannoy/'.$id.'.jpg'; ?>" alt="<?php echo $titrep; ?>" title="<?php echo $titrep; ?>" />
									<?php } else { ?>
										<img src="images/blog/fond-agence.jpg" alt="Actualité Immobilière des Arcades, Tourcoing, Lys-les-Lannoy" />
									<?php } ?>
									
										<?php if($texte2p) {?>
											</a>
										<?php } ?>
									
								</div>
								<div class="entry-content pl-0 pr-0">
									<div class="entry-header">
										<h3 class="entry-title">
											<?php echo $titrep; ?>
										</h3>
									</div>
									<div class="content">
										<?php echo $textep; ?>
									</div>
									<?php if($texte2p) {?>
									<div class="entry-footer">
										
										
										<div class="mb-2">
											<a class="btn autosize btn-primary mb-2" href="<?php echo $texte2p; ?>">En savoir plus</a>
										</div>
										<div class="">
										<p>source : <?php echo $texte2p; ?></p>
										</div>
							
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
</div>