<?php
/**
* @version $Id: denoncer.php,v 5 01/04/2008 16:00:00 akede Exp $
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

sleep($config->tempsDenonciation);

if($persoInfo->MafSelection ( $persoInfo->iduser, $perso->lat, $perso->lng) && $perso->MafDelaiPlanque() && $persoInfo->actif)
{
	if($persoInfo->casier) 
	{
		$prix = $persoInfo->argent/$config->perteArgentDenonciation;
		
		//on met a jour le flic car il a le droit a son argent
		$perso->lat = $config->latitudeCommissariat;
		$perso->lng = $config->longitudeCommissariat;
		$perso->AjoutArgent($prix);
		
		$persoInfo->argent -= $prix;

		$texteHistorique = 'Tu as envoyé '.$persoInfo->username.' au pénitencier tu as gagné '.number_format($prix).' $';
		$historique->MafAjout( $perso, 62, $texteHistorique );
		
		if($persoInfo->MafFlic())
		{
			$texteHistorique = $perso->username. ' t\'a envoyé au pénitencier car tu étais un hors la loi. Tu as perdu '.number_format($prix).' $ et tu as perdu ton titre de flic par contre ton expérience du terrain reste la même.';
			
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpDenonceJoueurDefaiteDefenseFlic, $config->statPointPuissanceDenonceJoueurDefaiteDefenseFlic, $config->statPointIntelligenceDenonceJoueurDefaiteDefenseFlic, $config->statPointVisibiliteDenonceJoueurDefaiteDefenseFlic );
		}
		else
		{
			$texteHistorique = $perso->username. ' t\'a envoyé au pénitencier car tu étais un hors la loi. Tu as perdu '.number_format($prix).' $';
			
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpDenonceJoueurDefaiteDefense, $config->statPointPuissanceDenonceJoueurDefaiteDefense, $config->statPointIntelligenceDenonceJoueurDefaiteDefense, $config->statPointVisibiliteDenonceJoueurDefaiteDefense );
		}
		
		if($persoInfo->MafFlic())
			$persoInfo->equipe = rand(2,3);
		
		$persoInfo->MafPrison();
		

		$historique->MafAjout( $persoInfo, 63, $texteHistorique );
					
		if($perso->MafFlic())
		{
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpDenonceJoueurVictoireLanceurFlic, $config->statPointPuissanceDenonceJoueurVictoireLanceurFlic, $config->statPointIntelligenceDenonceJoueurVictoireLanceurFlic, $config->statPointVisibiliteDenonceJoueurVictoireLanceurFlic );
		}
		else
		{
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpDenonceJoueurVictoireLanceur, $config->statPointPuissanceDenonceJoueurVictoireLanceur, $config->statPointIntelligenceDenonceJoueurVictoireLanceur, $config->statPointVisibiliteDenonceJoueurVictoireLanceur );
		}
		
		echo '<span class="info">';
		echo 'Tu viens d\'envoyer '.$persoInfo->username.' au pénitencier et tu t\'es fait '.number_format($prix) .' $.<br />';
		echo '<b>Ton personnage se retrouve au commissariat pour les détails administratif.</b>';
		echo '</span>';
	}
	else
	{
		if($perso->MafFlic())
		{
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpDenonceJoueurDefaiteLanceurFlic, $config->statPointPuissanceDenonceJoueurDefaiteLanceurFlic, $config->statPointIntelligenceDenonceJoueurDefaiteLanceurFlic, $config->statPointVisibiliteDenonceJoueurDefaiteLanceurFlic );
		}
		else
		{
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpDenonceJoueurDefaiteLanceur, $config->statPointPuissanceDenonceJoueurDefaiteLanceur, $config->statPointIntelligenceDenonceJoueurDefaiteLanceur, $config->statPointVisibiliteDenonceJoueurDefaiteLanceur );
		}
		
		if($persoInfo->MafFlic())
		{
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpDenonceJoueurVictoireDefenseFlic, $config->statPointPuissanceDenonceJoueurVictoireDefenseFlic, $config->statPointIntelligenceDenonceJoueurVictoireDefenseFlic, $config->statPointVisibiliteDenonceJoueurVictoireDefenseFlic );
		}
		else
		{
			// On distribut les points		
			$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpDenonceJoueurVictoireDefense, $config->statPointPuissanceDenonceJoueurVictoireDefense, $config->statPointIntelligenceDenonceJoueurVictoireDefense, $config->statPointVisibiliteDenonceJoueurVictoireDefense );
		}
	}
}
else
	$html->PlusLa();
	
?>