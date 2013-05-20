<?php
/**
* @version $Id: information.control.php,v 5 01/04/2008 16:00:00 akede Exp $
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

$iduserInfo = $fonction->Get('iduser');

//si c'est les informations d'un autre personnage
if($iduserInfo)
{
	$persoInfo = new MafPersonnage ( $database );
	$persoInfo->MafSelection ( $iduserInfo );
	$infoVoiture = false;
	$infoArme = false;
	
	// On recherche l'arme du personnage
	$arme->Liste();
	if($persoInfo->idarme)
		$infoArme = $arme->Retrouver( $persoInfo->idarme );

	// On recherche la voiture du personnage
	$voiture->Liste();
	if($persoInfo->idvoiture)
		$infoVoiture = $voiture->Retrouver( $persoInfo->idvoiture );
	
	// on affiche le detail du personnage qui n'est pas celui par default
	if( $persoInfo->id && ( $persoInfo->equipe == $perso->equipe || $perso->MafFlic() ) )	
		$html->detailAutre($persoInfo);
}
//si c'est les informations du compte personnage
else
{
	if( $fonction->Get('commentaire') )
	{
		$perso->commentaire = $fonction->Get('commentaire');
		
		if($perso->MafUpdate())
			$html->MAJCommentaire();
	}
		
	$persoInfo = $perso;
	$infoArme = $persoArme;
	$infoVoiture = $persoVoiture;

	// on affiche le detail du personnage qui est par default
	$html->detail($persoInfo, $my);
	
	// on affiche l'humeur du personnage qui est par default
	$html->humeur( $perso->commentaire );
	$html->MafSeparateur();
	
	require_once( $config->chemin . '/class/mission.class.php' );
	$mission = new MafMission( $database );
	
	if( $mission->MafSelection ( $perso->iduser ) )
	{
		echo $mission->MafTitreMission ( );
		$html->MafSeparateur();
	}
}

// Les informations sur l arme du personnage
if($infoArme && $persoInfo->equipe == $perso->equipe)
{
	require_once( $config->chemin . '/views/arme.html.php' );
	$htmlArmeInfo = new MafArmeHTML();
	$htmlArmeInfo->detail($infoArme);
	
	$html->MafSeparateur();
}

// Les informations sur les voitures du personnage
if($infoVoiture && $persoInfo->equipe == $perso->equipe)
{
	require_once( $config->chemin . '/views/voiture.html.php' );
	$htmlVoitureInfo = new MafVoitureHTML();
	$htmlVoitureInfo->detail($infoVoiture, true, false, false, true);
	
	$html->MafSeparateur();
}

// Les informations sur les voitures garer du personnage
$ListeVehiculeJoueur = $voiture->ListeVehiculeJoueur ($perso->iduser);
if($ListeVehiculeJoueur && $persoInfo->iduser == $perso->iduser)
{
	if(!isset($htmlVoitureInfo))
	{
		require_once( $config->chemin . '/views/voiture.html.php' );
		$htmlVoitureInfo = new MafVoitureHTML();
	}
	
	$htmlVoitureInfo->titreListeVoitureGarerJoueur();
	
	foreach( $ListeVehiculeJoueur as $a)
	{
		if($a)
			$htmlVoitureInfo->vignetteVehicule( $voiture->Retrouver ($a->idvoiture), $a->reservoir, $a->lat, $fonction->ConvertLng ($a->lng));
	}
	$htmlVoitureInfo->titreListeVoitureGarerJoueurPied();
	$html->MafSeparateur();
}

// Les informations sur les batiments du personnage	
require_once( $config->chemin . '/class/batiment.class.php' );
$MesProprio = new MafBatiment ( $database );

$vosBatiments = false;

if($persoInfo->id && $persoInfo->equipe == $perso->equipe)
	$vosBatiments = $MesProprio->SelectionProprio ( $persoInfo->iduser );

if( $vosBatiments )
{
	require_once( $config->chemin . '/views/batiment.html.php' );
	$htmlBatiment = new MafBatimentHTML ();
	$htmlBatiment->ListeDeVosBatiment();
	
	foreach( $vosBatiments as $list )
		$htmlBatiment->presentation ( $list , $MesProprio->SelectionMeilleurProtection ( ) , $list->prix_achat, false, false);
}
?>