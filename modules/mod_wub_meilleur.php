<?php
/**
* @version $Id: mod_wub_meilleur.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $database, $mosConfig_live_site, $mosConfig_absolute_path;

$query = "SELECT username, iduser, argent, banque, actif, equipe, xp ".
			 "FROM #__wub_personnage ".
			 "WHERE equipe != '1' ORDER BY xp DESC LIMIT 1 ";

$database->setQuery( $query );
$personnages = $database->loadObjectList();

if($personnages)
{
	$meilleur = $personnages[0];
	
	// On appel le fichier de configuration
	require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/config.class.php' );
	$config = new MafConfig();
	
	// On appel le fichier de fonction par defauts
	require_once( $mosConfig_absolute_path . '/components/com_mafiajob/mafiajob.class.php' );
	$fonction = new Mafiajob();
	
	require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/equipe.class.php' );
	$equipe = new MafEquipe ( $database );
	$equipe->Selection();
	
	
	?>
    <h3><?php echo $meilleur->username;?></h3>
    
	<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td align="left" valign="top" ><img src="http://ima.minigao.com/l80/p87/<?php echo $meilleur->iduser; ?>.jpg" alt="Photo" height="80" width="67" style="border:1px solid #999999; margin:2px; padding:5px; background-color:<?php echo $equipe->CouleurEquipe($meilleur->equipe); ?>;background-image:url(./modules/mod_wub_images/fondAvatar.png);background-position:center; background-repeat:no-repeat;" />        </td>
	    <td align="left" valign="top" ><img class="imgBlock" title="Equipe" src="components/com_mafiajob/images/mafia/<?php echo $equipe->ImageEquipe($meilleur->equipe); ?>" alt="Portrait" height="80" width="67" style="border:1px solid #999999; margin:2px; padding:5px; background-color:<?php echo $equipe->CouleurEquipe($meilleur->equipe); ?>" /></td>
	    <td align="left" valign="top" ><?php echo $equipe->NomEquipe($meilleur->equipe); ?><br />Xp : <?php echo number_format($meilleur->xp);?> pts<br /><?php echo number_format($meilleur->argent + $meilleur->banque);?> $</td>
	  </tr>
</table> 
<?php
}
else
	echo 'Aucun inscrit.';
?>
