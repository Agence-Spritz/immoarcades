<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre,texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
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
							<?php if ($texte2p) { echo $texte2p; } ?>
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
				<div class="text-center mb-2">
					<ul class="masonry-filter extra-font">
						<li><a href="#" data-filter="" class="active">Toutes les actus</a></li>
						<?php $req = mysqli_query($link,"SELECT rub FROM ".$table_prefix."_pages WHERE page='actu' GROUP BY rub ORDER BY rub"); 
						  	while ($data = mysqli_fetch_array($req)) { 
							  	
						?>
						
						<li><a href="#" data-filter=".<?php echo slugify($data['rub']); ?>"><?php echo $data['rub']; ?></a></li>
						
						<?php } ?>
					
					</ul>
				</div>
				<div class="portfolio-grid masonry-grid-post">
					
					<?php $req = mysqli_query($link,"SELECT ID, titre, dbu, rub, texte FROM ".$table_prefix."_pages WHERE page='actu' AND masquer <> '1'  ORDER BY dbu DESC"); 
					  	while ($data = mysqli_fetch_array($req)) { 
						  	
						  	$date = date_fr($data['dbu']);
						  	
					?>
					
					<div class="masonry-item col-lg-4 col-md-4 col-sm-6 col-xs-12 <?php echo slugify($data['rub']); ?>">
						<div class="portfolio-grid-item overlay-wrap">
							<div class="entry-media">
								<?php if (is_file('./images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$data['ID'].'.jpg')) { ?>
									<img src="<?php echo './images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$data['ID'].'.jpg'; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
								<?php } else { ?>
									<img src="images/projects/project_442x442.jpg" alt="Actualité Jorion Desmet" />
								<?php } ?>
					
								
							</div>
							<div class="overlay left-right">
								<div class="overlay-inner">
									<div class="entry-header">
										<h3 class="entry-title">
											<a href="<?php echo slugify($data['titre']); ?>--constructions-neuves-tournai-mons-mouscron--<?php echo $data['ID'] ?>--detail-actu"><?php echo $data['titre']; ?></a>
										</h3>
										<ul class="entry-meta extra-font italic">
											<li><?php echo $data['rub']; ?></li>
										</ul>
									</div>
								</div>
								<div class="entry-footer text-right">
									<a class="entry-readmore" href="<?php echo slugify($data['titre']); ?>--constructions-neuves-tournai-mons-mouscron--<?php echo $data['ID'] ?>--detail-actu">En savoir plus</a>
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