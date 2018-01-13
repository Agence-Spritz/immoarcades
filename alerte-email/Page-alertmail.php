<?php 
// EMAIL
$email=clean_form($_POST['email']);
$prix=clean_form($_POST['prix']);
$type=clean_form($_POST['type']);
$Submit=clean_form($_POST['Submit']);


if ( $unsubscribe ) 
{	if ( mysqli_query($link,"DELETE FROM ".$table_prefix."_alertmail WHERE mail='$unsubscribe'") ) {	
		$msgok="<p>Succès de la suppression de votre enregistrement <b>($unsubscribe)</b> à ce service.</p>"; 
	} else {	
		$msgko="<p>Echec de la suppression de votre enregistrement <b>($unsubscribe)</b> à ce service.</p>"; 
	}
}

if ( $Submit && check_email($email)==TRUE && ($prix || $type) ) {
  list($exist) = mysqli_fetch_array(mysqli_query($link,"SELECT count(*) FROM ".$table_prefix."_alertmail WHERE mail=\"$email\""));
  if ( !$exist || $exist ) { //"|| $exist" multi inscription autorisée
	$expld=explode('-',$prix,2); $min=$expld[0]; $max=$expld[1];
    // print("<p>min=$min - max=$max</p>");
	if ( mysqli_query($link,"INSERT INTO ".$table_prefix."_alertmail SET `date`=now(), mail=\"$email\", type=\"$type\", min='$min', max='$max'") ) 
	{	$msgok="<p>Succès de votre inscription.</p>";
      	unset($email,$type,$prix);
    } else {	$msgko="<p>Une erreur est survenue durant l'exécution de la requête.</p>";  }
  } else {	$msgko.="<p>Votre email existe déjà, vous pourrez vous désinscrire à chaque réception d'email.</p>";}
}
elseif ($Submit) {$msgko.="<p>Merci de compl&eacute;ter le formulaire et d'indiquer un email valide.</p>";}
?>

<div class="breadcrumb-box">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="index.php">Accueil</a> </li>
      <li class="active">Contactez-nous</li>
    </ul>	
  </div>
</div><!-- .breadcrumb-box -->

<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title">Restez en Alerte sur les nouveaut&eacute;s</h1>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content col-sm-12 col-md-12">
		<div class="row">
			  <!-- FORM -->
              <div class="col-sm-6 col-md-6">
                <form id="alertmailform" action="alertmail.php" class="" method="POST">
                  <h3 class="title">Inscrivez-vous gratuitement</h3>
                  
                  <?=($msgok)?("<i class='fa fa-check fa-2x' style='color:#66CC33'></i> ".$msgok):("")?>
				  <?=($msgko)?("<i class='fa fa-warning fa-2x' style='color:#F30'></i> ".$msgko):("")?>
                  <label>Votre email: <span class="required">*</span></label>
                  <input class="form-control" type="email" name="email" value="<?=$email?>"><br />
                  <label>Prix recherché: <span class="required">*</span></label>
                  <SELECT class="form-control" name="prix" style="border:1px #CCC solid">
					<OPTION VALUE="">Tous les prix</OPTION>
					<OPTION VALUE="0-100000" <?=($prix=="0-100000")?("selected='selected'"):("")?>>Entre 0€ et 100.000€</OPTION>
					<OPTION VALUE="100000-200000" <?=($prix=="100000-200000")?("selected='selected'"):("")?>>Entre 100.000€ et 200.000€</OPTION>
					<OPTION VALUE="200000-300000" <?=($prix=="200000-300000")?("selected='selected'"):("")?>>Entre 200.000€ et 300.000€</OPTION>
					<OPTION VALUE="300000-1500000" <?=($prix=="300000-1500000")?("selected='selected'"):("")?>>Au dessus de 300.000€</OPTION>
				  </SELECT><br />
				  <label>Type de bien  recherché: <span class="required">*</span></label>
                  <SELECT class="form-control"name="type">
					<OPTION VALUE="">Toutes les types</OPTION>
						<OPTION VALUE="Maisons" <?=($type=="Maisons")?("selected='selected'"):("")?>>Maisons</OPTION>
                        <OPTION VALUE="Appartements / Lofts" <?=($type=="Appartements / Lofts")?("selected='selected'"):("")?>>Appartement/loft/studio</OPTION>
                        <OPTION VALUE="Hangars/Bureaux/Garages" <?=($type=="Parking/garage/box")?("selected='selected'"):("")?>>Hangars/Bureaux/Garages</OPTION>
                        <OPTION VALUE="Commerces" <?=($type=="Appartement")?("selected='selected'"):("")?>>Commerces</OPTION>
						<OPTION VALUE="Terrains" <?=($type=="Terrains")?("selected='selected'"):("")?>>Terrains</OPTION>
					</SELECT>
                  <div class="clearfix"></div>
                  <div class="buttons-box clearfix">
                    
                    <input style="float: right; color: #fff !important" type="submit" name="Submit" class="btn btn-default" value="S'inscrire" />
                    <span class="required"><b>*</b> Champs obligatoires</span>
                  </div><!-- .buttons-box -->
                </form>
              </div>
          
              <div class="col-sm-6 col-md-6 contact-info bottom-padding">
                <img src="img/alerteMail.jpg" title="Restez en Alerte" alt="<?=$title?><?=$keywords?>" width="100%"  style="float:left; margin: -30px 10px 10px 0"/>
                <p>
                Vous n'avez pas trouvé de biens qui vous correspondent aujourd'hui sur notre site !
                Nous vous proposons d'être tenu informé des nouvelles entrées par Email.<br /><br />
                Remplissez ce formulaire avec l'un des 2 critères de recherche souhaité, vous recevrez un email dès qu'un bien correspondant sera nouvellement publié.<br />
                <hr>
                ** Les données récoltées ne seront ni vendues ou exploitées à des fins commerciales.<br />
                ** Un lien de désinscription sera présent sur l'email pour effacer vos données de notre site.<br />
                <hr>
                </p>
              </div>
		  	</div>
		</div>
      </div>
    </div>
  </div><!-- .container -->
</section><!-- #main -->