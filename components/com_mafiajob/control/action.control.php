<?php
/**
* @version $Id: action.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/views/action.html.php' );
$htmlAction = new MafActionHTML();
$htmlAction->entete();

if(!$perso->MafDelaiPlanque())
	$htmlAction->DélaiPlanque();
	
require_once( $config->chemin . '/control/joueur.control.php' );
require_once( $config->chemin . '/control/bot.control.php' );
require_once( $config->chemin . '/control/batiment.control.php' );
require_once( $config->chemin . '/control/voiture.control.php' );

if($config->action > 0)
	$htmlAction->NombreAction();
else
{
	require_once( $config->chemin . '/class/drogue.class.php' );
	$drogues = new MafDrogue($database);
	$drogues->Drogue($perso->iduser);
	
	if( $drogues->timer + $config->delaiMAJDrogue < time() )
	{
		if($drogues->Vendre())
			$htmlAction->VenteDrogue();
	}
	
	$htmlAction->AucuneAction();

	require_once( $config->chemin . '/class/territoire.class.php' );
	
	$territoire = new MafTerritoire( $database );
	$territoire->MafAfficher();
	
}

?>