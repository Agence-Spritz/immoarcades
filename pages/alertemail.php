<?php	// Requête pour récupérer le contenu de la page concernée
	list($titrep, $textep, $texte2p) = mysqli_fetch_array(mysqli_query($link, "SELECT titre, texte, texte2 FROM ".$table_prefix."_pages WHERE page='page' AND ID='$id' "));
?>

<?php 			
// Si formulaire soumis	  
if ($_POST['submit'] ) {
	
	// récupération des variables
		
	$email= clean_form(trim($_POST['email']));
	$date = date('Y-m-d H:i:s');
	
	$type_bien = clean_form(trim($_POST['type']));
	$budget_mini = clean_form(trim($_POST['budget_mini']));
	$budget_maxi = clean_form(trim($_POST['budget_maxi']));
	
	if ( check_mail($email) )
	{	
			
			// ENREGISTREMENT DES FORMULAIRES DANS UNE TABLE
			$dbu=date('Y-m-d');
			$IP_exp=$_SERVER["REMOTE_ADDR"];
				 
			$resultat_ins = mysqli_query ($link, "INSERT INTO ".$table_prefix."_alertmail ( `ID` , `date` , `mail` , `type` , `min` , `max` )
				VALUES ('' , '$date', '$email', '$type_bien',  '$budget_mini',  '$budget_maxi') ");
				
				$confirm	= "<div class='alert alert-success' role='alert'>Votre demande a bien été enregistrée.</div>";
		
	} else {
		$confirm = "<div class='alert alert-danger' role='alert'>Merci de renseigner au minimum votre adresse email.</div>";
	}
} else if ($_POST['submit_footer'] ) {
	$email= clean_form(trim($_POST['email']));
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
	<div class="section pt-8 pb-8">
		<div class="container">
			<div class="row">
				
				<div class="col-md-12">
					<div class="mb-4">
						<h3 class="heading wg-title"><?php echo $titrep; ?></h3>
					</div>
				</div>
				
				<div class="col-sm-12 col-lg-12 col-md-12 ">
					<p><?php echo $textep; ?></p>
				</div>
						
				<div style="clear: both;"></div>
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
					
					<div class="contact-form">
						<?php if ($confirm) {
					       echo $confirm;
					       }
					    ?>
						<form action="" method="POST" id="estimation">
							
							<div class="row">
								<div class="col-md-12 mb-3">
									<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Votre Email*" required />
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-3">
									<select name="type">
									<?php $req = mysqli_query($link,"SELECT DISTINCT typesimple FROM ".$table_prefix."_biens WHERE 1 AND typesimple<>'' ORDER BY typesimple ASC"); 
										  	while ($data = mysqli_fetch_array($req)) { 
										?>
											<option value="<?php echo $data['typesimple']; ?>"><?php echo $data['typesimple']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 mb-3">
									<input type="text" name="budget_mini" value="<?php echo $budget_mini; ?>" placeholder="Votre budget mini"  />
								</div>
							
								<div class="col-md-6 mb-3">
									<input type="text" name="budget_maxi" value="<?php echo $budget_maxi; ?>" placeholder="Votre budget maxi"  />
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