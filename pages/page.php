<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
?>


<div id="main">
	
	<!-- Page en-tête
	================================================== -->
	
	
	<div class="section section-bg-1 section-fixed pt-6 pb-3">
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
	<div class="section pt-10 pb-10">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-5 col-md-5">
					<div class="mb-4">
						<h3 class="heading wg-title"><?php echo $texte2p; ?></h3>
						<!--<h2 class="sub-heading">
							<span class="f2">2 experts</span> 
							<span class="f1"> en immobilier</span><br />
							<span class="f2"> pour vous accompagner</span>
						</h2>-->
					</div>
					
				</div>
				<?php if (is_file('./images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$id.'.jpg')) { ?>
                <div class="col-sm-12 col-lg-7 col-md-7">
						<img src="<?php echo './images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$id.'.jpg'; ?>" alt="<?php echo $titrep; ?>" title="<?php echo $titrep; ?>" />
				</div>
				<?php }?>
				
				<p class="mb-3 pt-3 pb-3">
						<?php echo $textep; ?>
				</p>
					
					
			</div>
		</div>
	</div>
	
</div>