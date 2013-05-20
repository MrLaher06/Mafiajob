<?php
/**
* @version $Id: voiture.php,v 5 01/04/2008 16:00:00 akede Exp $
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

require_once( $config->chemin . '/class/journal.class.php' );
$journal = new MafJournal( $database, $perso);

//On vérifie que le personnage est équipé
if($perso->MafDelaiPlanque()) 
{
	if($persoVoiture)
		echo '<span class="note">Il n\'est pas conseillé d\'avoir une voiture pour en voler une autre.</span>';
	
	elseif( $calcul->MafJoueurVoleVoiture( ) )	// Le vole du joueur a réussi
	{
		$persoVoiture = $voiture->Retrouver( $persoInfo->idvoiture );
		
		$perso->idvoiture = $persoInfo->idvoiture;
		$perso->discretion = $persoVoiture->defense;
		$perso->rapidite = $persoVoiture->rapidite;
		$perso->reservoir = $persoInfo->reservoir;
		$perso->volevoiture++;
					
		// On gere les chance d'etre recherché par la police
		if(!rand(0,$config->chanceRecherche))
			$perso->casier = 1;
		
		$persoInfo->RetirerVoiture();
		
		// Mise a jour des différents joueurs	
		if($perso->MafUpdate() && $persoInfo->MafUpdate())
		{
			echo '<span class="info">Tu as r&eacute;ussi &agrave; voler le véhicule de ' .$persoInfo->username . '</span>';
				
			// permet l'insertion de cette action dans l'historique
			$texteHistorique = 'Vole d\'un véhicule qui appartenait à '.$persoInfo->username.', c\'est un autre joueur';	// on modifie la phrase d'origine
			$historique->MafAjout( $perso, 30, $texteHistorique );
				
			// permet l'insertion de cette action dans l'historique
			$texteHistorique = $perso->MafUserName(). ' vous a volé votre véhicule';	// on modifie la phrase d'origine
			$historique->MafAjout( $persoInfo, 42, $texteHistorique );
			
			// On distribut les points
			$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleVoitureJoueurVictoireLanceur, $config->statPointPuissanceVoleVoitureJoueurVictoireLanceur, $config->statPointIntelligenceVoleVoitureJoueurVictoireLanceur, $config->statPointVisibiliteVoleVoitureJoueurVictoireLanceur );
			
			// On distribut les points
			$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpVoleVoitureJoueurDefaiteDefense, $config->statPointPuissanceVoleVoitureJoueurDefaiteDefense, $config->statPointIntelligenceVoleVoitureJoueurDefaiteDefense, $config->statPointVisibiliteVoleVoitureJoueurDefaiteDefense );
			
			// On genere le journal
			if(rand(0,1))
				$journalImage = 'http://ima.minigao.com/l80/p87/'.$persoInfo->iduser.'.jpg';
			else
				$journalImage = $config->url . '/images/voitures/'.$persoVoiture->image;
			
			// On enregistre dans le journal				
			$journal->MafEcrire(9 , $persoInfo->username, false, false, false, $journalImage);
		}
	}
	else
	{
		echo '<span class="alert">Tu n\'as pas r&eacute;ussi &agrave; voler le véhicule de ' . $persoInfo->username . '</span>';
		
		// On distribut les points
		$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleVoitureJoueurDefaiteLanceur, $config->statPointPuissanceVoleVoitureJoueurDefaiteLanceur, $config->statPointIntelligenceVoleVoitureJoueurDefaiteLanceur, $config->statPointVisibiliteVoleVoitureJoueurDefaiteLanceur );
		
		// On distribut les points
		$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpVoleVoitureJoueurVictoireDefense, $config->statPointPuissanceVoleVoitureJoueurVictoireDefense, $config->statPointIntelligenceVoleVoitureJoueurVictoireDefense, $config->statPointVisibiliteVoleVoitureJoueurVictoireDefense );
		
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $persoInfo, 40);
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 41);
			
		// On genere le journal
		$journalImage = 'http://ima.minigao.com/l80/p87/'.$persoInfo->iduser.'.jpg';
		
		// On enregistre dans le journal				
		$journal->MafEcrire(10 , $persoInfo->username, false, false, false, $journalImage);
	}
}
else
	$html->MafErrorEquipement();
?>