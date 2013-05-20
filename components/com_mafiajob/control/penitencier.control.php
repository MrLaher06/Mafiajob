<?php
/**
* @version $Id: penitencier.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/penitencier.class.php' );
require_once( $config->chemin . '/views/penitencier.html.php' );

$penitencier = new MafPenitencier();
$html = new MafPenitencierHTML();

$tempPasse = time() - $perso->tempsplanque;
$tempsTotal = $penitencier-> heurePrison( $perso->xp );

if( $tempPasse >= $tempsTotal)
{
	$perso->MafSortirPrison();
	echo '<span class="info">Tu viens de sortir de prison.</span>';
	require_once( $config->chemin . '/control/' . $config->fichierdefault );
}
else
	$html->entete( $tempPasse , $tempsTotal );

require_once( $config->chemin . '/class/plusieurs.class.php' );
	
$action = new MafPlusieurs( $database );

// cette partie sert pour l'historique du joueur
if( $action->MafDeleteAction( $perso->iduser , 1) )
	$historique->MafAjout( $perso, 36 );
?>