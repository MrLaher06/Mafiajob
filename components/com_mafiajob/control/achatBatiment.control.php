<?php
/**
* @version $Id: achatBatiment.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/batiment.class.php' );

$batiments = new MafBatiment ( $database );
$batiment = $batiments->SelectionSimple( $perso->lat, $perso->lng );

if( $batiment )
{
	require_once( $config->chemin . '/views/achatBatiment.html.php' );

	$html = new MafAchatBatimentHTML ();
	
	$acheter = $fonction->Get('acheter');
	$vendre = $fonction->Get('vendre');
	$prixAchater = $fonction->Get('prixAchat');

	// Si on decide d'acheter un batiment
	if( $acheter && $batiment->proprio != $perso->iduser && $batiment->prix_achat)
	{
		$prix = $batiment->prix_achat;
		
		if( !empty( $prixAchater ) && $prixAchater > $prix )
			$prix = $prixAchater;
			
		// On verifi les moyen du joueur en argent
		if( $perso->RetraitArgent( $prix ) )
		{
			// Mise a jour du batiment et du joueur
			$batiment->proprio = $perso->iduser;
			$batiment->proprio_equipe = $perso->equipe;
			$batiment->timer = time();
			$batiment->prix_achat += $prix * ( $config->pourcentageValeurAchatBatiment / 100 );
			$batiments->MafUpdate();
			$html->Feliciation( $prix );
			
			// Permet l'insertion de cette action dans l'historique
			$texteHistorique = $fonction->MafSprintf(_ACHAT_BAT , array('a' => $batiment->nom, 'b' => number_format($prix) ) );
			$historique->MafAjout( $perso, 3, $texteHistorique );
		}
		else
			$html->Argent();
	}
	
	// On decide de vendre le batiment
	elseif($vendre && $batiment->proprio == $perso->iduser )
	{
		// On calcul le prix de vente
		$prix = round( $batiment->prix_achat / $config->diviseurPrixVente );
		
		// On mais a jour le joueur au niveau argent	
		if( $perso->AjoutArgent( $prix ) )
		{
			// On met a jour le joueur en stat si option valide
			$delaiOption = floor( ( (time() - $batiment->timer) / 60 / 60 ) / 24 );
			
			if( !$delaiOption && !empty( $batiment->option ) && $batiments->MafTypeVente( $batiment->option ))
			{
				$typeOtion = $config->nomOptionBatiment[ $batiments->MafTypeVente( $batiment->option ) ];
				$pointOtion = round( $batiments->MafOptionVente( $batiment->option ) * $delaiOption );
				// Selon l'option on met a jour le joueur				
				$perso->$typeOtion += $pointOtion;
				$perso->MafUpdate();
			
				// Permet l'insertion de cette action dans l'historique
				$texteHistorique = $fonction->MafSprintf(_VENTE_HISTORIQUE_BAT , array('a' => number_format( $pointOtion ), 'b' => $typeOtion ) );
				$historique->MafAjout( $perso, 66, $texteHistorique );
			}

			// Mise a jour bu batiment
			$batiment->proprio = 0;
			$batiment->proprio_equipe = 0;
			$batiment->timer = 0;
			$batiments->MafUpdate();
			$html->Revente( $prix );
			
			// Permet l'insertion de cette action dans l'historique
			$texteHistorique = $fonction->MafSprintf(_VENTE_BAT , array('a' => $batiment->nom, 'b' => number_format($prix) ) );
			$historique->MafAjout( $perso, 4, $texteHistorique );
		}
		else
			$html->ErreurArgent();
	}
	
	// Partie présentation et formulaire
	if( $batiment->proprio != $perso->iduser )
	{				
		$proprio = false;
		
		if( $batiment->proprio )
		{
			$proprio = new MafPersonnage ( $database );
			$proprio->MafSelection ( $batiment->proprio );
		}
	
		$html->EnteteAchat();
		$html->PresentationAchat( $batiment, $proprio );
		$html->FormulaireAchat();
	}
	else
	{
		$html->EnteteGestion();		
		$html->PresentationGestion( $batiment ,$batiments->MafOptionVente( $batiment->option ), $batiments->MafTypeVente( $batiment->option ) );
		$html->FormulaireRevente();
	}

	$html->Lien();
}
else
	require_once( $config->chemin . '/control/' . $config->fichierdefault );
?>