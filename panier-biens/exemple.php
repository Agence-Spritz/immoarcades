<?php

// Compteur de MaSelection 
$xpldSelection=explode("-",$_COOKIE['likeimmo-selection']);
$NbrSelection=count($xpldSelection)-1;

// DEFINIT "Ajouter" ou "Supprimer" au chargement de la page
if (!stristr($_COOKIE['likeimmo-selection'],$id )){
	$msgSelection='<i class="fa fa-plus" style="color:#16bdef"></i> Comparer ce bien';
	$selectID="OK";
} else {
	$msgSelection='<i class="fa fa-close" style="color:#CC0000"></i> Ne plus comparer ce bien';
	$selectID="NO";
}
?>

 <span style="float:left; font-size:14px; text-decoration:underline; margin:15px 15px ">
							<div class="AddMaselection"><?=($selectID=="OK")?($msgSelection):('')?></div> 
							<div class="DelMaselection"><?=($selectID=="NO")?($msgSelection):('')?></div>
</span>
                        

<!-- BOUTON COMPARER --> 
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
	/*Message ajouter ou supprimer + cookie update*/
	$('.AddMaselection').click(function(){
		$.post('inc/MaSelectionCookie.php',{addselection:'<i class="fa fa-close" style="color:#CC0000"></i> Ne plus comparer ce bien', selectID:'OK-<?=$id?>', NbrSelection:<?=$NbrSelection?>},
		function(data){
			$('.DelMaselection').html(data),
			$('.AddMaselection').html('')
			$('.SelectionCompteur').html(<?=($selectID=="OK")?($NbrSelection+1):($NbrSelection)?>)/*Compteur*/
		});
	})
                                    
	$('.DelMaselection').click(function(){
		$.post('inc/MaSelectionCookie.php',{addselection:'<i class="fa fa-plus" style="color:#16bdef"></i> Comparer ce bien', selectID:'NO-<?=$id?>', NbrSelection:<?=$NbrSelection?>},
		function(data){
			$('.AddMaselection').html(data),
			$('.DelMaselection').html(''),
			$('.SelectionCompteur').html(<?=($selectID=="NO")?($NbrSelection-1):($NbrSelection)?>)/*Compteur*/
		});
	})
</script>