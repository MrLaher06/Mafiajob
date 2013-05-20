<?php
/**
* @version $Id: scores.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

// On appel le fichier de configuration
require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/config.class.php' );
$config = new MafConfig();

// On appel le fichier de fonction par defauts
require_once( $mosConfig_absolute_path . '/components/com_mafiajob/mafiajob.class.php' );
$fonction = new Mafiajob();

require_once( 'components/com_mafiajob/class/equipe.class.php' );
$equipe = new MafEquipe ( $database );
$equipe->Selection();

$query = "SELECT iduser, username, equipe, argent, xp, casier, banque, actif"
. "\n FROM #__wub_personnage"
. "\n WHERE equipe != 1 ORDER BY xp DESC LIMIT 50"
;
$database->setQuery( $query );

if ( $database->loadResult() ) 
{
	$liste = $database->loadObjectList();
	
	?>
<style type="text/css">
<!--
table.tablesorter {
	background-color: #CDCDCD;
	margin:10px auto;
	width: 100%;
	color:#000000;
	text-align: left;
	font-family:Arial, Helvetica, sans-serif;
}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {
	background-color: #111111;
	background-image:url(./templates/rt_dimensions/images/menu-bg2.png);
	border: 1px solid #000000;
	font-size: 10pt;
	padding: 4px;
	color:#FF9900;
}
table.tablesorter thead tr .header {
	background-image: url(bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer;
}
table.tablesorter tbody td {
	color: #ffffff;
	padding: 4px;
	background-color:#121212;
	vertical-align: top;
}
table.tablesorter tbody tr.odd td {
	background-color:#F0F0F6;
}
table.tablesorter thead tr .headerSortUp {
	background-image: url(asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
	background-color: #c64934;
}
.blocequipe {
	border:1px solid #999999;
	width:15px;
	display:block;
	float:left;
	height:15px;
	margin-right:5px;
}
-->
</style>
<h1>Tableau des scores</h1>
<div align="justify">Cette page vous permet de connaître le score des meilleurs joueurs du jeu. Plusieurs tableaux se proposent à vous. Le premier correspond aux joueurs les plus recherchés sur le jeu, le deuxième permet lui de connaître les 50 joueurs les plus riches du jeu, qui sait peut-être vous y serez un jour. Enfin le dernier tableau correspond aux 5 meilleurs flics du jeu car il y a aussi les flics qui sont de la partie. </div>
<table class="tablesorter" border="0" cellpadding="0" cellspacing="1">
  <thead>
    <tr>
      <th></th>
      <th>Nom</th>
      <th>Mafia</th>
      <th>Argent</th>
      <th>Expérience</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
		$n = 0;
        foreach($liste as $list )
        {
    		$n++;
        ?>
          <tr>
            <td><?php echo $n; ?></td>
            <td><?php 
            if($my->id)
            {
             ?>
              <a href="index.php?option=com_comprofiler&amp;task=userProfile&amp;user=<?php echo $list->iduser; ?>&amp;Itemid=90"><?php echo $list->username; ?></a>
              <?php
            }
            else
              echo $list->username;
              
            ?>
            </td>
            <td nowrap="nowrap"><span class="blocequipe" style="background-color:<?php echo $equipe->CouleurEquipe($list->equipe); ?>;">&nbsp;</span> <?php echo $equipe->NomEquipe($list->equipe); ?></td>
            <td><?php echo number_format($list->argent + $list->banque); ?> $</td>
            <td><?php echo number_format($list->xp); ?> pts</td>
            <td><?php if($list->actif) echo '<b>Actif</b>'; else echo 'Planqu&eacute;'; ?></td>
          </tr>
        <?php
        }
        ?>
  </tbody>
</table>
<?php
}

	
?>
