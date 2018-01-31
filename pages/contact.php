<?php	// Requête pour récupérer le contenu de la page concernée
		list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
?>

  	<?php //	DEFINIT LE MAIL ENREGISTRE
			
			$req = mysqli_query($link,"SELECT mail1,mail2,mail3,mail4,nom_titre_meta FROM ".$table_prefix."_divers WHERE ID=1 ");
				while ($data = mysqli_fetch_array($req)) {
					$mail1 = $data['mail1'];
				}
				
					
			// NETTOYAGE
			$nom= clean_form($_POST['nom']);				
			$prenom= clean_form($_POST['prenom']);
			$email= clean_form(trim($_POST['email']));		
			$adresse= clean_form($_POST['adresse']);		
			$tel= clean_form($_POST['tel']);				
			$code= clean_form($_POST['code']);				
			$ville= clean_form($_POST['ville']);
			$pays= clean_form($_POST['pays']);				
			if ($_POST['message']){$message= clean_form($_POST['message']);}
															
			if ($_GET['message']){$message= clean_form($_GET['message']);}
			
					
			if ($_POST['ref_bien']){
				$ref= clean_form($_POST['ref_bien']);
				$cat="V";
				$type = "visite/infos";
				$add_bien = "<strong>Référence du bien concerné :</strong> ".(($ref)?($ref):("-")) . "<br />";
				$objet = "Demande de visite/infos du bien ".$ref."<br /><br />";
				$subject	= "Demande de visite/info de : " . (($nom)?($nom):("-")) ." - ". (($email)?($email):("-")) . "\n" ;
			} else {
				$cat="";
				$type = "Contact";
				$objet = "Demande de contact <br /><br />";
				$subject	= "Demande de contact ".strtoupper($titre_site)."  DE : " . (($nom)?($nom):("-")) ." - ". (($email)?($email):("-")) . "\n" ;
			}
				
			if ($ID) {$ref=$ID;}
			$afch = '1';
			
	  
		if ($_POST['submit'] ) {
			
			  if ( $nom && $tel && check_mail($email) && $message )
			  {	/* Envoyer le formulaire */
				$to		= $mail1 ;
				$subject	= $subject ;
				$headers  = 'MIME-Version: 1.0' . "\r\n";
	            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	            $headers .= 'From: ' . $email . "\r\n";
	            $headers .= 'Reply-to: '.$email . "\r\n";
            
				$body = "<html><body><div style=\"text-align: left;\">";
				$body .= "<h2>".$objet."</h2>" ;
				$body .= "<strong>Nom :</strong> " . (($nom)?($nom):("-")) . "<br />" ;
				$body .= "<strong>Adresse e-mail :</strong> " . (($email)?($email):("-")) . "<br />" ;
				$body .= "<strong>Tel :</strong> " . (($tel)?($tel):("-")) . "<br />" ;
				$body .= $add_bien ;
				$body .= "<strong>Adresse</strong> : " . (($adresse)?($adresse):("-")) . "<br />" ;
				$body .= "<strong>Code Postal</strong> : " . (($code)?($code):("-")) . "<br />" ;
				$body .= "<strong>Ville</strong> : " . (($ville)?($ville):("-")) . "<br />" ;
				$body .= "<strong>pays</strong> : " . (($pays)?($pays):("-")) . "<br />" ;
				
				$body .= "<strong>Message</strong> : <div style=\"text-align: left;\">" . (($message)?($message):("-")) . "<br /><br /></div>" ;
				$body .= "</div></body></html>";
				$res = mail ($to,$subject,$body,$headers) ; //print ("$to,$subject,$body,$headeradd");
				
				// Traitement de la réponse
				if ( $res )
				{
					  $confirm	= "<div class='alert alert-success' role='alert'>Votre message a correctement été envoyé.</div>";
					  $afch = '0';
				  
					// ENREGISTREMENT DES FORMULAIRES DANS UNE TABLE
					$dbu=date('Y-m-d H:i:s');
					$IP_exp=$_SERVER["REMOTE_ADDR"];
					
					$resultat_ins = mysqli_query ($link, "INSERT INTO ".$table_prefix."_contact ( `ID` , `type` ,`nom` ,`email` , `tel` , `dbu` , `message` )
				VALUES ('' , '$type', '$nom', '$email', '$tel',  '$dbu', '$body') ");
					
				} else {
					$confirm	= "<div class='alert alert-danger' role='alert'>Une erreur est survenue lors de l'envoi de votre message. Merci de renouveler l'opération.</div>";
					$afch = '1';			
				}
				
			  } else {
				  $afch = '1' ;
				  $confirm	= "<div class='alert alert-danger' role='alert'>Merci de renseigner tous les champs obligatoires.</div>";		
				  
			  }
		}
			
	?>
	
	<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA5VUcLfsIR19n-mkuTd-OkQ5w4uA7nPnU&sensor=false&extension=.js'></script> 
	<script> 
    google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(50.7198621,3.1596517),
            zoom: 13,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            disableDoubleClickZoom: true,
            mapTypeControl: false,
            scaleControl: true,
            scrollwheel: false,
            panControl: true,
            streetViewControl: true,
            draggable : true,
            overviewMapControl: true,
            overviewMapControlOptions: {
                opened: false,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
		            styles: [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.locality",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#bdbdbd"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#181818"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1b1b1b"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#2c2c2c"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8a8a8a"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#373737"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#3c3c3c"
      }
    ]
  },
  {
    "featureType": "road.highway.controlled_access",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#4e4e4e"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#000000"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#3d3d3d"
      }
    ]
  }
],
		}
        var mapElement = document.getElementById('carte');
        var map = new google.maps.Map(mapElement, mapOptions);
        var locations = [['Immobilière des arcades', '7, avenue Gustave Dron,<br /> 59200 Tourcoing', '03 20 25 05 67', 'contact@immoarcades.com', 'contact@immoarcades.com', 50.7198621, 3.1596517, './images/marker.png']
        ];
        for (i = 0; i < locations.length; i++) {
	        
			if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
			if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
			if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
           if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
           if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
            marker = new google.maps.Marker({
                icon: markericon,
                position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                map: map,
                title: locations[i][0],
                desc: description,
                tel: telephone,
                email: email,
                web: web
            });
			link = '';            
			bindInfoWindow(marker, map, locations[i][0], description, telephone, email, web, link);
     }
	 function bindInfoWindow(marker, map, title, desc, telephone, email, web, link) {
	      var infoWindowVisible = (function () {
	              var currentlyVisible = false;
	              return function (visible) {
	                  if (visible !== undefined) {
	                      currentlyVisible = visible;
	                  }
	                  return currentlyVisible;
	               };
	           }());
	           iw = new google.maps.InfoWindow();
	           google.maps.event.addListener(marker, 'click', function() {
	               if (infoWindowVisible()) {
	                   iw.close();
	                   infoWindowVisible(false);
	               } else {
	                   var html= "<div class='info-windows'><div class='info-titre'>"+title+"</div><div class='cartouche-windows'>Tél. : "+telephone+' <br />'+description+'<br />'+email+"</div></div>";
	                   iw = new google.maps.InfoWindow({content:html});
	                   iw.open(map,marker);
	                   infoWindowVisible(true);
	               }
	        });
	        google.maps.event.addListener(iw, 'closeclick', function () {
	            infoWindowVisible(false);
	        });
	        
	 }
	}
	</script>
			
			
<!-- Page Title
================================================== -->
<div class="section section-bg-12 section-fixed pt-14 pb-3">
	<div class="bg-overlay-dark"></div>
	<div class="container">
		
		<div class="row">
			<div class="col-sm-12">
				
				<?php // Si on vient des boutons visiter ou demande d'infos
					if (isset($_GET['ref_bien'])) { 
						if ($_GET['a']=='visite')  {
							?>
							
							<div class="text-center">
								<h2 class="page-title">Visitez ce bien</h2>
								<div class="page-title-subtext extra-font">Vous souhaitez visiter ce bien ? Il vous suffit de remplir le formulaire de demande de visite.</div>
								<div class="breadcrumb">
									<ul class="breadcrumbs">
										<li><a href="<?php echo $defaultpg; ?>.php">Accueil</a></li>
										<li><?php echo $titrep; ?></li>
									</ul>
								</div>
							</div>
							
						<?php } else if ($_GET['a']=='infos') { ?>
						
							<div class="text-center">
								<h2 class="page-title">Demande d'infos</h2>
								<div class="page-title-subtext extra-font">Vous souhaitez découvrir ce bien ? Il vous suffit de remplir le formulaire de demande d'informations.</div>
								<div class="breadcrumb">
									<ul class="breadcrumbs">
										<li><a href="<?php echo $defaultpg; ?>.php">Accueil</a></li>
										<li><?php echo $titrep; ?></li>
									</ul>
								</div>
							</div>
							
						<?php }
					?>
			
				<?php } else { ?>
				
					<div class="text-center">
						<h2 class="page-title">Contactez-nous</h2>
						<div class="page-title-subtext extra-font"><?php echo $texte2p; ?></div>
						<div class="breadcrumb">
							<ul class="breadcrumbs">
								<li><a href="<?php echo $defaultpg; ?>.php">Accueil</a></li>
								<li><?php echo $titrep; ?></li>
							</ul>
						</div>
					</div>
				
				<?php }?>
			</div>
		</div>
	</div>
</div>  
				
  <!-- Contenu principal
================================================== -->

	<div class="section pt-8 pb-8">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-4 col-md-4 mb-3">
					<div class="dp-table contact-info">
						<i class="pe-7s-phone dark fz-40 dp-table-cell icon top"></i>
						<span class="dark fz-20 dp-table-cell middle">
						<u>Nous joindre</u><br />
						Tél. : <a href="tel:+33320250567">03 20 25 05 67</a><br />
						Fax : 03 20 25 24 22</span>
					</div>
				</div>
				<div class="col-sm-6 col-lg-4 col-md-4 mb-3">
					<div class="dp-table contact-info">
						<i style="font-size: 40px;" class="flaticon-interview dark fz-40 dp-table-cell icon top"></i>
						
						<span class="dark fz-20 dp-table-cell middle">
						<u>Nos horaires</u><br />
						Ouvert du lundi au vendredi de<br />
						9h - 12h / 14h - 19h<br />
						le samedi<br />
						9h - 12h / 14h - 18h
						</span>
					</div>
				</div>
				<div class="col-sm-6 col-lg-4 col-md-4 mb-3">
					<div class="dp-table contact-info">
						<i class="pe-7s-map-marker dark fz-40 dp-table-cell icon top"></i>
						<span class="dark fz-20 dp-table-cell middle">
						<u>Nos coordonnées</u><br />
						7, avenue Gustave Dron<br />
						59200 Tourcoing<br />
						France</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 p-0">
					<?php if ($_GET['ref_bien']) { 
							// Requête pour récupérer la première photo du bien
							$req = mysqli_query($link,"SELECT * FROM ".$table_prefix."_biens WHERE ref='".$_GET['ref_bien']."'"); 
							$data = mysqli_fetch_array($req);
							
							$photo_principale = $data['PHOTO_01'];
							
					?>
					<img src="<?php echo $photo_principale; ?>" title="Nous vous proposons de découvrir ce bien immobilier" alt="Visitez ce bien" />
					<?php } else { ?>
					<div id="carte" data-marker-image="images/map-marker.png"></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="section pt-9 pb-9">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-12 col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10">
					<div class="text-center mb-9">
						<?php // Si on vient des boutons visiter ou demande d'infos
						if (isset($_GET['ref_bien'])) { 
							if ($_GET['a']=='visite')  {
							?>
								<h2 class="sub-heading mb-2">
									<span class="f2">Vous souhaitez</span> 
									<span class="f1"> visiter un bien</span> 
								</h2>
								<p>
									Nous vous invitons à renseigner le formulaire ci-dessous.
								</p>
								
								<?php } else if ($_GET['a']=='infos') { ?>
								
								<h2 class="sub-heading mb-2">
									<span class="f2">Vous souhaitez</span> 
									<span class="f1"> plus d'infos sur un bien</span> 
								</h2>
								<p>
									Nous vous invitons à renseigner le formulaire ci-dessous.
								</p>

							<?php } ?>
								
						<?php } else { ?>
						
							<h2 class="sub-heading mb-2">
								<span class="f2">Restez en contact</span> 
								<span class="f1"> avec nous</span> 
							</h2>
							<p>
								Nous vous invitons à renseigner le formulaire ci-dessous pour nous contacter.
							</p>
								
						<?php } ?>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12 col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10">
					<div class="contact-form">
						
						<?php 	if ($confirm) {
							       echo $confirm;
							    }
						?>
						<?php if ($afch=='1' ) { /* Affichage du formulaire */ 
						
								if (isset($_GET['ref_bien'])) {
									$ref_bien = $_GET['ref_bien'];
								} else {
									$ref_bien = "";
								} 
						?>
						
							<form method="POST" action="">
								
								<?php // Si on vient des boutons visiter ou demande d'infos
									if (isset($_GET['ref_bien'])) { ?>
									<div class="row">
										<div class="col-md-12 mb-3">
											<label for="reference">Référence du bien</label>
											<input type="text" name="ref_bien" id="reference" placeholder="Référence du bien" value="<?php print (stripslashes($ref_bien));?>" >
										</div>
									</div>
									<label>Vos infos</label>
								<?php } ?>
								
								<div class="row">
									<div class="col-md-6 mb-3">
										<input type="text" name="prenom" value="<?php print (stripslashes($nom));?>" placeholder="Prénom" />
									</div>
									<div class="col-md-6 mb-3">
										<input type="text" name="nom" required value="<?php print (stripslashes($prenom));?>" placeholder="Nom*" />
									</div>
									<div class="col-md-6 mb-3">
										<input type="text" name="tel" required value="<?php print (stripslashes($tel));?>" placeholder="Téléphone*" />
									</div>
									<div class="col-md-6 mb-3">
										<input type="email" name="email" required value="<?php print (stripslashes($email));?>" placeholder="E-mail*" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 mb-3">
										<input type="text" name="adresse" placeholder="Adresse" value="<?php print (stripslashes($adresse));?>" >
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 mb-3">
										<input type="text" name="code" placeholder="Code postal" value="<?php print (stripslashes($code));?>" >
									</div>
									<div class="col-md-6 mb-3">
										<input type="text" name="ville" required placeholder="Ville*" value="<?php print (stripslashes($ville));?>" >
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-12 mb-3">
										<input type="text" name="pays" placeholder="Pays" value="<?php print (stripslashes($pays));?>" >
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-12 mb-3">
										<textarea name="message" required cols="40" rows="8" placeholder="Message*"><?php print (stripslashes($message));?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 mb-3">
										<input name="submit" type="submit" value="Envoyer" value="submit" class="btn btn-alt btn-border" />
									</div>
								</div>
								
							</form>
						
						
						<?php } ?>
					</div>
				</div>
			</div>
			
		</div>
	</div>
