<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $date, $rub, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, dbu, rub, texte, texte2 FROM ".$table_prefix."_pages WHERE page='actu' AND ID='$id' "));
		
?>

<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	<div class="section section-bg-2 section-fixed pt-6 pb-3">
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
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	

	<!-- Corps de la page
	================================================== -->	
	<div class="section pt-11 pb-9">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="blog-list">
						<div class="entry-blog">
							<div class="blog-item bg-white">
								<div class="entry-media">
									
									<?php if (is_file('./images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$id.'.jpg')) { ?>
									
										<?php if($texte2p) {?>
											<a href="<?php echo $texte2p; ?>" target="_blank">
										<?php } ?>
									
										<img src="<?php echo './images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$id.'.jpg'; ?>" alt="<?php echo $titrep; ?>" title="<?php echo $titrep; ?>" />
									<?php } else { ?>
										<img src="images/blog/blog_1140x590.jpg" alt="Actualité Jorion Desmet" />
									<?php } ?>
									
										<?php if($texte2p) {?>
											</a>
										<?php } ?>
									
									<span class="entry-categories">
										<a href="agence-immobiliere-region-wallone--69--actu-le-saviez-vous" data-filter=".<?php echo slugify($rub); ?>"><?php echo $rub; ?></a>
									</span>
								</div>
								<div class="entry-content pl-0 pr-0">
									<div class="entry-header">
										<h3 class="entry-title">
											<?php echo $titrep; ?>
										</h3>
										<ul class="entry-meta">
											<li><?php echo date_fr($date); ?></li>
										</ul>
									</div>
									<div class="content">
										<?php echo $textep; ?>
									</div>
									<?php if($texte2p) {?>
									<div class="entry-footer">
										<a class="readmore" href="<?php echo $texte2p; ?>" target="_blank">En savoir plus</a>
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