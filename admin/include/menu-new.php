<?php 
error_reporting(E_ALL & ~E_NOTICE); // Désactiver le rapport d'erreurs
include ("include/cookieliendirect.txt") ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<?php 
	setlocale(LC_TIME, 'fr','fr_FR','fr_FR@euro','fr_FR.utf8','fr-FR','fra');
	date_default_timezone_set('Europe/Paris');

	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
		
<title>Admnistration Remix Web</title>

	<!-- =-=-=-=-=-=-= Mobile Specific =-=-=-=-=-=-= -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <!-- =-=-=-=-=-=-= Bootstrap CSS Style =-=-=-=-=-=-= -->
      <link rel="stylesheet" href="./css/bootstrap.css">
      <!-- =-=-=-=-=-=-= Style personnel =-=-=-=-=-=-= -->
	  <link href="./include/styleadmin-new.css" rel="stylesheet" type="text/css" />  
	  <!-- =-=-=-=-=-=-= Font Awesome =-=-=-=-=-=-= -->
      <link rel="stylesheet" href="../css/font-awesome.min.css"> 
      <!-- Animation Css -->
      <link href="./css/animate.min.css" rel="stylesheet">
      <!-- Menu Hover -->
      <link href="./css/bootstrap-dropdownhover.min.css" rel="stylesheet">
       <!-- CK EDITOR -->
	  <script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
      <!-- JavaScripts -->
      <script src="./js/modernizr.js"></script>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
	  <!-- =-=-=-=-=-=-= Google Fonts =-=-=-=-=-=-= -->
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600,600italic,700,700italic,900italic,900,300,300italic%7CMerriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
      <!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
      <script src="./js/jquery.min.js"></script>
      <!-- Bootstrap Core Css  -->
      <script src="./js/bootstrap.min.js"></script>
      <!-- Jquery Easing -->
      <script type="text/javascript" src="./js/easing.js"></script>
      <!-- Jquery Migrate -->
      <script src="./js/jquery-migrate.min.js"></script>
      <!-- Dropdown Hover  -->
      <script src="./js/bootstrap-dropdownhover.min.js"></script>

</head>

<?
include("inc/openDB.txt"); include ("include/fonction.php");

//LANGUES
list($languesRecup) = mysqli_fetch_array(mysqli_query($link, "SELECT langues FROM ".$table_prefix."_divers WHERE ID=1 "));
$xpld=explode(',',$languesRecup,5); 
if ($xpld[0]) {$langues[0] = $xpld[0];}
if ($xpld[1]) {$langues[1] = $xpld[1];}
if ($xpld[2]) {$langues[2] = $xpld[2];}
if ($xpld[3]) {$langues[3] = $xpld[3];}
if ($xpld[4]) {$langues[4] = $xpld[4];}
$largtabl = 1260;  //en pixel largeur du tableau global

// VARIABLES GLOBALES
while (list($key, $val) = each($_GET)) {$$key=$val;}
while (list($key, $val) = each($_POST)) {$$key=$val;}
while (list($key, $val) = each($_FILES)) {$$key=$val;}
while (list($key, $val) = each($_COOKIE)) {$$key=$val;}
?>

<body>
<?php if (!$c) { ?>

<div class="container contenu-admin">
	
	<header class="header">
		
		<nav class="navbar navbar-default">
		  
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="http://www.immoarcades.be"><img src="./img/salamandre.png" title="Remix Web - création de sites internet" alt="Remix Web - création de sites internet"/></a>
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li <?php  if (strpos($url,'page.php') !== false) { echo 'class="active"'; } ?> ><a href="page.php">Pages </a></li>
		        <li <?php  if (strpos($url,'blog.php') !== false) { echo 'class="active"'; } ?> ><a href="blog.php">Actualités </a></li>
		        <li <?php  if (strpos($url,'diapo.php') !== false) { echo 'class="active"'; } ?>><a href="diapo.php">Diapo accueil</a></li>
		        
		        <li class="dropdown <?php  if ((strpos($url,'referencement.php') !== false)||(strpos($url,'contact.php') !== false)||(strpos($url,'divers.php') !== false)||(strpos($url,'import_evosys.php') !== false) ) { echo 'active'; } ?>">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestion <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li <?php  if (strpos($url,'referencement.php') !== false) { echo 'class="active"'; } ?>><a href="referencement.php">Référencement</a></li>
		            <li <?php  if (strpos($url,'contact.php') !== false) { echo 'class="active"'; } ?>><a href="contact.php">Contacts du site</a></li>
		            <li role="separator" class="divider"></li>
		            <li <?php  if (strpos($url,'divers.php') !== false) { echo 'class="active"'; } ?>><a href="divers.php">Paramètres</a></li>
		            <li <?php  if (strpos($url,'import_evosys.php') !== false) { echo 'class="active"'; } ?>><a href="cron/import_evosys.php">Synchronisation des biens</a></li>
		          </ul>
		        </li>
		      </ul>
		      
		    </div><!-- /.navbar-collapse -->
		</nav>
	</header>
<?php } ?>