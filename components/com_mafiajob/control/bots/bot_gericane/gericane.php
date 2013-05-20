<?php
/**
* @version $Id: gericane.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

if( ( $lebot->reservoir > 0 && $perso->idvoiture != 0 && $perso->reservoir <= $config->minimumEssence ) || ( $lebot->reservoir > 0 && $perso->MafFlic() && $perso->idvoiture != 0 && $perso->reservoir <= ( $config->minimumEssence * 2 ) ) )
{
	$perso->reservoir += $lebot->reservoir;
	if($perso->MafUpdate())
	{
		echo '<span class="info">' . $lebot->nom . ' vient de te donner ' . $lebot->reservoir . ' L d\'essence pour ton véhicule.</span>';
			
		// permet l'insertion de cette action dans l'historique
		$texteHistorique = 'Un habitant du coin a donné ' . $lebot->reservoir . ' L d\'essence pour ton véhicule';	// on modifie la phrase d'origine
		$historique->MafAjout( $perso, 25, $texteHistorique );
	}
}
else
	echo '<span class="alert">' . $lebot->nom . ' n\'a pas d\'essence pour toi.</span>';
?>