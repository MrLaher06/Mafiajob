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

if( ( $persoInfo->reservoir < $config->minimumEssence && $persoInfo->idvoiture  && $perso->idvoiture  && $perso->reservoir > $config->minimumEssence && $perso->equipe == $persoInfo->equipe ) || $perso->MafFlic() ) 
{
	$perso->reservoir -= $config->minimumEssence;
	$persoInfo->reservoir += $config->minimumEssence;
	
	$perso->MafUpdate();
	$persoInfo->MafUpdate();
	
	$texteHistorique = 'Ton personnage vient de donner un géricane de ' . $config->minimumEssence . ' L à ' . $persoInfo->username;
	$texteHistorique2 = $perso->username.' vient de vous donner un géricane de ' . $config->minimumEssence . ' L';
	
	echo '<span class="info">' . $texteHistorique . '</span>';
	
	$historique->MafAjout( $perso, 58, $texteHistorique );
	$historique->MafAjout( $persoInfo, 59, $texteHistorique2 );
}
else
	echo '<span class="alert">Tu ne peux pas fournir ' . $persoInfo->username . ' en essence</span>';
?>