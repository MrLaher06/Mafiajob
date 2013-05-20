<?php
/**
* @version $Id: tunnel.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

$tunnel = $fonction->Get('tunnel');

if($tunnel) 
{
	
	$sql = "SELECT `lat`, `lng`, `nom` FROM `#__wub_batiments` WHERE `option` = 'tunnel' AND ( `lat` != '".$perso->lat."' OR `lng` != '".$perso->lng."' ) ORDER BY RAND() LIMIT 1";
	$database->setQuery( $sql );
	$tunnels = $database->loadObjectList();	
		
	if($tunnels)
	{
		$tunnel = $tunnels[0];
	
		if( $perso->argent < $config->prixPassageTunnel)
			echo '<span class="alert">Tu manques d\'argent, c\'est '.$config->prixPassageTunnel.' $ mec !</span>';
		else
		{
			$perso->lat = $tunnel->lat;
			$perso->lng = $tunnel->lng;
			$perso->argent -= $config->prixPassageTunnel;
			$perso->MafUpdate();
			echo '<span class="info">';
			echo 'Tu viens de prendre le tunnel : <b>' . $tunnel->nom .'</b>, ';
			echo 'tu te retrouve donc en : <b>'.$fonction->ConvertLng($perso->lng).' - '.$perso->lat.'</b>.';
			echo '</span>';
			
			// permet l'insertion de cette action dans l'historique
			$historique->MafAjout( $perso, 20 );
		}
	}
}

?>

<h2>Pour changer rapidement de quartier</h2>
<img src="<?php echo $config->url;?>/images/peage.jpg" alt="peage" height="100" align="left" style="margin:10px;" class="imgBlock">
<p align="justify" style="margin:10px;">Tu as la possibilité de prendre ce tunnel, ce qui te permettra de resortir vers un autre tunnel et de te faire traverser la carte rapidement, mais le péage coute <b><?php echo $config->prixPassageTunnel;?> $</b>. Le petit probl&egrave;me avec eux, c'est qu'on sait jamais o&ugrave; on va. Ce qui veut dire que si on cherche &agrave; aller &agrave; un endroit pr&eacute;cis, ne soyez pas &eacute;tonn&eacute; de voir votre argent r&eacute;duire.</p>
<form name="form1" method="post" action="">
  <input type="button" onclick="conteneur('<?php echo $config->lienAjaxTask; ?>', 'tunnel=true');" name="tunnel" value="Prendre le tunnel pour <?php echo $config->prixPassageTunnel;?> $" class="buttonMaf"  />
</form>
