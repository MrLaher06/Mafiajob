<?php
/**
* @version $Id: mod_wub_flic.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $database, $mosConfig_live_site, $mosConfig_absolute_patd;

$query = "SELECT username, argent, actif, xp, iduser, casier, idvoiture, idarme ".
			 "FROM #__wub_personnage ".
			 "WHERE equipe = '1' ORDER BY argent DESC LIMIT 5 ";

$database->setQuery( $query );
$personnagesList = $database->loadObjectList();

if($personnagesList)
{
?>
<table border="0" width="100%">
    <tr>
      <td></td>
      <td><b>Nom</b></td>
      <td><b>Argent</b></td>
      <td><b>Expérience</b></td>
      <td><b>Etat de service</b></td>
      <td><b>Action</b></td>
      <td><b>Armé</b></td>
      <td><b>Mobile</b></td>
    </tr>
    <?php
		$n = 0;
        foreach($personnagesList as $list )
        {
    		$n++;
        ?>
    <tr>
      <td><?php echo $n; ?></td>
      <td><a href="index.php?option=com_comprofiler&task=userProfile&user=<?php echo $list->iduser; ?>"><?php echo $list->username; ?></a></td>
      <td><?php echo number_format($list->argent); ?> $</td>
      <td><?php echo number_format($list->xp); ?> pts</td>
      <td><?php if($list->casier) echo '<b>V&eacute;reux</b>'; else echo '<b>Exemplaire</b>'; ?></td>
      <td><?php if($list->actif) echo '<b>En service</b>'; else echo '<b>N\'est pas en service</b>'; ?></td>
      <td><?php if($list->idarme) echo '<b>Oui</b>'; else echo '<b>Non</b>'; ?></td>
      <td><?php if($list->idvoiture) echo '<b>Oui</b>'; else echo '<b>Non</b>'; ?></td>
    </tr>
    <?php
        }
        
        ?>
</table>
<?php
}
else
	echo 'Aucun inscrit.';
?>
