<?php
/**
* @version $Id: amende.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/calculs.class.php' );
$calcul = new MafCalcul();

//On vérifie que le personnage est équipé
if( $perso->idarme && $perso->munition && $perso->MafDelaiPlanque() && $perso->MafFlic() )
{
	// on ralentit le programme pour permettre a l adversaire de se planquer
	sleep($config->tempsAmende);
	
	// on remet a jour apres le delai le joueur ciblé
	if($persoInfo->MafSelection ( $persoInfo->iduser, $perso->lat, $perso->lng ) && $persoInfo->actif)
	{
		$equipement = 1;
		
		//on verifi si le joueur ciblé est armé ou pas pour le prix de l amende
		if($persoInfo->idarme)
			$equipement++;
		
		//Calcul du prix de l amende
		$prix = ( $persoInfo->stupefiant + $persoInfo->volevoiture + $persoInfo->volearme + $persoInfo->voleargent + $persoInfo->nbrattaque ) * $equipement;
		
		//on met a jour le flic car il a le droit a son argent
		$perso->lat = $config->latitudeCommissariat;
		$perso->lng = $config->longitudeCommissariat;
		$perso->AjoutArgent( $prix );
		
		//On verifi que le joueur peux payer
		if( $prix > $persoInfo->argent )
		{
			$persoInfo->MafPrison();

			$texteHistorique = 'Tu as envoyé '.$persoInfo->username.' au pénitencier car il n\'avait pas de quoi payer l\'amende de '.number_format($prix).' $';
			$historique->MafAjout( $perso, 62, $texteHistorique );
			
			$texteHistorique = $perso->username. ' t\'a envoyé au pénitencier car tu n\'avais pas de quoi payer l\'amende de '.number_format($prix).' $';
			$historique->MafAjout( $persoInfo, 63, $texteHistorique );
					
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpAmendeJoueurVictoireLanceur, $config->statPointPuissanceAmendeJoueurVictoireLanceur, $config->statPointIntelligenceAmendeJoueurVictoireLanceur, $config->statPointVisibiliteAmendeJoueurVictoireLanceur );
					
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpAmendeJoueurDefaiteDefense, $config->statPointPuissanceAmendeJoueurDefaiteDefense, $config->statPointIntelligenceAmendeJoueurDefaiteDefense, $config->statPointVisibiliteAmendeJoueurDefaiteDefense );
			
			$html->MafDenonce( $persoInfo->username, number_format($prix) );
		}
		else
		{	
			if( $persoInfo->RetraitArgent($prix) )
			{
				$html->MafDenonceFlic( $persoInfo->username, number_format($prix) );

				$texteHistorique = 'Tu a coller une amende de '.number_format($prix).' $ à '.$persoInfo->username;
				$historique->MafAjout( $perso, 64, $texteHistorique );
				
				$texteHistorique = $perso->username. ' t\'a coller une amende de '.number_format($prix).' $';
				$historique->MafAjout( $persoInfo, 65, $texteHistorique );
					
				// On distribut les points		
				$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpAmendeJoueurDefaiteLanceur, $config->statPointPuissanceAmendeJoueurDefaiteLanceur, $config->statPointIntelligenceAmendeJoueurDefaiteLanceur, $config->statPointVisibiliteAmendeJoueurDefaiteLanceur );
						
				// On distribut les points		
				$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpAmendeJoueurVictoireDefense, $config->statPointPuissanceAmendeJoueurVictoireDefense, $config->statPointIntelligenceAmendeJoueurVictoireDefense, $config->statPointVisibiliteAmendeJoueurVictoireDefense );
			}
			else
				$html->MafError();
		}
	}
	else
		$html->PlusLa();
}
else
	$html->MafErrorEquipement();

?>
