<?php // On démarre la session AVANT d'écrire du code HTML
session_start(); ?>
<!doctype html>

<!-- Header
================================================== --> 
<html lang="fr-FR">
	<head>
		
		<!-- Ajouts liés à l'admin Remixweb -->	
	
		<!-- GOOGLE ANALYTICS -->
		<?	list($script_google, $nom_titre_meta, $url_site, $coordonnees) = mysqli_fetch_array(mysqli_query($link, "SELECT google_stats,nom_titre_meta,url_site,coordonnees FROM ".$table_prefix."_divers WHERE ID=1 "));
	        echo ("$script_google"); 
	    ?>
	    <?php include ("inc/meta.php"); ?>
	    <?php 
		setlocale(LC_TIME, 'fr','fr_FR','fr_FR@euro','fr_FR.utf8','fr-FR','fra');
		?>
    
    
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<link rel="shortcut icon" href="images/favicon.ico"/>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/pe-icon-7-stroke.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/typicons.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/settings.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="css/owl.theme.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="css/custom.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="fonts/collection-generale/font/flaticon.css" type="text/css" media="all" />
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i%7CPlayfair+Display:400,400i,700,700i,900,900i" />
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<link href="script-prix/css/ion.rangeSlider.css" rel="stylesheet" type="text/css">
		<link href="script-prix/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
		<!--<div class="noo-spinner">
			<div class="spinner">
				<div class="child double-bounce1"></div>
				<div class="child double-bounce2"></div>
			</div>
		</div>-->
		<div class="site">
			<header id="header" class="header header-default header-not-mobile-default">
				<div class="no-container clearfix">
					<div id="header-logo" class="pull-left">
						<a href="./">
							<img class="main-logo" alt="" src="images/logo.png" />
						</a>
					</div>
					<div class="nav-extra pull-right">
						<div class="header-popup clearfix">
							<div class="nav-extra-icon">
								<a href="#" class="header-icon">
									<i class="flaticon-shopping-cart"></i>
								</a>
								<a href="#" class="header-icon">
									<i class="flaticon-technology-2"></i>
								</a>
								<a href="javascript:void(0)" id="menu-mobile" class="header-icon menu-mobile">
									<i class="pe-7s-menu" title="Open Menu"></i>
								</a>
							</div>
						</div>
					</div>
					<nav class="navigation pull-right">
						<a class="mobile-close"><i class="pe-7s-close-circle" title="Close Menu"></i></a>
						<div class="main-navigation">
							<ul>
								<li class="<?php if ($pg==$defaultpg) { echo 'active'; } else { echo ''; } ?>">
									<a href="<?php echo $defaultpg; ?>.php" title="Accueil" class="header-icon" >
										<i style="font-size: 22px; position: relative; top: 4px;" class="flaticon-buildings-1"></i>
									</a>
								</li>
								
								<li class="<?php if ($id=="T") { echo 'active'; } else { echo ''; } ?>">
									<a href="biens-immobiliers-nord-tourcoing--T--resultat">Acheter</a>
									<ul class="sub-menu">
										<li class="<?php if (($id=="T") && ($_GET['agence']=="tourcoing")) { echo 'active'; } else { echo ''; } ?>">
											<a href="maisons-tourcoing-lys-lez-lannoy--T--resultat?agence=tourcoing">Agence Tourcoing</a>
										</li>
										<li class="<?php if (($id=="T") && ($_GET['agence']=="lys-lez-lannoy")) { echo 'active'; } else { echo ''; } ?>">
											<a href="maisons-tourcoing-lys-lez-lannoy--T--resultat?agence=lys-lez-lannoy">Agence Lys-lez-Lannoy</a>
										</li>
									</ul>
									<span class="menu-toggle">
										<i class="fa fa-angle-right"></i>
									</span>
								</li>
								
								<li class="<?php if ($id==66) { echo 'active'; } else { echo ''; } ?>">
									<a href="vendre-bien-immobilier-tourcoing--66--page-vendre">Vendre</a>
								</li>
								
								<li class="<?php if ($id==68) { echo 'active'; } else { echo ''; } ?>">
									<a href="agence-immobiliere-tourcoing--68--nos-atouts">Nos atouts</a>
								</li>
								<li class="<?php if ($id==69) { echo 'active'; } else { echo ''; } ?>">
									<a href="actualite-immo-hauts-de-france--69--blog">Blog</a>
								</li>
								<li class="<?php if ($id==171) { echo 'active'; } else { echo ''; } ?>">
									<a href="insciption-alerte--171--alertemail">Restez en alerte!</a>
								</li>
								<li class="<?php if ($id==73) { echo 'active'; } else { echo ''; } ?>">
									<a href="contacter-agence-immo--73--contact">Contact</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</header>
   
  <!-- Contenu principal
	================================================== -->
   <div> <?php include ("pages/".$pg.".php"); ?></div>

<!-- Footer
================================================== -->  
<footer class="footer">
				<div class="footer-top">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-1">
								
								<div class="widget text-center">
									<p>
										L’agence immobilière immobilière des Arcades est affiliée au SNPI, premier syndicat français de l’Immobilier.
                                    </p>
                                    <img style="margin-top: 25px;" alt="Logo SNPI" src="images/logo-snpi.png" />
								</div>
								
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-2">
								<div class="widget">
									<h6 class="wg-title">Infos & horaires</h6>
									<ul class="contact-info">
										
											<li>
											<a href="https://www.google.fr/maps/place/Immobilière+des+Arcades/@50.7198621,3.1596517,17z/data=!3m1!4b1!4m5!3m4!1s0x47c32f2b4af46d21:0x822e1f6608d51c24!8m2!3d50.7198621!4d3.1618404" title="Voir le plan" target="_blank">
												7, avenue Gustave Dron<br />
												59200 Tourcoing<br />
											</a>
										
										<a href="callto:+33320250567">T 03 20 25 05 67</a>
										</li>
										<li>
											<span style="color: #fff;">Du lundi au vendredi</span>
											<p>9h-12h / 14h-19</p>
										</li>
										<li>
											<span style="color: #fff;">Samedi</span>
											<p>9h-12h30 / 13h30-17h</p>
										</li>
									</ul>
									<ul class="social">
										<li><a target="_blank" href="http://www.facebook.com/sharer.php?u=http://<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>&t=<?=$ogtitre?>"><i class="fa fa-facebook"></i></a></li>
										<li><a target="_blank" href="http://twitter.com/intent/tweet/?url=<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>&text=<?=$ogtitre?>"><i class="fa fa-twitter"></i></a></li>
										<li><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>&title=<?=$ogtitre?>"><i class="fa fa-linkedin"></i></a></li>
										<li><a target="_blank" href="https://plus.google.com/share?url=<?=$_SERVER[HTTP_HOST]?><?=$_SERVER[REQUEST_URI]?>"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-3">
								<div class="widget text-center">
									<div class="ecran">
										<i class="flaticon-monitor"></i>
									</div>
									<p style="text-align: left;">Vous n’avez pas trouvé de bien qui vous convient. Laissez <span style="color: #fff">votre email</span>, et soyez les <span style="color: #fff">1er</span> informés sur les <span style="color: #fff">nouveautés</span> de ces prochaines semaines</p>
									<div>
										<form class="espacenews" method="POST" action="#">
											<input type="text" class="s" name="recherche_generale" value="" placeholder="Votre email">
											<button type="submit" value="Rechercher" name="submit" class="searchsubmit"><i class="flaticon-right-arrow"></i></button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<p>
									Made with <i class="fa fa-heart-o"></i> par <a href="https://www.remixweb.eu" target="_blank" title="Création de sites internet">Remixweb</a> - <a href="mentions-legales--1--page" title="Mentions légales">Mentions</a> - <a href="honoraires--172--page" title="Mentions légales">Honoraires</a> - Immobilière des arcades Tourcoing
								</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
		
		<a id="backtotop" class="fa fa-angle-up circle" href="javascript:void(0)"></a>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery-migrate.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.singlePageNav.js"></script>
		<script type="text/javascript" src="js/modernizr-2.7.1.min.js"></script>
		<script type="text/javascript" src="js/owl.carousel.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-progressbar.min.js"></script>
		<script type="text/javascript" src="js/jquery.countTo.js"></script>
		<script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script>
		<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
		<script type="text/javascript" src="js/jquery.isotope.init.js"></script>
		<script type='text/javascript' src='js/waypoints.min.js'></script>
		<script type="text/javascript" src="js/script.js"></script>

		<script type="text/javascript" src="js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="js/extensions/revolution.extension.video.min.js"></script>
		<script type="text/javascript" src="js/extensions/revolution.extension.slideanims.min.js"></script>
		<script type="text/javascript" src="js/extensions/revolution.extension.actions.min.js"></script>
		<script type="text/javascript" src="js/extensions/revolution.extension.layeranimation.min.js"></script>
		<script type="text/javascript" src="js/extensions/revolution.extension.kenburn.min.js"></script>
		<script type="text/javascript" src="js/extensions/revolution.extension.navigation.min.js"></script>
		<script type="text/javascript" src="js/extensions/revolution.extension.migration.min.js"></script>
		<script type="text/javascript" src="js/extensions/revolution.extension.parallax.min.js"></script>
		
		
		<?php // On va aller chercher les fourchettes de prix à afficher
			$req = mysqli_query($link,"SELECT MAX(prix) as max, MIN(prix) as min FROM ".$table_prefix."_biens WHERE 1 ".$add_cat.""); 
		  	$data = mysqli_fetch_array($req);
		  	$prix_max = $data['max'];
		  	$prix_min = $data['min'];
		  	
		  	
		  	//condition qui fait que si l'on n'a pas de $prix_min et de $prix_max (par défaut sur le type de bien, ou via le formulaire de recherche) sur l'échelle de prix, alors on les fixe à 0 et à 1000000. Et spécifiquement à 250-2000 si on est sur les locations.
		  	if ($id==72) {
			  	
			  	if (!$prix_min) {
				  $prix_min = '250';	
			  	}
			  	
			  	if (!$prix_max) {
				  $prix_max = '2000';	
			  	}
			  	
		  	} else {
			  	if (!$prix_min) {
				  $prix_min = '0';	
			  	}
			  	
			  	if (!$prix_max) {
				  $prix_max = '1000000';	
			  	}
		  	}
		  	
		?>
		
	<script src="script-prix/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script>
	jQuery("#prix").ionRangeSlider({
	    type: "double",
	    grid: true,
	    min: 0,
	    max: <?php echo $prix_max; ?>,
	    from: <?php if($prix_min_fourchette) { echo $prix_min_fourchette; } else { echo $prix_min; } ?>,
	    to: <?php if($prix_max_fourchette) { echo $prix_max_fourchette; } else { echo $prix_max; } ?>,

	    prefix: "€"
	    
	    
	});		
	</script>	
	
	
	</body>
</html>