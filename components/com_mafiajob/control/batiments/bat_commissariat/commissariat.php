<?php
/**
* @version $Id: commissariat.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/flic.class.php' );
$flics = new MafFlic( $database );
	
require_once( $config->chemin . '/views/joueur.html.php' );
$htmlFlicJoueur = new MafJoueurHTML();

require_once($config->chemin .'/control/batiments/bat_commissariat/commissariat.html.php');
$htmlFlic = new MafFlicHTML();

// Si on est déjà flic	
if($perso->MafFlic())
{
	$choix = $fonction->Get('choix');

	$htmlFlic->titre1();

	if($choix == 'nbrattaque' )
	{
		$htmlFlic->titre2();
		$htmlFlic->revenir();
		listing ( $flics->MafToptype ( 'nbrattaque' ) );
	}
	elseif($choix == 'stupefiant' )
	{
		$htmlFlic->titre3();
		$htmlFlic->revenir();
		listing ( $flics->MafToptype ( 'stupefiant' ) );
	}
	elseif($choix == 'voleargent' )
	{
		$htmlFlic->titre4();
		$htmlFlic->revenir();
		listing ( $flics->MafToptype ( 'voleargent' ) );
	}
	elseif($choix == 'volearme' )
	{
		$htmlFlic->titre5();
		$htmlFlic->revenir();
		listing ( $flics->MafToptype ( 'volearme' ) );
	}
	elseif($choix == 'volevoiture' )
	{
		$htmlFlic->titre6();
		$htmlFlic->revenir();
		listing ( $flics->MafToptype ( 'volevoiture' ) );
	}
	elseif($choix == 'voitures' )
	{
		$htmlFlic->revenir();
		require_once($config->chemin .'/control/batiments/bat_voiture/voiture.php');
	}
	elseif($choix == 'armes' )
	{
		$htmlFlic->revenir();
		require_once($config->chemin .'/control/batiments/bat_arme/arme.php');
	}
	else
		$htmlFlic->menu();
}

$listesFlics = $flics->MafSelection ();

$nbrFlics = count($listesFlics);

if( $fonction->Get('devenirpolice') && $nbrFlics <= $config->nbrFlicJeu && !$perso->MafFlic() && !$perso->casier && $perso->iduser != $equipe->ChefEquipe($perso->equipe))
{
	$perso->equipe = 1;
	if($perso->MafUpdate())
	{
		$htmlFlic->flicReussi();
		$listesFlics = $flics->MafSelection ();
		$nbrFlics = count($listesFlics);
		$historique->MafAjout( $perso, 67 );
	}
	else
		$htmlFlic->flicEchec();
		
}
elseif( $fonction->Get('devenirpolice') )
	$htmlFlic->flicEchec();

// formualire d embauche
if( $nbrFlics <= $config->nbrFlicJeu && !$perso->MafFlic() )
	$htmlFlic->embauche ( $nbrFlics );
	
$htmlFlic->titre7();

if( $nbrFlics > 0 )
{
	foreach( $listesFlics as $list )
	{
		$sonArme  = false;
		$sonVoiture  = false;
		
		if($list->idarme)
			$sonArme = $arme->Retrouver( $list->idarme );
		
		if($list->idvoiture)
			$sonVoiture = $voiture->Retrouver( $list->idvoiture );
			
		$htmlFlicJoueur->detail ( $perso, $list, false , $sonArme, $sonVoiture );
	}
}
else
	echo '<span class="alert">Il n\'y a aucun flic pour le moment dans la ville de Mafia City.</span>';



function listing ( &$liste )
{
	global $htmlFlicJoueur, $arme, $voiture, $perso;
	
	foreach( $liste as $list )
	{
		$sonArme  = false;
		$sonVoiture  = false;
		
		if($list->idarme)
			$sonArme = $arme->Retrouver( $list->idarme );
		
		if($list->idvoiture)
			$sonVoiture = $voiture->Retrouver( $list->idvoiture );
			
		$htmlFlicJoueur->detail ( $perso, $list, false , $sonArme, $sonVoiture );
	}
}
?>
