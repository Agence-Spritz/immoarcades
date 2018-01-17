	<div id="main">
		<div class="section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 p-0">
						<div id="rev_slider_4" class="rev_slider fullscreenbanner">
							<ul>
								<?php $req = mysqli_query($link,"SELECT ID, titre, rub, texte, texte2 FROM ".$table_prefix."_pages WHERE page='diapo' AND masquer <> '1'  ORDER BY dbu DESC"); $n=0;
								  	while ($data = mysqli_fetch_array($req)) { 
									$n++;
								?>
									<!-- SLIDE  -->
									<li data-transition="boxslide" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-rotate="0" data-saveperformance="off" data-title="Slide">
	
										<img src="images/slider/<?php echo $data['ID']; ?>.jpg" alt="<?php echo $data['titre']; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="bg-darker rev-slidebg" />
	
										<!-- LAYER NR. 1 -->
										<div class="tp-caption Lato-60Blanc"
											 data-x="center" data-hoffset="" data-y="100"
											 
											 data-transform_idle="o:1;"
											 
											 data-start="740" data-splitin="none" data-splitout="none"
											 data-responsive_offset="on">
                                             <?=$data['texte2']?>
                                             
										</div>
									</li>
								  						        
						        <?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--  Section recherche -->
		<div class="section section pt-2 pb-2">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-6">
						<form class="searchform" method="POST" action="bien-immobiliers-tourcoing--T--resultat">
							<input type="text" class="s" name="recherche_generale" value="" placeholder="Mot clé, ville, code postal, réf...">
							<button type="submit" value="Rechercher" name="submit" class="searchsubmit"><i class="flaticon-construction"></i> Chercher</button>
						</form>
					</div>
					<div class="col-md-3">
					</div>
				</div>
			</div>
		</div>
		
		<!-- Edito-->
		<div class="section pt-8 pb-8 bg-darker edito">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-lg-5">
						<div class="mb-4">
							<h4 class="heading wg-title">Immobilière des arcades</h4>
						</div>
						<?php 
				        	$req = mysqli_query($link,"SELECT ID, titre, rub, texte FROM ".$table_prefix."_pages WHERE page='page' and rub='edito'");
							$data = mysqli_fetch_assoc($req);
						?>
						<h2 class="sub-heading mb-2">
							<span class="f1"><?php echo $data['titre']; ?></span>
						</h2>
							
						<p>
							<?php echo $data['texte']; ?>
						</p>
						<div class="text-right mt-3 mb-3">
							<a class="btn btn-alt-white btn-border" href="agence-immobiliere-tourcoing--68--nos-atouts">
								Nos atouts&nbsp;&nbsp;<i class="btn-icon typcn typcn-arrow-right"></i>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-lg-offset-1 col-lg-6 images-edito">
						<div class="text-center">
							<img src="<?php echo './images/carte.png'; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--  Biens à la une première ligne-->
			<div class="section liste-biens pt-5 pb-2">
				<div class="container">
					<div class="row">
						
						<div class="mb-5">
							<h2 class="sub-heading text-center text-surligne">
								<span class="f2">Belles opportunités</span>
							</h2>
						</div>
						
						<?php $req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE cat='V' ORDER BY dmod DESC LIMIT 0,3"); 
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
									<? if ($data['peb']>0){?><img src="img-PEB/img/peb_<?=peblettre($data['peb'])?>.png" style="width:68px" /><?php } ?>
								</p>
							</div>
							<a href="<?php echo $data['type']; ?>-nord-tourcoing-<?php echo $data['localite']; ?>--<?php echo $data['ID']; ?>--fiche">
								<div style="position: relative;" class="mt-2 mb-3">
									<img src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
									<?php if ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
									<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
									<?php } ?>
									<div class="label"><i class="flaticon-construction-4"></i></div>
								</div>
							</a>
						</div>
						
						<?php } ?>
					</div>
				</div>
			</div>
                
        <!--  Biens à la une seconde ligne-->
			<div class="section liste-biens pt-7 pb-2 bg-gray">
				<div class="container">
					<div class="row">
						
						<?php $req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE cat='V' ORDER BY dmod DESC LIMIT 3,3"); 
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
									<? if ($data['peb']>0){?><img src="img-PEB/img/peb_<?=peblettre($data['peb'])?>.png" style="width:68px" /><?php } ?>
								</p>
							</div>
							<a href="<?php echo $data['type']; ?>-nord-tourcoing-<?php echo $data['localite']; ?>--<?php echo $data['ID']; ?>--fiche">
								<div style="position: relative;" class="mt-2 mb-3">
									<img src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
									<?php if ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
									<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
									<?php } ?>
									<div class="label"><i class="flaticon-construction-4"></i></div>
								</div>
							</a>
						</div>
						
						<?php } ?>
					</div>
				</div>
			</div>       				
				
	</div>