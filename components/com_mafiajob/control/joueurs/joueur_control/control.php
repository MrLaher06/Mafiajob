<?php
/**
* @version $Id: control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

//On vérifie que le personnage est équipé
if( $perso->idarme && $perso->munition && $perso->MafDelaiPlanque() && $perso->MafFlic()) 
{
	// on ralentit le programme pour permettre a l adversaire de se planquer
	sleep($config->tempsControlRoutine);
	
	// on remet a jour apres le delai le joueur ciblé
	if($persoInfo->MafSelection ( $persoInfo->iduser, $perso->lat, $perso->lng ) && $persoInfo->actif)
	{
		//on met a jour le flic 
		$perso->lat = $config->latitudeCommissariat;
		$perso->lng = $config->longitudeCommissariat;
		$perso->MafUpdate();
		
		//on met a jour le joueur  
		$persoInfo->lat = $config->latitudeCommissariat;
		$persoInfo->lng = $config->longitudeCommissariat;
		$persoInfo->RetirerArme();
		$persoInfo->MafUpdate();

		$historique->MafAjout( $perso, 68 );
		$historique->MafAjout( $persoInfo, 68 );
	}
	else
		$html->PlusLa();
}
else
	$html->MafErrorEquipement();

?>
