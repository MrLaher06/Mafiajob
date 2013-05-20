<?php
/**
* @version $Id: attaque.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/plusieurs.class.php' );

$preparation = new MafPlusieurs( $database );

if( $preparation->MafPreparation( $perso, $persoInfo->iduser, $persoInfo->username, 1 ) )
{
	$html->PreparationAttaque();
			
	// permet l'insertion de cette action dans l'historique
	$texteHistorique = 'Préparation de l\'attaque contre '.$persoInfo->username.', un autre joueur';	// on modifie la phrase d'origine
	$historique->MafAjout( $perso, 13, $texteHistorique );
			
	// permet l'insertion de cette action dans l'historique
	$texteHistorique = 'Préparation d\'une attaque contre vous, organisé par '.$persoInfo->username;	// on modifie la phrase d'origine
	$historique->MafAjout( $persoInfo, 46, $texteHistorique );
}
else
	$html->PreparationAttaqueLouper();
?>