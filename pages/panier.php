<?php // Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre,texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
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

	<!-- Liste des biens
	================================================== -->	
	
	<!--  Ma sélection-->
			<div class="section liste-biens pt-5 pb-2">
				<div class="container">
					<div class="row">
						
						<div class="mb-5">
							<h2 class="sub-heading text-center text-surligne">
								<span class="f2">Ma sélection</span>
							</h2>
						</div>
						
						<?php if($_COOKIE['immo-selection']) { 
							// On créé la liste des ID contenus dans le cookie
							$list_cookie = explode('-', $_COOKIE['immo-selection']);
							
							//On transforme l'array en string
							$ids = implode(',', $list_cookie);
							
							// On supprime le dernier séparateur
							$ids = rtrim($ids, ",");
						?>
		
						
							<?php $req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE id IN ($ids) ORDER BY dmod DESC LIMIT 0,6"); 
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
								<div class="mt-2 mb-3">
									<a href="<?php echo $data['type']; ?>-nord-tourcoing-<?php echo $data['localite']; ?>--<?php echo $data['ID']; ?>--fiche">
										<div style="position: relative;" class="visuel-bien ">
											<img src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
											<?php if ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
											<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
											<?php } ?>
											<div class="label"><a href="javascript: void(0)" title="Belle opportunité"><i class="flaticon-construction"></i></a></div>
										</div>
									</a>
									<?php
								
								// Compteur de MaSelection 
								$xpldSelection=explode("-",$_COOKIE['immo-selection']);
								$NbrSelection=count($xpldSelection)-1;
								
									$msgSelection='<i class="fa fa-close" style="color: #fe0000;"></i> Supprimer de ma liste de sélections';
									$selectID="NO";
								
								?>
								<a href="javascript: void(0);" id="<?php echo $data['ID']; ?>" onClick="DelMaselection(this.id);"><div class="DelMaselection"><i class="fa fa-close" style="color:#fe0000"></i> Supprimer de ma sélection</div></a>
								
								</div>
							</div>
							
							<?php } ?>
							
						<?php } else {
								echo '<div class="col-md-12 mb-4">
									<div class="alert alert-warning" role="alert">
									  Votre sélection ne comporte aucun bien actuellement !
									</div>
								</div>';
							}
						?>
					</div>
				</div>
			</div>

</div>
<!-- BOUTON COMPARER --> 
<script>
	
	function DelMaselection(id)
            {
                $.post('./panier-biens/inc/MaSelectionCookie.php',{addselection:'<i class="flaticon-shopping-cart"></i> Ajouter à ma liste de sélections', selectID:'NO-'+id, NbrSelection:<?=$NbrSelection?>},
				function(){
					$('.DelMaselection').html(''),
					window.location.reload()
				});
            }
  
</script>