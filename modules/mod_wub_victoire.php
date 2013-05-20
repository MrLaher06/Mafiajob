<?php
/**
* @version $Id: mod_wub_victoire.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );


global $database;
		
$database->setQuery("SELECT * FROM #__wub_victoire WHERE idequipe != '0' ORDER BY id DESC LIMIT 1");
$partiesVictoire = $database->loadObjectList();

if($partiesVictoire)
{
	$vict = $partiesVictoire[0];
	?>

<ul class="number">
  <li class="bullet-5"><b>Date</b> : <?php echo utf8_decode ( mosFormatDate ($vict->date_victoire, '%A %d %B %Y - %H:%M') ); ?></li>
  <li class="bullet-5"><b>Capital total de l'équipe </b> : <?php echo number_format($vict->argent); ?> $</li>
  <li class="bullet-5"><b>Nom de l'équipe</b> : <?php echo $vict->nomequipe; ?></li>
  <li class="bullet-5"><b>Pseudo du chef de l'&eacute;quipe</b> : <?php echo $vict->username; ?></li>
</ul>
<?php
}
else
	echo 'Aucune victoire sur ce jeu pour le moment.';
?>
