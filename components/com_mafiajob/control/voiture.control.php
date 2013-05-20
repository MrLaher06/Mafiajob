<?php
/**
* @version $Id: carte.control.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

$garer = $fonction->Get('garer');
$recuperer = $fonction->Get('recuperer');
$idvoitureRecuperer = $fonction->Get('idvoitureRecuperer');
$voler = $fonction->Get('voler');
$idvoitureVole = $fonction->Get('idvoitureVole');

require_once( $config->chemin . '/views/voiture.html.php' );
$htmlVoitureInfo = new MafVoitureHTML();

// Les informations sur la voiture du personnage
if( ( $perso->idvoiture && $garer ) || ( $perso->idvoiture && $recuperer && $idvoitureRecuperer ) || ( $perso->idvoiture && $voler && $idvoitureVole) )
{
	if($voiture->Garer ($perso))
	{
		$perso->RetirerVoiture();
		if($perso->MafUpdate())
		{
			$persoVoiture = false;
			$htmlVoitureInfo->Garer();
		}
	}
}

// Le joueur recupere son vehicule
if($recuperer && $idvoitureRecuperer)
{
	$persoVoiture = $voiture->Recuperer ( $idvoitureRecuperer, $perso->lat, $perso->lng, $perso->iduser );
	if($persoVoiture)
	{
		$perso->idvoiture = $persoVoiture->idvoiture;
		$perso->discretion = $persoVoiture->defense;
		$perso->rapidite = $persoVoiture->rapidite;
		$perso->reservoir = $persoVoiture->reservoir;
		if($perso->MafUpdate())
			 $htmlVoitureInfo->Recuperer();
		else
			$htmlVoitureInfo->RecupererErreur();
	}
}

// Le joueur vole le vehicule
elseif($voler && $idvoitureVole)
{
	require_once( $config->chemin . '/class/calculs.class.php' );
	$calcul = new MafCalcul();
	
	$persoVoiture = $voiture->Retrouver( $idvoitureVole );
	$somme = $calcul->MafJoueurVoleVoitureGarer( $persoVoiture );
	
	if( !$somme && $voiture->Voler ( $idvoitureVole, $perso->lat, $perso->lng) )	// Le vole du joueur a réussi
	{
		$perso->idvoiture = $persoVoiture->id;
		$perso->discretion = $persoVoiture->defense;
		$perso->rapidite = $persoVoiture->rapidite;
		$perso->reservoir = $persoVoiture->reservoir;
		
		// On gere les chance d'etre recherché par la police
		if(!rand(0,$config->chanceRecherche))
			$perso->casier = 1;
		
		if($perso->MafUpdate())
			 $htmlVoitureInfo->Voler();
		else
		{
			$persoVoiture = false;
			$htmlVoitureInfo->VolerErreur();
		}
	}
	elseif( $somme )	// Le vole du joueur a réussi
	{
		$persoVoiture = false;
		$htmlVoitureInfo->VolerLouper($somme);
	}
}

if( $persoVoiture )
	$htmlAction->GarerVoiture();

// On liste les véhicule sur la position
$listeVoitures = $voiture->ListeGarer ($perso);

if($listeVoitures)
{
	$htmlVoitureInfo->titreListeVoitureGarer();
	
	foreach( $listeVoitures as $a)
	{
		if($a)
		{
			$donnee = $voiture->Retrouver ($a->idvoiture);
			$htmlVoitureInfo->detail( $donnee, false , false, false, false, $a->reservoir);
			
			if($a->iduser == $perso->iduser)
				$htmlVoitureInfo->boutonRecuperer($a->id);
			else
				$htmlVoitureInfo->boutonVoler($a->idvoiture);
		}

	//on cumul le nombre d'action total pour savoir combien d'action il y a en cours (voir fichier action.control.php)
	$config->action++;
	}
}
?>