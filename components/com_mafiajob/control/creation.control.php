<?php
/**
* @version $Id: creation.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/views/personnage.html.php' );
$html = new MafPersonnageHTML();

if( $fonction->Mafip( $_SERVER['REMOTE_ADDR'] ) )
	$html->CreationIP();
	
elseif($fonction->Get( 'validepersonnage' ) && $fonction->Get( 'majeur' ) )
{
	$perso->equipe = rand(2,3);
	$perso->image = $fonction->Get( 'choixavatar' );
	$perso->parrainage = $fonction->Get( 'parrainage' );
	$perso->lat = rand (1,26);
	$perso->lng = rand (1,26);
	$perso->tempsmove = time();
	$perso->tempsplanque = time();
	$perso->iduser = $my->id;
	$perso->username = $my->username;
	$perso->argent = $config->creationPersonnageArgent;
	$perso->vie = $config->creationPersonnageVie;
	$perso->ip = $_SERVER['REMOTE_ADDR'];
	
	$perso->MafAleatoire();
	
	if($perso->parrainage == $my->id)
		$perso->parrainage = false;
	
	$perso->Mafinsert();
	
	require_once( $config->chemin . '/class/drogue.class.php' );
	
	$drogues = new MafDrogue($database);
	$drogues->iduser = $my->id;
	$drogues->Mafinsert();
	
	$html->CreationReussie();

	// On appel le fichier control.personnage pour générer le joueur principal
	require_once( $config->chemin . '/control/personnage.control.php' );
	$perso->MafReplacer();
	
	// On vérifi que le joueur est planqué ou pas
	if(!$perso->actif)
		require_once( $config->chemin . '/control/planque.control.php' );
	
	// Sinon on verifi si on appel un fichier ou pas par la variable $_GET Task	
	elseif( $task && file_exists( $config->chemin . '/control/' . $task . '.control.php' ) )
		require_once( $config->chemin . '/control/' . $task . '.control.php' );
	
	// Ou pour finir si aucun de ci-dessus on appel le fichier par defaut	
	else
		require_once( $config->chemin . '/control/' . $config->fichierdefault );
}
else
{
	$html->creation();
}
?>