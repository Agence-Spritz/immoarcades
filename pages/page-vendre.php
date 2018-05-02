<?php	// Requête pour récupérer le contenu de la page concernée
	list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
?>

<?php 			
// Si formulaire soumis	  
if ($_POST['submit'] ) {
	
	//	On récupére le mail de destination	
	$req = mysqli_query($link,"SELECT mail1,mail2,mail3,mail4,nom_titre_meta FROM ".$table_prefix."_divers WHERE ID=1 ");
	while ($data = mysqli_fetch_array($req)) {
			$mail1 = $data['mail1'];
	}
	
	// récupération des variables
	$nom= clean_form($_POST['nom']);	
	$email= clean_form(trim($_POST['email']));
	$tel= clean_form($_POST['tel']);		
	$adresse= clean_form($_POST['adresse']);	
/*
	$code= clean_form($_POST['cp']);				
	$ville= clean_form($_POST['ville']);
*/
	$dispos = 	clean_form($_POST['dispos']);
	
	
	$type = "Estimation";
	$objet = "Contact pour estimation <br /><br />";
	$subject = "Contact pour estimation DE : " . (($nom)?($nom):("-")) ." - ". (($email)?($email):("-")) . "\n" ;
	
	if ( $nom && $tel && check_mail($email) )
	{	
		$to		= $mail1 ;
		$subject	= $subject ;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
        $headers .= 'From: ' . $email . "\r\n";
        $headers .= 'Reply-to: '.$email . "\r\n";
    
		$body = "<html><body><div style=\"text-align: left;\">";
		$body .= "<h2>".$objet."</h2>" ;
		$body .= "<strong>Nom :</strong> " . (($nom)?($nom):("-")) ."<br />";
		$body .= "<strong>Adresse e-mail :</strong> " . (($email)?($email):("-")) ."<br />";
		$body .= "<strong>Tel :</strong> " . (($tel)?($tel):("-")) ."<br />";
		$body .= "<strong>Coordonnées du bien à estimer</strong>";
		$body .= "<strong>Adresse</strong> : " . (($adresse)?($adresse):("-"))."<br />";
		//$body .= "<strong>Code Postal</strong> : " . (($code)?($code):("-"))."<br />";
		//$body .= "<strong>Ville</strong> : " . (($ville)?($ville):("-"))."<br />";
		
		$body .= "<strong>Disponibilités du contact</strong> : " .(($dispos)?($dispos):("-"))."<br />" ;
		
		$body .= "</div></body></html>";
		$res = mail ($to,$subject,$body,$headers) ; //print ("$to,$subject,$body,$headeradd");
		
		
		// Traitement de la réponse
		if ( $res )
		{
			$confirm	= "<div class='alert alert-success' role='alert'>Votre message a correctement été envoyé.</div>";
			 
			// ENREGISTREMENT DES FORMULAIRES DANS UNE TABLE
			$dbu=date('Y-m-d');
			$IP_exp=$_SERVER["REMOTE_ADDR"];
				 
			$resultat_ins = mysqli_query ($link, "INSERT INTO ".$table_prefix."_contact ( `ID` , `type` ,`nom` ,`email` , `tel` , `dbu` , `message` )
				VALUES ('' , '$type', '$nom', '$email', '$tel',  '$dbu', '$body') ");
		
		} else {
			$confirm = "<div class='alert alert-danger' role='alert'>Une erreur est survenue lors de l'envoi de votre message. Merci de renouveler l'opération.</div>";				
		}
		
	} else {
		  
		$confirm = "<div class='alert alert-danger' role='alert'>Merci de renseigner tous les champs obligatoires.</div>";		
		  
	}
}
			
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
	<div class="section pt-8">
		<div class="container">
			<div class="row">
				
				<div class="col-md-3">
					<div class="mb-4">
						<h3 class="heading wg-title"><?php echo $texte2p; ?></h3>
					</div>
				</div>
				<div class="col-md-9">
					<div class="mb-4">
						<h2 class="sub-heading text-right">
							<span class="f2">Nous vous accompagnons</span> 
							<span class="f1"> jusqu'au bout.</span>
						</h2>
					</div>
				</div>
				
				<div class="col-sm-12 col-lg-12 col-md-12 mb-4">
					<p><?php echo $textep; ?></p>
				</div>
						
					
				<?php if (is_file('./images/pages-immobilier-tourcoing-lys-les-lannoy/'.$id.'.jpg')) { ?>
					<div class="col-sm-12 col-lg-7 col-md-7">
						<img src="<?php echo './images/pages-immobilier-tourcoing-lys-les-lannoy/'.$id.'.jpg'; ?>" alt="<?php echo $titrep; ?>" title="<?php echo $titrep; ?>" />
					</div>
				<?php } ?>
				<div style="clear: both;"></div>
			
<!--
				<div class="col-sm-12 col-lg-12 col-md-12">		
					<h3 class="heading wg-title">Un service sur mesure en 5 étapes</h3>
			        <div class="wizard">
			            <div class="wizard-inner">
			                <div class="connecting-line"></div>
			                <ul class="nav nav-tabs" role="tablist">
			
			                    <li role="presentation" class="active">
			                        <a href="#rencontre" data-toggle="tab" aria-controls="rencontre" role="tab" title="Rencontre">
			                            <span class="round-tab">
			                                <i class="flaticon-interview"></i>
			                            </span>
			                        </a>
			                    </li>
			
			                    <li role="presentation" class="">
			                        <a href="#mise_en_vente" data-toggle="tab" aria-controls="mise_en_vente" role="tab" title="Mise en vente">
			                            <span class="round-tab">
			                                <i class="flaticon-advertising"></i>
			                            </span>
			                        </a>
			                    </li>
			                    <li role="presentation" class="">
			                        <a href="#acheteur" data-toggle="tab" aria-controls="acheteur" role="tab" title="Trouver le bon acheteur">
			                            <span class="round-tab">
			                                <i class="flaticon-group"></i>
			                            </span>
			                        </a>
			                    </li>
			
			                    <li role="presentation" class="">
			                        <a href="#suivi" data-toggle="tab" aria-controls="suivi" role="tab" title="Suivi, analyse et compte rendu">
			                            <span class="round-tab">
			                                <i class="flaticon-report"></i>
			                            </span>
			                        </a>
			                    </li>
			                    
			                    <li role="presentation" class="">
			                        <a href="#vente" data-toggle="tab" aria-controls="vente" role="tab" title="Vente">
			                            <span class="round-tab">
			                                <i class="flaticon-champagne-and-two-glasses"></i>
			                            </span>
			                        </a>
			                    </li>
			                </ul>
			            </div>
			
			            <form role="form">
			                <div class="tab-content">
			                    <div class="tab-pane active" role="tabpanel" id="rencontre">
			                        <h3>Se rencontrer</h3>
			                        <p>Apprendre à se connaitre et comprendre vos souhaits</p>
			                    </div>
			                    <div class="tab-pane" role="tabpanel" id="mise_en_vente">
			                        <h3>Mise en vente</h3>
			                        <p>Nous mettons votre bien en vente au sein de notre agence et sur nos réseaux de diffusion.<br /> Cette démarche est appuyée par la création et l'utilisation de supports de communication, vidéos, publicités, réseaux sociaux, ...</p> 
			                    </div>
			                    <div class="tab-pane" role="tabpanel" id="acheteur">
			                        <h3>Trouver le bon acheteur</h3>
			                        <p>Nous proposons votre bien à nos clients en recherche, nous recueillons les demandes de visites, rencontrons les personnes intéressées et leur présentons votre bien.</p>
			                    </div>
			                    <div class="tab-pane" role="tabpanel" id="suivi">
			                        <h3>Suivi, analyse et compte rendu</h3>
			                        <p>Nous vous informons des actions que nous réalisons pour promouvoir votre bien ainsi que des "touches" que nous aurons eues.</p>
			                    </div>
			                    <div class="tab-pane" role="tabpanel" id="vente">
			                        <h3>Vente de votre bien</h3>
			                        <p>Félicitations, votre bien est vendu !<br />
				                        Nous nous chargeons de la rédaction des contrats et vous accompagnons dans les différentes démarches liées à la vente de votre bien immobilier.
			                        </p>
			                    </div>
			                    <div class="clearfix"></div>
			                </div>
			            </form>
			        </div>
				</div>
-->
		   	</div>
		</div>

	</div>
	
	<div class="section  pb-10">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="mb-6">
						<h3 class="heading wg-title">Un service sur mesure en 5 étapes</h3>
					</div>
				</div>
				<div class="col-md-9">
					<div class="mb-6">
						<h2 class="sub-heading text-right">
							<span class="f1">Etapes d'une mise en vente</span> 
						</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 p-0">
					<div class="team-carousel" data-auto-play="true" data-desktop="4" data-laptop="4" data-tablet="2" data-mobile="1">
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape1.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Rencontre</a></h5>
							<div class="position extra-font italic">Vos souhaits</div>
							<div class="description">présentation de votre projet, estimation au plus juste de votre bien, information et conseils pour le valoriser
							</div>
						</div>
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape2.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Mise en vente</a></h5>
							<div class="position extra-font italic">Photos, Vidéos, Pubs</div>
							<div class="description">
								préparation et explications sur les différents médias de diffusion et la communication, choix des photos, rédaction des annonces publicitaires, choix des différents contrats de vente - stratégie
							</div>
						</div>
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape3.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Suivi et échanges</a></h5>
							<div class="position extra-font italic">Analyse et compte rendu</div>
							<div class="description">
								connaissance précise de votre bien, soucis des détails, analyse des besoins des acquéreurs pour visites ciblées au maximum, compte rendus de visites et ressentis, mise au point suite aux réactions ajustement prix de marché
							</div>
						</div>
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape4.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Vente</a></h5>
							<div class="position extra-font italic">Rédaction des contrats</div>
							<div class="description">
								Etude de financement précise, Rédaction des contrats et des formalités administratives, Transmission au notaire chargé de l'acte authentique
							</div>
						</div>
						<div class="team-item text-center">
							<div class="team-media">
								<a href="team-detail.html">
									<img class="img-circle" src="images/vendre-etape5.jpg" alt="" />
								</a>
							</div>
							<h5><a href="team-detail.html">Acte notarié</a></h5>
							<div class="position extra-font italic">Santé ! </div>
							<div class="description">
								Accompagnement et présence jusqu'à la remise des clés
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="section bg-light">
		<div class="container">
			<div class="row">
				<div class="full-left has-overlay p-0 col-sm-5 hidden-sm hidden-xs">
					<div class="fullwidth section-bg-estimation section-cover">
						
					</div>
				</div>
				<div class="col-sm-12 col-lg-offset-5 col-lg-7 col-md-offset-5 col-md-7 pt-9 pb-9">
					<div class="mb-4">
						<h3 class="heading wg-title">Que vaut votre bien ?</h3>
						<h2 class="sub-heading mb-1">
							<span class="f2">Estimation</span> 
							<span class="f1"> gratuite</span> 
						</h2>
						<p>Vous souhaitez faire estimer votre bien GRATUITEMENT et sans engagement. Remplissez ce formulaire nous vous contacterons au plus vite. </p>
					</div>
					<div class="contact-form">
						<?php if ($confirm) {
					       echo $confirm;
					       }
					    ?>
						<form action="" method="POST" id="estimation">
							<div class="row">
								<div class="col-md-6 mb-3">
									<input type="text" name="nom" value="" placeholder="Votre nom*" required />
								</div>
								<div class="col-md-6 mb-3">
									<input type="tel" name="tel" value="" placeholder="Votre téléphone*" required />
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3">
									<input type="email" name="email" value="" placeholder="Votre Email*" required />
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3">
									<textarea name="adresse" cols="40" rows="2" value="" placeholder="Adresse complète du bien à visiter*" required></textarea>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 mb-3">
									<textarea name="dispos" cols="40" rows="2" value="" placeholder="Vos disponibilités*" required></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3">
									<input type="submit" value="Envoyer" name="submit" class="btn btn-white" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>