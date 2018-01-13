<?php
// CALCUL DE L'EMPLACEMENT DU CURSEUR
if ($PEB<=45){$topPEB=$PEB*0.6;} //27px pour 45peb
if ($PEB>45 && $PEB<=85){$topPEB=33+($PEB-45)*0.675;} //27px pour 40peb
if ($PEB>85 && $PEB<=170){$topPEB=67+($PEB-85)*0.3176;} //27px pour 85peb
if ($PEB>170 && $PEB<=255){$topPEB=99+($PEB-170)*0.3176;} //27px pour 85peb
if ($PEB>255 && $PEB<=340){$topPEB=131+($PEB-255)*0.3176;} //27px pour 85peb
if ($PEB>340 && $PEB<=425){$topPEB=164+($PEB-340)*0.3176;} //27px pour 85peb
if ($PEB>425 && $PEB<=510){$topPEB=197+($PEB-425)*0.3176;} //27px pour 85peb
if ($PEB>510 && $PEB<=595){$topPEB=229+($PEB-510)*0.3176;} //27px pour 85peb
if ($PEB>595){$topPEB=261;}
?>

<? if ($PEB){ ?>
<div id="fond" style="margin: 40px auto 0px auto;
 position:relative; width:295px; height:295px; overflow:hidden; background-image:url(img-PEB/fond.png)">
	<div id="curseur" style="position:absolute; width:68px; height:38px; left:195px; top:<?=$topPEB?>px; background-image:url(img-PEB/curseur.png)">
		<div id="valeur" style="position:absolute; width:33px; height:17px; left:22px; top:12px" class="normalnoir" align="center"><?=$PEB?></div>
    </div>
</div>

<? } else { ?>
<div style="margin: 40px auto 0px auto; position:relative; width:295px; height:295px; overflow:hidden;"><img src="img-PEB/fond_NC.png" /></div>
<?php } ?>