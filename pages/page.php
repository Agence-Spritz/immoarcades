<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
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
	<div class="section pt-8 pb-8">
		<div class="container">
			<div class="row">
				
				<?php if (is_file('./images/pages-immobilier-tourcoing-lys-les-lannoy/'.$id.'.jpg')) { ?>
					<div class="col-sm-12 col-lg-5 col-md-5">
				<?php } else { ?>
					<div class="col-sm-12 col-lg-12 col-md-12">	
				<?php } ?>
						<div class="mb-4">
							<?php if ($texte2p) { ?>
								<h3 class="heading wg-title"><?php echo $texte2p; ?></h3>
							<?php } ?>
							
							<p><?php echo $textep; ?></p>
						</div>
					
					</div>
				
				<?php if (is_file('./images/pages-immobilier-tourcoing-lys-les-lannoy/'.$id.'.jpg')) { ?>
					<div class="col-sm-12 col-lg-7 col-md-7">
						<img src="<?php echo './images/pages-immobilier-tourcoing-lys-les-lannoy/'.$id.'.jpg'; ?>" alt="<?php echo $titrep; ?>" title="<?php echo $titrep; ?>" />
					</div>
				<?php } ?>
				<div style="clear: both;"></div>
					
			</div>
		</div>
	</div>

</div>