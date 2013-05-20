<?php
/**
* @version $Id: mod_wub_ajax.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

define( '_VALID_MOS', 1 );

header('Content-Type: text/html; charset=ISO-8859-1');

require( '../globals.php' );
require_once( '../configuration.php' );
require_once( '../includes/joomla.php' );

$option 	= strtolower( strval( mosGetParam( $_REQUEST, 'option' ) ) );
$Itemid 	= intval( mosGetParam( $_REQUEST, 'Itemid', 0 ) );

$mainframe = new mosMainFrame( $database, $option, '.' );
$mainframe->initSession();

$my = $mainframe->getUser();

$mainframe->detect();

$gid = intval( $my->gid );

// On appel le fichier de configuration
require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/config.class.php' );
$config = new MafConfig();

// On appel le fichier de fonction par defauts
require_once( $config->chemin . '/mafiajob.class.php' );
$fonction = new Mafiajob();

// On appel le fichier de traduction
require_once( $config->chemin . '/language/'.$mosConfig_lang.'.php' );

// On appel le fichier pour gerer le personnage - CLASS
require_once( $config->chemin . '/class/personnage.class.php' );
$perso = new MafPersonnage( $database );

if($perso->MafSelection( $my->id ))
	require_once( $config->chemin . '/control/personnage.control.php' );

// On appel le fichier pour gerer le temps du jeu et ses victoires - CLASS
require_once( $config->chemin . '/class/victoire.class.php' );
$jeu = new MafVictoire( $database );

?>