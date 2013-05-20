<?php
/**
* @version $Id: arme.php,v 5 01/04/2008 16:00:00 akede Exp $
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
	if( $calcul->MafJoueurVoleArme( ) )	// Le vole d'arme du autre joueur a réussi
	{
		$persoArme = $arme->Retrouver( $persoInfo->idarme );
		
		$perso->idarme = $persoInfo->idarme;
		$perso->attaque = $persoArme->attaque;
		$perso->defense = $persoArme->defense;
		$perso->munition = $persoInfo->munition;
		$perso->volearme++;
		
		$persoInfo->RetirerArme();
			
		if($perso->MafUpdate() && $persoInfo->MafUpdate())
		{
			echo '<span class="info">Tu as r&eacute;ussi &agrave; voler l\'arme de ' . $persoInfo->username . '</span>';
				
			// permet l'insertion de cette action dans l'historique
			$texteHistorique = 'Vole de l\'arme qui appartenait à '.$persoInfo->username.', un autre joueur';	// on modifie la phrase d'origine
			$historique->MafAjout( $perso, 29, $texteHistorique );
				
			// permet l'insertion de cette action dans l'historique
			$texteHistorique = $perso->MafUserName(). ' vous a volé votre arme';	// on modifie la phrase d'origine
			$historique->MafAjout( $persoInfo, 45, $texteHistorique );
			
			// On distribut les points
			$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleArmeJoueurVictoireLanceur, $config->statPointPuissanceVoleArmeJoueurVictoireLanceur, $config->statPointIntelligenceVoleArmeJoueurVictoireLanceur, $config->statPointVisibiliteVoleArmeJoueurVictoireLanceur );
			
			// On distribut les points
			$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpVoleArmeJoueurDefaiteDefense, $config->statPointPuissanceVoleArmeJoueurDefaiteDefense, $config->statPointIntelligenceVoleArmeJoueurDefaiteDefense, $config->statPointVisibiliteVoleArmeJoueurDefaiteDefense );
			
			// On genere le journal
			if(rand(0,1))
				$journalImage = 'http://ima.minigao.com/l80/p87/'.$persoInfo->iduser.'.jpg';
			else
				$journalImage = $config->url . '/images/armes/'.$persoArme->image;
			
			// On enregistre dans le journal				
			$journal->MafEcrire(9 , $persoInfo->username, false, false, false, $journalImage);	
		}
	}
	else
	{
		echo '<span class="alert">Tu n\'as pas r&eacute;ussi &agrave; voler l\'arme de ' . $persoInfo->username . '</span>';
		
		// On distribut les points
		$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleArmeJoueurDefaiteLanceur, $config->statPointPuissanceVoleArmeJoueurDefaiteLanceur, $config->statPointIntelligenceVoleArmeJoueurDefaiteLanceur, $config->statPointVisibiliteVoleArmeJoueurDefaiteLanceur );
		
		// On distribut les points
		$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpVoleArmeJoueurVictoireDefense, $config->statPointPuissanceVoleArmeJoueurVictoireDefense, $config->statPointIntelligenceVoleArmeJoueurVictoireDefense, $config->statPointVisibiliteVoleArmeJoueurVictoireDefense );
		
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $persoInfo, 43);
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 44);
			
		// On genere le journal
		$journalImage = 'http://ima.minigao.com/l80/p87/'.$persoInfo->iduser.'.jpg';
		
		// On enregistre dans le journal				
		$journal->MafEcrire(10 , $persoInfo->username, false, false, false, $journalImage);
	}
}
else
	$html->MafErrorEquipement();
	
?>