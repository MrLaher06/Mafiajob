<?php
/**
* @version $Id: argent.php,v 5 01/04/2008 16:00:00 akede Exp $
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
	if($persoInfo->actif)
	{
		
		if(  $calcul->MafJoueurVoleArgent( ) )	// Le vole du autre joueur a réussi
		{
			$prix = round( $persoInfo->argent / $config->deviseurVoleArgent );
			$perso->voleargent++;
						
			// On gere les chance d'etre recherché par la police
			if(!rand(0,$config->chanceRecherche))
				$perso->casier = 1;
		
			if( $perso->AjoutArgent( $prix ) && $persoInfo->RetraitArgent( $prix ) )
			{
				echo '<span class="info">Tu as r&eacute;ussi &agrave; voler '.number_format($prix).' $ &agrave; '.$persoInfo->username.'.</span>';
				
				// permet l'insertion de cette action dans l'historique
				$texteHistorique = 'Vole d\'argent contre '.$persoInfo->username.', un autre joueur. Gain du vole : '.number_format($prix).' $';	// on modifie la phrase d'origine
				$historique->MafAjout( $perso, 28, $texteHistorique );
		
				// permet l'insertion de cette action dans l'historique
				$texteHistorique = $perso->MafUserName(). ' vous a volé . Vos pertes : '.number_format($prix).' $';	// on modifie la phrase d'origine
				$historique->MafAjout( $persoInfo, 37, $texteHistorique );
				
				// On distribut les points		
				$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleArgentJoueurVictoireLanceur, $config->statPointPuissanceVoleArgentJoueurVictoireLanceur, $config->statPointIntelligenceVoleArgentJoueurVictoireLanceur, $config->statPointVisibiliteVoleArgentJoueurVictoireLanceur );
				
				// On distribut les points
				$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpVoleArgentJoueurDefaiteDefense, $config->statPointPuissanceVoleArgentJoueurDefaiteDefense, $config->statPointIntelligenceVoleArgentJoueurDefaiteDefense, $config->statPointVisibiliteVoleArgentJoueurDefaiteDefense );
				
				// On genere le journal
				$journalImage = 'http://ima.minigao.com/l80/p87/'.$persoInfo->iduser.'.jpg';
				
				// On enregistre dans le journal				
				$journal->MafEcrire(9 , $persoInfo->username, false, false, false, $journalImage);
				
				$persoInfo->MafReplacer();
			}
		}
		else
		{
			echo '<span class="alert">Tu n\'as pas r&eacute;ussi &agrave; lui voler son argent.</span>';
			
			// On distribut les points
			$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleArgentJoueurDefaiteLanceur, $config->statPointPuissanceVoleArgentJoueurDefaiteLanceur, $config->statPointIntelligenceVoleArgentJoueurDefaiteLanceur, $config->statPointVisibiliteVoleArgentJoueurDefaiteLanceur );
			
			// On distribut les points
			$calcul->MafMAJDefenseJoueur ( $persoInfo, $config->statPointXpVoleArgentJoueurVictoireDefense, $config->statPointPuissanceVoleArgentJoueurVictoireDefense, $config->statPointIntelligenceVoleArgentJoueurVictoireDefense, $config->statPointVisibiliteVoleArgentJoueurVictoireDefense );
			
			// permet l'insertion de cette action dans l'historique
			$historique->MafAjout( $persoInfo, 38);
			// permet l'insertion de cette action dans l'historique
			$historique->MafAjout( $perso, 39);
				
			// On genere le journal
			$journalImage = 'http://ima.minigao.com/l80/p87/'.$persoInfo->iduser.'.jpg';
			
			// On enregistre dans le journal				
			$journal->MafEcrire(10 , $persoInfo->nom, false, false, false, $journalImage);
		}
	}
	else
		$html->PlusLa();
}
else
	$html->MafErrorEquipement();
		
?>