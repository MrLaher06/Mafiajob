<?php
/**
* @version $Id: action.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafActionHTML {
	
	function entete ( ) 
	{
		global $config, $perso, $jeu;
		?>
<h1>Les actions de votre personnage <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>');" title="Pour réactualiser que la partie ci-dessous"><img src="<?php echo $config->url;?>/images/refresh.png" alt="Actualiser" /></a></h1>
<?php
		if($perso->casier && $perso->MafFlic() )
			echo '<span class="alert">ATTENTION tu es devenu un flic véreux, Ils autres joueurs peuvent te dénoncer s\'ils tombent sur toi.</span>';
		elseif($perso->casier )
			echo '<span class="alert">ATTENTION vous êtes recherché par les flics! pensez à faire des faux papiers</span>';
	}
	
	function NombreAction ( ) 
	{
		global $config;
		?>
<span class="note">Tu as <?php echo $config->action; ?> action(s) possible en ce moment.</span>
<?php
	}
	
	function DélaiPlanque ( ) 
	{
		global $config;
		?>
<span class="note" id="SortiePlanque">Tu viens de sortir de ta planque il y a moins de <?php echo $config->delaiPlanqueAction; ?> secondes, ce qui veut dire que l'action que tu pourrais faire maintenant est impossible. Tu dois attendre que le délai soit effectué mais attention de ne pas te faire attaquer pendant ce temps.</span>
<?php
	MafActionHTML::disparition ('SortiePlanque', 10);
	}
	
	function AucuneAction ( ) 
	{
		?>
<span class="note" id="aucuneAction">Pour le moment, aucune action n'est possible pour ton personnage.</span>
<?php
	MafActionHTML::disparition ('aucuneAction', 3);
	}
	
	function VenteDrogue ( ) 
	{
		?>
<span class="info" id="textDealer">Ton personnage vient de rencontrer un mec qui désire de la drogue.<br />
Si tu en as sur toi, tu peux lui en vendre (cette action se fait automatiquement)</span>
<?php
	MafActionHTML::disparition ('textDealer', 10);
	}
	
	function GarerVoiture ( ) 
	{
		global $config;
		?>
<span class="info">Tu as la possibilité de garer ta voiture <a href="javascript:;" onclick="conteneur('<?php echo $config->lienAjax; ?>', 'garer=true');" title="garer sa voiture">Cliquer ici</a></span>
<?php
	}
	function disparition ($div, $time = 5)
	{
	?>
  <script language="javascript" type="text/javascript">
  <!--
  delaiDisparait('<?php echo $div; ?>',<?php echo $time; ?>);
  -->
  </script>
  <?php
	}
}
?>
