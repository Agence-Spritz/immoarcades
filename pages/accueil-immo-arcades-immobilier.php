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
										<div class="tp-caption <?php if ($data['rub']=='clair') { echo 'Lato-40Noir'; } else { echo 'Lato-60Blanc'; } ?>"
											 data-x="center" data-hoffset="" data-y="200"
											 data-width="['600']" data-height="['auto']"
											 data-transform_idle="o:1;"
											 data-transform_in="x:{-250,250};opacity:0;s:1000;e:Power2.easeInOut;" 
											 data-transform_out="sX:0;sY:0;opacity:0;s:400;"
											 data-start="740" data-splitin="none" data-splitout="none"
											 data-responsive_offset="on" data-end="8930">
                                             <?=$data['titre']?>
                                             
											<?php if ($data['texte2']) { ?>
                                             	<br /><br /><a href='<?=$data['texte2']?>'><div class='Button-White'>EN SAVOIR +</div></a>
                                             <?php } ?>
										</div>
										
										<?php if ($data['texte']) { ?> 
											<!-- LAYER NR. 2 -->
											<div class="tp-caption Lato-50Bleu"
												 data-x="center" data-hoffset="" data-y="500"
												 data-width="['600']" data-height="['auto']"
												 data-transform_idle="o:1;"
												 data-transform_in="y:{-400,150};opacity:0;s:2000;e:Power2.easeInOut;" 
												 data-transform_out="y:{-150,150};sX:0;sY:0;opacity:0;s:400;"
												 data-start="740" data-splitin="none" data-splitout="none"
												 data-responsive_offset="on" data-end="8930"><?php echo $data['texte']; ?> 
											</div>
										<?php } ?> 
	
										
									</li>
								  	
															        
						        <?php } ?>
        	
        	
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--  Biens à la une -->		
				
				<div class="section pt-12 pb-11 bg-gray">
					<div class="container">
						<div class="row">
							
							<?php $req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE cat='V' ORDER BY dmod DESC LIMIT 0,6"); $n=0; 
							  	while ($data = mysqli_fetch_array($req)) { 
									$n++; $venduloue = $data['venduloue'];
								  	
							?>
							
							<div class="col-sm-4 entry-media" style="<?php if ($n==4){ echo 'clear:both';} ?>">
								<div class="mb-2">
									<h3 class="heading wg-title"><?php echo $data['localite']; ?></h3>
									<h2 class="extra-font">
										<a href="bien-de-prestige-tournai-mouscron--<?php echo $data['ID']; ?>--fiche"><span class="f2"><?php echo $data['type']; ?></span> </a>
									</h2>
								</div>
								<div class="zone-titre-liste">
									<p>
										<?php echo $data['titre']; ?><br />
										<? if ($data['peb']>0){?><img src="img-PEB/img/peb_<?=peblettre($data['peb'])?>.png" style="width:68px" /><?php } ?>
									</p>
								</div>
								<div style="position: relative;" class="mt-2 mb-3">
									<img src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
									
									<?php if ($venduloue=="") { ?>
									<a href="<?php echo urlencode($data['typesimple']); ?>-<?php echo urlencode($data['localite']); ?>--<?php echo $data['ID']; ?>--fiche" class="nectar-love right"> 
										<i class="fa fa-plus"></i>
									</a>
									<?php } elseif ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
									<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
									<?php } else { ?>
									<div class="banniere-venduloue" style="background-color:RGBA(47,54,63,0.8)"><?php echo $venduloue; ?></div>
									<?php } ?>
								</div>
								
							</div>
							
							<?php } ?>
						</div>
					</div>
				</div>
                
                <!-- Edito-->
				<div class="section pt-8 pb-8">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-lg-5">
								<div class="mb-4">
									<h3 class="heading wg-title">EDITO</h3>
									<h2 class="sub-heading">
										<span class="f1">Double compétence pour</span> 
										<span class="f2"> 2 experts en immobilier.</span> 
									</h2>
								</div>
								<?php 
						        	$req = mysqli_query($link,"SELECT ID, titre, rub, texte FROM ".$table_prefix."_pages WHERE page='page' and rub='edito'");
									$data = mysqli_fetch_assoc($req);
								?>
								<p>
									<?php echo $data['texte']; ?>
								</p>
								<div class="text-right mt-3 mb-3">
									<a class="btn btn-alt btn-border" href="agence-immobiliere-tournai--68--page-agence-jd">
										A propos&nbsp;&nbsp;<i class="btn-icon typcn typcn-arrow-right"></i>
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-lg-offset-1 col-lg-6 images-edito">
								
								<div class="text-left">
									<h2>Projets neufs</h2>
									<?php if (is_file('./images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$data['ID'].'.jpg')) { ?>
										<img src="<?php echo './images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$data['ID'].'.jpg'; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
									<?php } else { ?>
										<img src="images/image_400x250.jpg" alt="Jorion Desmet" />
									<?php } ?>
								</div>
								<div class="text-right image-overlay">
									<?php if (is_file('./images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$data['ID'].'-1.jpg')) { ?>
										<img src="<?php echo './images/pages-immobilier-prestige-neufs-tournai-mouscron-mons/'.$data['ID'].'-1.jpg'; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
									<?php } else { ?>
										<img src="images/image_400x250.jpg" alt="Jorion Desmet" />
									<?php } ?>
									<h2>Biens de prestige</h2>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="section pt-10 pb-7">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-lg-3 col-md-3">
								<div class="service-item mb-9">
									<i class="fa fa-desktop dark fullwidth"></i>
									<div class="service-content-wrap pl-0">
										<h2 class="service-title">VISIBILITE ABSOLUE</h2>
										<p>
											En tant qu’agence hyper spécialisée, l’ensemble de notre communication et de nos démarches tendent vers un unique flux spécialisé adapté à votre bien.
										</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3 col-md-3">
								<div class="service-item mb-9">
									<i class="fa fa-star-o dark fullwidth"></i>
									<div class="service-content-wrap pl-0">
										<h2 class="service-title">LA QUALITE GARANTIE</h2>
										<p>
											Plus de <?=date("Y")-2007?> ans d’expérience dans la vente immobilière, de quoi vous garantir un travail de pro et une qualité de prestation en adéquation avec nos biens.
										</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3 col-md-3">
								<div class="service-item mb-9">
									<i class="fa fa-mobile dark fullwidth"></i>
									<div class="service-content-wrap pl-0">
										<h2 class="service-title">REACTIF & DISPONIBLE</h2>
										<p>
											Nous exploitons l’ensemble des technologies pour servir nos clients, mais à ce jour, rien ne remplace le contact humain pour gérer vos affaires. Restons en contact !
										</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3 col-md-3">
								<div class="service-item mb-9">
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