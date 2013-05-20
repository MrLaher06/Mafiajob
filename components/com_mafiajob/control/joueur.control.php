<?php
/**
* @version $Id: joueur.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/joueur.class.php' );
require_once( $config->chemin . '/views/joueur.html.php' );

$joueurs = new MafJoueurs ( $database );
$html = new MafJoueurHTML();

$choix = $fonction->Get( 'choix_joueur' );
$idjoueur = $fonction->Get( 'idjoueur' );

// fonction qui gere les actions contre un autre joueur
if( $choix && $idjoueur )
{
	$persoInfo = new MafPersonnage ( $database );

	if( $persoInfo->MafSelection ( $idjoueur ) )
	{
		$cheminModule = $config->chemin.'/control/joueurs/joueur_' . $choix;
		$fichierModule = $cheminModule . '/' . $choix . '.php';

		if( file_exists( $fichierModule ) )
			require_once( $fichierModule );
	}
	else
		$html->PlusLa();
}

//listing de tous les joueurs qui se trouve sur la même position
$listeJoueurs = $joueurs->SelectionTousJoueurs($perso->lat, $perso->lng);

if($listeJoueurs)
{
	foreach($listeJoueurs as $joueur)
	{	
		if($joueur->iduser != $perso->iduser)
		{
			// on affiche le detail du personnage qui n'est pas celui par default
			$persoInfo = new MafPersonnage ( $database );
			$persoInfo->MafSelection ( $joueur->iduser );
			
			$persoInfoArme = false;
			if($persoInfo->idarme)
				$persoInfoArme = $arme->Retrouver( $persoInfo->idarme );
			
			$persoInfoVoiture = false;
			if($persoInfo->idvoiture)
				$persoInfoVoiture = $voiture->Retrouver( $persoInfo->idvoiture );
			
			$html->detail( $perso, $persoInfo, true, $persoInfoArme, $persoInfoVoiture );
			
			//on cumul le nombre d'action total pour savoir combien d'action il y a en cours (voir fichier action.control.php)
			$config->action++;
		}
	}
}
?>