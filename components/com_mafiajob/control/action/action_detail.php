<?php
/**
* @version $Id: action_detail.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

// Si on prepare une action contre un joueur
if( $detailAction->type == 1) 
{
	require_once( $config->chemin . '/views/joueur.html.php' );

	$htmlJoueur = new MafJoueurHTML();

	$joueurDefense = new MafPersonnage ( $database );
	$joueurDefense->MafSelection ( $detailAction->iddefense );
	
	$htmlJoueur->detail( $perso, $joueurDefense, false );
}


// Si on prepare une action contre un établissement
elseif( $detailAction->type == 2)	
{
	require_once( $config->chemin . '/class/batiment.class.php' );
	
	$batiments = new MafBatiment ( $database );
	$batiment = $batiments->SelectionSimple( false, false, $detailAction->iddefense);

	if($batiment)
	{
		$MeilleurProtection =  $batiments->SelectionMeilleurProtection ( );
		$prixAchatBatiment = $batiment->prix_achat;
		
		require_once( $config->chemin . '/views/batiment.html.php' );
		
		$htmlBatiment = new MafBatimentHTML();
		$htmlBatiment->entete();
		$htmlBatiment->presentation($batiment, $MeilleurProtection, $prixAchatBatiment, false, false);
	} 
}


// Si on prepare une action contre un bot (habitant)
elseif( $detailAction->type == 3)
{
	require_once( $config->chemin . '/class/bot.class.php' );
	
	$bot = new MafBot( $database );
	$lebot = $bot->SelectionSimple ( $detailAction->iddefense );
		
	if($lebot)
	{	
		$sonArme = $arme->Retrouver( $lebot->idarme );
		$saVoiture = $voiture->Retrouver( $lebot->idvoiture );
		
		require_once( $config->chemin . '/views/bot.html.php' );
		
		$htmlBot = new MafBotHTML();
		$htmlBot->detail ( $perso, $lebot, $sonArme, $saVoiture, false );
	}
}
?>