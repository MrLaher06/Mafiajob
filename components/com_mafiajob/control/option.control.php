<?php
/**
* @version $Id: option.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/update.class.php' );
			
if($fonction->Get( 'fileupdate' ))
{			
	$dossier = $config->chemin .'/images/avatars/update';

	$up = new Upload($dossier, $config->typeFichierUpdate, $config->poidFichierUpdate);
	
	$fichier = $up->uploading();
	
	if($fichier)
	{									
		$perso->image = 'update/'.$fichier;
		$perso->MafUpdate();
		echo '<span class="info">Image envoy&eacute;e et personnage actualisé</span>';
		echo '<span class="note">L\'équipe de Mafia City se réserve le droit de supprimer votre image en cas de non respect des règles.</span>';
	}
	else
		echo '<span class="alert">Erreur, respectez la taille et le poids de votre image.</span>';
}
elseif( $fonction->Get( 'parrainer' ) && $fonction->Get( 'valideparrainage' ) )
{
	$message = $perso->username.' d&eacute;sire vous parrainer au jeu Mafiajob.fr, un jeu de r&ocirc;le sur la Mafia.<br />'."\n";
	$message .= 'Lors de la cr&eacute;ation de votre personnage sur le jeu, veuillez indiquer le num&eacute;ro suivant dans la case N&deg; parrainage : <br /><br />'."\n";
	$message .= '<b>'.$perso->iduser.'</b><br /><br />'."\n";
	$message .= 'Si vous atteignez les 50 points d\'exp&eacute;riences avec votre futur personnage, '.$perso->username.' aura la chance de gagner 5 points suppl&eacute;mentaires d\'exp&eacute;rience.'."\n";
	
	$parrainer = $fonction->Get( 'parrainer' );

	if( $fonction->MafMailEnvois($parrainer, $message, $perso->username.' vous invite à participer au jeu Mafiajob') )
		echo '<span class="info">Tu viens d\'envoyer une invitation à : '.$parrainer.'</span>';
	else
		echo '<span class="alert">Erreur lors de l\'envois du parainnage.</span>';
	
}
		
require_once( $config->chemin . '/views/option.html.php' );
new MafOptionHTML( );

require_once( $config->chemin . '/views/update.html.php' );
new MafUpdateHTML('Votre avatar personnel');

require_once( $config->chemin . '/views/parrainage.html.php' );
new MafParrainageHTML();

?>