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
						<form class="searchform" method="POST" action="bien-immobiliers-tourcoing--67--resultat">
							<input type="text" class="s" name="recherche_generale" value="" placeholder="Mot clé, ville, code postal, réf...">
							<button type="submit" value="Rechercher" name="submit" class="searchsubmit"><i class="flaticon-construction-12"></i> Chercher</button>
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
						
						<?php 
				        	$req = mysqli_query($link,"SELECT ID, titre, rub, texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' and rub='edito'");
							$data = mysqli_fetch_assoc($req);
						?>
						<div class="mb-4">
							<h4 class="heading wg-title"><?php echo $data['texte2']; ?></h4>
						</div>
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
							<img class="mb-3" style="max-width: 500px;" src="<?php echo './images/carte.png'; ?>" usemap="#Map" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
							
								<map name="Map" id="Map">
								    <area alt="" title="" href="maisons-tourcoing-et-environ--178--resultat" shape="poly" coords="168,2,115,75,95,73,53,47,4,73,52,179,103,204,141,251,141,289,87,321,214,376,249,333,282,307,332,295,364,259,348,228,355,208,328,170,296,126,252,44,245,22" />
								    <area alt="" title="" href="maisons-lys-lez-lannoy--179--resultat" shape="poly" coords="368,260,335,297,284,310,251,334,215,378,171,417,173,469,200,475,214,496,265,511,288,499,378,546,452,531,466,506,448,440,497,408,476,358,487,353,487,323,455,288,365,260" />
								   
								</map>

							<a class="btn btn-alt-white btn-border" href="biens-immobiliers-nord-tourcoing--67--resultat">
								Toutes les villes&nbsp;&nbsp;<i class="btn-icon typcn typcn-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php if($_COOKIE['immo-selection']) { 
			
			echo $_COOKIE['immo-selection'];
		
			// On créé la liste des ID contenus dans le cookie
			$list_cookie = explode('-', $_COOKIE['immo-selection']);
			
			//On transforme l'array en string
			$ids = implode(',', $list_cookie);
			
			// On supprime le dernier séparateur
			$ids = rtrim($ids, ",");
		?>
		
		<!--  Ma sélection-->
			<div class="section liste-biens pt-5 pb-2">
				<div class="container">
					<div class="row">
						
						<div class="mb-5">
							<h2 class="sub-heading text-center text-surligne">
								<span class="f2">Ma sélection</span>
							</h2>
						</div>
						
						<?php $req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE ID IN ($ids) ORDER BY dmod DESC LIMIT 0,6");
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
							<a href="<?php echo $data['type']; ?>-nord-tourcoing-<?php echo $data['localite']; ?>--<?php echo $data['ID']; ?>--fiche">
								<div style="position: relative;" class="visuel-bien mt-2 mb-3">
									<img src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
									<?php if ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
									<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
									<?php } ?>
									<div class="label"><a href="javascript: void(0)" title="Belle opportunité"><i class="flaticon-construction"></i></a></div>
								</div>
							</a>
						</div>
						
						<?php } ?>
					</div>
				</div>
			</div>

		
		<?php } else { ?>

		<!--  Biens à la une première ligne-->
			<div class="section liste-biens pt-5 pb-2">
				<div class="container">
					<div class="row">
						
						<div class="mb-5">
							<h2 class="sub-heading text-center text-surligne">
								<span class="f2">Belles opportunités</span>
							</h2>
						</div>
						
						<?php $req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE cat='V' AND nouveaute IS NOT NULL ORDER BY dmod DESC LIMIT 0,3"); 
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
							<a href="<?php echo $data['type']; ?>-nord-tourcoing-<?php echo $data['localite']; ?>--<?php echo $data['ID']; ?>--fiche">
								<div style="position: relative;" class="visuel-bien mt-2 mb-3">
									<img src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
									<?php if ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
									<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
									<?php } ?>
									<div class="label"><a href="javascript: void(0)" title="Belle opportunité"><i class="flaticon-construction"></i></a></div>
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
						
						<?php $req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE cat='V' AND nouveaute IS NOT NULL ORDER BY dmod DESC LIMIT 3,3"); 
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
							<a href="<?php echo $data['type']; ?>-nord-tourcoing-<?php echo $data['localite']; ?>--<?php echo $data['ID']; ?>--fiche">
								<div style="position: relative;" class="visuel-bien mt-2 mb-3">
									<img src="<?php echo $data['PHOTO_01']; ?>" alt="<?php echo $data['titre']; ?>" title="<?php echo $data['titre']; ?>" />
									<?php if ($venduloue=="Vendu" || $venduloue=="Loué") { //Lou&eacute;?>
									<div class="banniere-venduloue" ><?php echo $venduloue; ?></div>
									<?php } ?>
									<div class="label"><a href="javascript: void(0)" title="Belle opportunité"><i class="flaticon-construction"></i></a></div>
								</div>
							</a>
						</div>
						
						<?php } ?>
					</div>
				</div>
			</div> 
		<?php } ?>      				
				
	</div>