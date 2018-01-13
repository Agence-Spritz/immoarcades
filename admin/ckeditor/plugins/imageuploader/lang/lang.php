<?php
// checking lang value
if(isset($_COOKIE['sy_lang'])) {
    $load_lang_code = $_COOKIE['sy_lang'];

    $lang_code = $_COOKIE['sy_lang'];
    switch ($lang_code) {
        case "en":
            $lang_name = "English";
            break;
        case "fr":
            $lang_name = "Français";
            break;
    }
} else {
    $load_lang_code = "fr";
    
    $lang_name = "Français";
}

// including lang files
switch ($load_lang_code) {
    case "en":
        require(__DIR__ . '/en.php');
        break;
    case "fr":
        require(__DIR__ . '/fr.php');
        break;
}
?>

<div id="setLangDiv" class="lightbox popout">
    <br><br>
    <h3 class="settingsh3"><?php echo $langpanel1; ?></h3>
        <p class="uploadP" onclick="selectLang('fr');"><img src="img/cd-icon-french.png" class="headerIcon"> Français</p>
		<p class="uploadP" onclick="selectLang('en');"><img src="img/cd-icon-english.png" class="headerIcon"> English</p>
    <br>
    <?php if(!isset($_COOKIE['sy_lang'])) { ?>
        <h3 class="settingsh3" style="font-size:12px;font-weight:lighter;">Langue par défaut <span style="font-weight:bolder;">Français</span>. Vous pouvez modifier la langue dans les paramètres</h3>
    <?php } else { ?>
        <h3 class="settingsh3" style="font-size:12px;font-weight:lighter;"><?php echo $langpanel2; ?> <span style="font-weight:bolder;"><?php echo $lang_name; ?></span></h3>
    <?php } ?>
    <br>
    <?php if(!isset($_COOKIE['sy_lang'])) { ?>
        <h3 class="settingsh3" style="font-size:12px;font-weight:bolder;color:#4183D7;" onclick="selectLang('fr');">Fermer</h3>
    <?php } else { ?>
        <h3 class="settingsh3" style="font-size:12px;font-weight:bolder;color:#4183D7;" onclick="$('#setLangDiv').hide(); $('#background4').slideUp(250, 'swing');"><?php echo $langpanel3; ?></h3>
    <?php } ?>
    <br><br>
</div>

<?php
if(!isset($_COOKIE['sy_lang'])) { ?>
    <script>
        $("#setLangDiv").show();
        $("#background4").slideDown(250, "swing");
    </script>
<?php }