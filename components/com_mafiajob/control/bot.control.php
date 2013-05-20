<?php
/**
* @version $Id: bot.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/bot.class.php' );
require_once( $config->chemin . '/views/bot.html.php' );

$bot = new MafBot( $database );
$html = new MafBotHTML();

$choix = $fonction->Get( 'choix_bot' );
$idbot = $fonction->Get( 'idbot' );

if( $choix && $idbot )
{
	$lebot = $bot->SelectionSimple ( $idbot );
	
	if($lebot)
	{
		$cheminModule = $config->chemin.'/control/bots/bot_' . $choix;
		$fichierModule = $cheminModule . '/' . $choix . '.php';

		// On supprime la totalité de l'action et de ses participants
		require_once( $config->chemin . '/class/plusieurs.class.php' );
		$actions = new MafPlusieurs( $database );
		$actions->MafDeleteAction( $perso->iduser , 1);

		if( file_exists( $fichierModule ) )
			require_once( $fichierModule );
			
	}
	else
		$html->PlusLa();
}

$lesBots = $bot->SelectionCase ( $perso->lat, $perso->lng );

$html->entete();

if($lesBots)
{
	$html->titreListe();
	
	foreach ( $lesBots as $list )
	{
		$sonArme = $arme->Retrouver( $list->idarme );
		$saVoiture = $voiture->Retrouver( $list->idvoiture );
		
		$html->detail ( $perso, $list, $sonArme, $saVoiture );
		
		//on cumul le nombre d'action total pour savoir combien d'action il y a en cours (voir fichier action.control.php)
		$config->action++;
	}
}
?>