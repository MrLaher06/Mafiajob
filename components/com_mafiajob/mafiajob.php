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

$CookieTask = mosGetParam( $_REQUEST, 'MafTask' );
$no_html = mosGetParam( $_REQUEST, 'no_html' );
if(!$no_html && $CookieTask && $CookieTask != 'carte' && $task != 'carte' && $task != 'avatar')
	$task = $CookieTask;
		
// On appel le fichier de configuration
require_once( $mosConfig_absolute_path . '/components/com_mafiajob/class/config.class.php' );
$config = new MafConfig();

// On appel le fichier de fonction par defauts
require_once( $mainframe->getPath( 'class' ) );
$fonction = new Mafiajob();

// On appel le fichier de traduction
require_once( $config->chemin . '/language/'.$mosConfig_lang.'.php' );

// On appel le fichier pour gerer le personnage - CLASS
require_once( $config->chemin . '/class/personnage.class.php' );
$perso = new MafPersonnage( $database );

// On appel le fichier pour gerer le temps du jeu et ses victoires - CLASS
require_once( $config->chemin . '/class/victoire.class.php' );
$jeu = new MafVictoire( $database );

require_once( $mainframe->getPath( 'front_html' ) );

if(!$no_html)
	HTML_mafiajob::entete();

if( $perso->MafSelection( $my->id ) )
{
	// On appel le fichier control.personnage pour générer le joueur principal
	require_once( $config->chemin . '/control/personnage.control.php' );
	
	// On vérifi que le joueur est en vie ou mort
	if($perso->mort)
		require_once( $config->chemin . '/control/mort.control.php' );
	
	// On vérifi que le joueur est au pénitencier ou pas
	elseif($perso->casier == 2)
		require_once( $config->chemin . '/control/penitencier.control.php' );
	
	// On vérifi que le joueur est planqué ou pas
	elseif(!$perso->actif && $task != 'avatar')
		require_once( $config->chemin . '/control/planque.control.php' );
	
	// Sinon on verifi si on appel un fichier ou pas par la variable $_GET Task	
	elseif( $task && file_exists( $config->chemin . '/control/' . $task . '.control.php' ) )
		require_once( $config->chemin . '/control/' . $task . '.control.php' );
	
	// Ou pour finir si aucun de ci-dessus on appel le fichier par defaut	
	else
		require_once( $config->chemin . '/control/' . $config->fichierdefault );
}
else
	require_once( $config->chemin . '/control/creation.control.php' );
?>