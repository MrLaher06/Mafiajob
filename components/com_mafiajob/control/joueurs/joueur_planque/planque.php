<?php
/**
* @version $Id: planque.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

//On vérifie que le personnage est équipé
if(  ( time() - $persoInfo->tempsplanque ) > $config->delaiPlanqueJoueur && ( time() - $persoInfo->tempsmove ) > $config->delaiPlanqueJoueur && $perso->MafFlic() ) 
{
	if($persoInfo->actif)
	{
		//on met a jour le joueur  
		$perso->xp += $config->statPointXpPlanqueur;
		$perso->MafUpdate();
		
		$persoInfo->xp += $config->statPointXpPlanquer;
		$persoInfo->entrerPlanquer();
		
		require_once( $config->chemin . '/class/plusieurs.class.php' );
	
		$purger = new MafPlusieurs( $database );
		
		// On supprime la totalité de l'action et de ses participants
		$purger->MafDeleteAction( $persoInfo->iduser , 1);
	
		$historique->MafAjout( $perso, 72 );
		$historique->MafAjout( $persoInfo, 73 );
	}
	else
		$html->PlusLa();
}
else
	$html->MafErrorEquipement();

?>
