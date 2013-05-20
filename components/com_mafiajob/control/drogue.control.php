<?php
/**
* @version $Id: mafiajob.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/drogue.class.php' );
require_once( $config->chemin . '/views/drogue.html.php' );

$drogues = new MafDrogue($database);
$drogues->Drogue($perso->iduser);

$acheter = $fonction->Get( 'validedrogue' );

$html = new MafDrogueHTML();

if($acheter)
{
	$acheterF = $drogues->Acheter();
	if($acheterF == 1)
	{
		if( $perso->MafUpdate() )
		{
			$historique->MafAjout( $perso, 11 ); // permet l'insertion de cette action dans l'historique
			$html->AchatReussi();
		}
	}
	elseif($acheterF == 2)
		$html->ChangementPrix();
	else
		$html->ErreurAchat();
}

$html->entete();
$html->tableau($drogues, $perso->argent);
?>