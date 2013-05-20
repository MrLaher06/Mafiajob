<?php
/**
* @version $Id: historique.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/views/historique.html.php' );
$htmlHistorique = new MafHistoriqueHTML();
$htmlHistorique->entete();

if( $historique->MafListe ( $perso->iduser, $config->nombreAfficherHistorique ) )
{
	foreach($historique->listeHistorique as $list )
		$htmlHistorique->detail( $list );
		
	$htmlHistorique->MafFooter ( $historique->MafFooter() );
}
else
	$htmlHistorique->aucun();
?>