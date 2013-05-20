<?php
global $jeu, $database, $mosConfig_absolute_path; 

if(empty($jeu))
{
	require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/config.class.php' );
	$config = new MafConfig();
	
	// On appel le fichier de fonction par defauts
	require_once($mosConfig_absolute_path .'/components/com_mafiajob/mafiajob.class.php');
	$fonction = new Mafiajob();
	
	// On appel le fichier pour gerer le temps du jeu et ses victoires - CLASS
	require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/victoire.class.php' );
	$jeu = new MafVictoire( $database );

}
?>
<center>
 <img src="<?php echo $mosConfig_live_site; ?>/modules/mod_wub_images/horloge.png" align="top" alt="horloge" /> Cette partie finira le : <span class="Stylecompteur"><?php echo strftime("%A %d %B %Y - %H:%M:%S",$jeu->delai()); ?> </span> - <span id="comptarebour" class="Stylecompteur"> </span>
</center>
<script language="JavaScript" type="text/javascript">
<!--
function Rebour()
{
	if (document.getElementById)
	{
		Maintenant = new Date;
		TempMaintenant = Maintenant.getTime();
		Future = new Date(<?php echo strftime("%Y",$jeu->delai()); ?>, <?php echo strftime("%m",$jeu->delai()); ?>, <?php echo strftime("%d",$jeu->delai()); ?>, <?php echo strftime("%H",$jeu->delai()); ?>, <?php echo strftime("%M",$jeu->delai()); ?>, <?php echo strftime("%S",$jeu->delai()); ?>);
		TempFuture = <?php echo $jeu->delai()*1000; ?>;
		DinaHeure = Math.floor((TempFuture-TempMaintenant)/1000);
		DinaHeure = "" + DinaHeure;
		if (DinaHeure <= 0)
		DinaHeure = "0";
		
		var j=Math.floor(DinaHeure/3600/24); // récupere le nb de jour
		DinaHeure=DinaHeure % (3600*24);
		
		var h=Math.floor(DinaHeure / 3600); // recupère le nb d'heure
		DinaHeure=DinaHeure % 3600;
		
		var m=Math.floor(DinaHeure/60); // récupère le nb minute
		DinaHeure=DinaHeure % 60
		
		var s=Math.floor(DinaHeure);
		
		var txt = j+" j "+h+" h "+m+" min et "+s+" sec"; 
		
		document.getElementById("comptarebour").innerHTML= txt;
	}
	temporebour = setTimeout("Rebour()", 1000)
}
Rebour();
-->
</script>
