<?php
/**
* @version $Id: munition.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

if( $persoInfo->munition < $config->minimumMunition && $perso->idarme && !$perso->MafFlic() && $perso->munition > $config->minimumMunition && $perso->equipe == $persoInfo->equipe ) 
{
	$perso->munition -= $config->minimumMunition;
	$persoInfo->munition += $config->minimumMunition;
	
	$perso->MafUpdate();
	$persoInfo->MafUpdate();
	
	$texteHistorique = 'Ton personnage vient de donner ' . $config->minimumMunition . ' munition(s) à ' . $persoInfo->username;
	$texteHistorique2 = $perso->username.' vient de vous donner ' . $config->minimumMunition . ' munition(s)';
	
	echo '<span class="info">' . $texteHistorique . '</span>';
	
	$historique->MafAjout( $perso, 60, $texteHistorique );
	$historique->MafAjout( $persoInfo, 61, $texteHistorique2 );
}
else
	echo '<span class="alert">Tu ne peux pas fournir ' . $persoInfo->username . ' en munition</span>';
?>