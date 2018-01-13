<?php if ( $nepasafficher==1 )  { ?><html><head>
	<style type="text/css">
	<!--
	A:visited {	COLOR: #bc4c00; TEXT-DECORATION: none}
	A:link {	COLOR: #bc4c00; TEXT-DECORATION: none}
	A:hover {COLOR: #fc6b08}

	.normalgris {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#3c3b3a}
	.normalbleu {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#0035ad}
	.grandbleu {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color:#0035ad}
	.grandblanc {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color:#FFFFFF}
	.normalrouge {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#cc0000}
	
	.tablebordgris{border: 1px solid #bfbfbf;}
	-->
	</style>
    
     <title></title></head><body>
	
	<table width="800" border="0" cellspacing="0" cellpadding="10">
  	<tr>
    <td width="400" valign="top" bgcolor="#FFFFFF" class="normalgris"><img src="http://www.neuville-habitat.com/img/OpenGraph.jpg"></td>
  	<td valign="top" bgcolor="#EEEEEE" class="grandbleu">ALERTE EMAIL<br>
  	  <span class="normalgris">UN BIEN A ETE MIS A JOUR ET CORRESPOND A VOS CRITERES</span></td>
  	</tr>
  	<tr>
    <td colspan="2" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="10" class="normalgris">
      <tr>
        <td><p><span class="normalbleu">Cher '.$titre.' '.$nom.' '.$prenom.',
          
          </span><br />
          <br />
          <br />
          Vous &ecirc;tes inscrit sur le service &quot;Alertes email&quot; de Neuville Habitat<span class="normalrouge"></span> du site www.neuville-habitat.com.</p>
          <p>Nous avons le  plaisir de vous informer que le bien suivant vient &ecirc;tre mis &agrave; jour sur le site et correspond aux crit&egrave;res enregistr&eacute;s :</p>
          <p><a href="http://www.neuville-habitat.com/alerte--'.$IDbien.'--fiche">Voir le bien concern&eacute; N&deg; '.$IDbien.'<br>
          <img src="http://www.neuville-habitat.com/photo/'.$IDbien.'.jpg" width="300" height="200" ></a><br />
              <br />
              <strong>
              <br />
              EFFACER VOS CRITERES DE RECHERCHE </strong>: <br>
              <a href="http://www.neuville-habitat.com/alertmail.php?unsubscribe='.$dest.'">Se d&eacute;sinscrire du service Alerte mail Neuville Habitat</a><br>
              <br>
            <br>
            
            <br />
          </p>
          </td>
     	 </tr>
    	</table>   	  </td>
  		</tr>
		</table>
     </body></html>
<?php } ?>
		
		
<?php 
// MAIL ALERTE EMAIL
function mail_alertemail($dest,$exp,$nom_du_site,$titre,$nom,$prenom,$IDbien,$status)
{	$subject	= "Un bien a été mis à jour Alerte Email Notaire mahieu.\n" ;
	$headeradd	= "Content-Type: text/html;\n	charset=\"utf-8\"\n" ;
	$headeradd .= "From: Neuville Habitat - Alerte Email<".$exp.">" ;
	$headeradd .= 'Reply-to: contact@neuville-habitat.com' . "\r\n";
	$body ='<html><head>
	<style type="text/css">
	<!--
	A:visited {	COLOR: #bc4c00; TEXT-DECORATION: none}
	A:link {	COLOR: #bc4c00; TEXT-DECORATION: none}
	A:hover {COLOR: #fc6b08}

	.normalgris {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#3c3b3a}
	.normalbleu {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#0035ad}
	.grandbleu {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color:#0035ad}
	.grandblanc {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color:#FFFFFF}
	.normalrouge {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#cc0000}
	
	.tablebordgris{border: 1px solid #bfbfbf;}
	-->
	</style>
    
     <title></title></head><body>
	
	<table width="800" border="0" cellspacing="0" cellpadding="10">
  	<tr>
    <td width="400" valign="top" bgcolor="#FFFFFF" class="normalgris"><img src="http://www.neuville-habitat.com/img/OpenGraph.jpg"></td>
  	<td valign="top" bgcolor="#EEEEEE" class="grandbleu">ALERTE EMAIL<br>
  	  <span class="normalgris">UN BIEN A ETE MIS A JOUR ET CORRESPOND A VOS CRITERES</span></td>
  	</tr>
  	<tr>
    <td colspan="2" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="10" class="normalgris">
      <tr>
        <td><p><span class="normalbleu">Cher '.$titre.' '.$nom.' '.$prenom.',
          
          </span><br />
          <br />
          <br />
          Vous &ecirc;tes inscrit sur le service &quot;Alertes email&quot; de Neuville Habitat<span class="normalrouge"></span> du site www.neuville-habitat.com.</p>
          <p>Nous avons le  plaisir de vous informer que le bien suivant vient &ecirc;tre mis &agrave; jour sur le site et correspond aux crit&egrave;res enregistr&eacute;s :</p>
          <p><a href="http://www.neuville-habitat.com/alerte--'.$IDbien.'--fiche">Voir le bien concern&eacute; N&deg; '.$IDbien.'<br>
          <img src="http://www.neuville-habitat.com/photo/'.$IDbien.'.jpg" width="300" height="200" ></a><br />
              <br />
              <strong>
              <br />
              EFFACER VOS CRITERES DE RECHERCHE </strong>: <br>
              <a href="http://www.neuville-habitat.com/alertmail.php?unsubscribe='.$dest.'">Se d&eacute;sinscrire du service Alerte mail Neuville Habitat</a><br>
              <br>
            <br>
            
            <br />
          </p>
          </td>
     	 </tr>
    	</table>   	  </td>
  		</tr>
		</table>
     </body></html>
		';	

		if (mail($dest,$nom_du_site,$body,$headeradd)) { return TRUE;}
}
?>