<?php
/**
* @version $Id: discuter.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

if($lebot->discuter != 0 )
{
	require_once( $cheminModule . '/discuter.class.php' );

	$discution = new MafDiscutionBot( );
	
	$bot->discution ();
	
	$message = $discution->MafMessage( $lebot->discuter );

	echo '<span class="info"><b>' . $lebot->nom . '</b> : '.$message. '</span>';
			
	// permet l'insertion de cette action dans l'historique
	$texteHistorique = 'Discution avec un habitant du coin, il a raconté : " '.$message.' " ';	// on modifie la phrase d'origine
	$historique->MafAjout( $perso, 24, $texteHistorique );
}
else
	echo '<span class="alert">Ce bot ne désire pas discuter avec toi</span>';
	
?>