<?php
/**
* @version $Id: deposer.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

if($perso->MafReplacer() && $lebot->taxi == 1)
{
	echo '<span class="info">Tu viens de changer de position.</span>';
			
	// permet l'insertion de cette action dans l'historique
	$historique->MafAjout( $perso, 23 );
}
else
	echo '<span class="alert">Tu n\'as pas pu changer de position</span>';
	
?>