<?php
/**
* @version $Id: historique.html.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafHistoriqueHTML {
	
	function entete ( ) 
	{
		global $config;
		?>
		<h1>Historique de votre personnage</h1>
        <span class="note">Vous avez la possibilité de voir les dernières action de votre personnage.</span>
		<?php
	}
	
	function detail ( &$list ) 
	{
		global $fonction;
		
		?>
        <h2><?php echo $fonction->MafDate($list->date); ?></h2>
        <blockquote>
        Position : <?php echo $fonction->ConvertLng( $list->lng ); ?> - <?php echo $list->lat; ?><br /><?php echo $list->texte; ?>
        </blockquote>
		<?php
	}
	
	function MafFooter ( &$nav) 
	{
		global $config;
		
		echo '<form action="'.$config->lienTask.'" method="post" name="adminForm">';
		echo $nav; 
		echo '</form><br />';
	}
	
	function aucun ( ) 
	{
		?>
		<span class="note">Vous n'avez pas encore d'historique.</span>
		<?php
	}
}
?>
