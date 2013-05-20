<?php
/**
* @version $Id: calcul.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafCalcul extends Mafiajob {
	
	
	
	/*
	// calcul pour l'action contre un joueur ===> fichier : action/action_lancer.php) ATTAQUE
	*/
	
	function MafAttaqueJoueur ( &$listeParticipants )
	{
		global $perso;
		
		$attaque = 0;
		$rapidite = 0;
		$puissance = 0;
		$xp = 0;
		
		foreach ($listeParticipants as $list)
		{
			if( $list->iduser != $perso->iduser )
			{
				if( $list->lat < ceil( $perso->lat + $this->rayonAttaqueJoueur )
				&& $list->lat > ceil( $perso->lat - $this->rayonAttaqueJoueur )
				&& $list->lng < ceil( $perso->lng + $this->rayonAttaqueJoueur )
				&& $list->lng > ceil( $perso->lng - $this->rayonAttaqueJoueur ) )
				{
					$participant = new MafPersonnage( $database );
					$participant->MafSelection ( $list->iduser );
				}
				else
					$participant = false;
			}
			else
				$participant = $perso;
			
			if($participant)
			{	
				$puissance += $participant->puissance;
				$xp += $participant->xp;
					
				if( $participant->munition > 0 )
				{
					$attaque += $participant->attaque;
					$participant->munition--;
				}	
				if( $participant->reservoir > 0 )
				{
					$rapidite += $participant->rapidite;
					$participant->reservoir--;
				}
				
				$participant->MafUpdate();
			}
		}
		return round( $attaque + $rapidite + $puissance + $xp );
	}
	
	
	
	/*
	// calcul pour l'action contre un joueur ===> fichier : action/action_lancer.php) DEFENSE
	*/
	
	function MafDefenseJoueur ( &$joueur )
	{
		$defense = 0;
		$rapidite = 0;
		$puissance = 0;
	
		$puissance += $joueur->puissance;
			
		if( $joueur->munition > 0 )
		{
			$defense += $joueur->defense;
			$joueur->munition--;
		}	
		if( $joueur->reservoir > 0 )
		{
			$rapidite += $joueur->rapidite;
			$joueur->reservoir--;
		}
		
		$joueur->MafUpdate();
		
		$rapidite += round( ( $rapidite * 3 ) /2 );
		
		return round( $defense + $puissance + $rapidite + $joueur->xp );
	}



	/*
	// calcul pour l'action contre un habitant ===> fichier : action/action_lancer.php) ATTAQUE
	*/
	
	function MafAttaqueBot ( &$listeParticipants )
	{
		return $this->MafAttaqueJoueur( $listeParticipants );
	}



	/*
	// calcul pour l'action contre un habitant ===> fichier : action/action_lancer.php)	DEFENSE
	*/
	
	function MafDefenseBot ( &$bot )
	{
		global $arme, $voiture;
		
		$defense = 0;
		$rapidite = 0;
		$puissance = 0;
		
		if($bot->idarme)
			$botArme = $arme->Retrouver( $bot->idarme );
	
		if($bot->idvoiture)
			$botVoiture = $voiture->Retrouver( $bot->idvoiture );
	
		$puissance += $bot->puissance;
			
		if( $bot->idarme && $bot->munition > 0 )
			$defense += $botArme->defense;
			
		if( $bot->idvoiture && $bot->reservoir > 0 )
			$rapidite += $botVoiture->rapidite;
				
		$rapidite += round( ( $rapidite * 3 ) /2 );
		
		return round( $defense + $puissance + $rapidite + $bot->xp );
	}



	/*
	// calcul pour l'action contre un batiment ===> fichier : action/action_lancer.php)
	*/
	
	function MafAttaqueBatiment ( &$listeParticipants )
	{
		global $perso;
		
		$intelligence = 0;
		$attaque = 0;
		$rapidite = 0;
		$puissance = 0;
		$xp = 0;
		
		foreach ($listeParticipants as $list)
		{
			if( $list->iduser != $perso->iduser )
			{
				if( $list->lat < ceil( $perso->lat + $this->rayonBraquageBatiment )
				&& $list->lat > ceil( $perso->lat - $this->rayonBraquageBatiment )
				&& $list->lng < ceil( $perso->lng + $this->rayonBraquageBatiment )
				&& $list->lng > ceil( $perso->lng - $this->rayonBraquageBatiment ) )
				{
					$participant = new MafPersonnage( $database );
					$participant->MafSelection ( $list->iduser );
				}
				else
					$participant = false;
			}
			else
				$participant = $perso;
			
			if($participant)
			{	
				$intelligence += $participant->intelligence;
				$puissance += $participant->puissance;
				$xp += $participant->xp;
					
				if( $participant->munition > 0 )
				{
					$attaque += $participant->attaque;
					$participant->munition--;
				}	
				if( $participant->reservoir > 0 )
				{
					$rapidite += $participant->rapidite;
					$participant->reservoir--;
				}
			}
		}
		return round( $intelligence + $attaque + $rapidite + $puissance + $xp);
	}



	/*
	// calcul pour le vole d'argent contre un bot ===> fichier : bot/bot_argent/argent.php)
	*/
	
	function MafBotVoleArgent ( &$bot )
	{
		global $perso, $voiture;
		
		$discretionJoueur = 0;
		$rapiditeBot = 0;
		
		if( $perso->reservoir > 0 )
			$discretionJoueur = $perso->discretion;
				
		if($bot->idvoiture)
		{
			$botVoiture = $voiture->Retrouver( $bot->idvoiture );
			$rapiditeBot = $botVoiture->rapidite;
		}

		$attaque = $perso->intelligence + $discretionJoueur + $perso->xp;
		$defense = $bot->puissance + $rapiditeBot + $bot->xp;		
		
		if( $attaque > $defense)
			return $attaque - $defense;
		else
			return false;
	}



	/*
	// calcul pour le vole d'arme contre un bot ===> fichier : bot/bot_arme/arme.php)
	*/
	
	function MafBotVoleArme ( &$bot )
	{
		global $perso, $voiture, $arme;
		
		$discretionJoueur = 0;
		$attaqueJoueur = 0;
		
		$defenseBot = 0;
		$rapiditeBot = 0;
		
		if( $perso->reservoir > 0 )
			$discretionJoueur = $perso->discretion;
		
		if( $perso->munition > 0 )
		{
			$attaqueJoueur = $perso->attaque;
			$perso->munition--;
		}
					
		if($bot->idarme)
		{
			$botArme = $arme->Retrouver( $bot->idarme );
			$defenseBot = $botArme->defense;
		}
		
		if($bot->idvoiture)
		{
			$botVoiture = $voiture->Retrouver( $bot->idvoiture );
			$rapiditeBot = $botVoiture->rapidite;
		}

		$attaque = $perso->intelligence + $discretionJoueur + $perso->xp + $attaqueJoueur;
		$defense = $bot->puissance + $rapiditeBot + $bot->xp + $defenseBot;		
		
		if( $attaque > $defense)
			return $attaque - $defense ;
		else
			return false;
	}



	/*
	// calcul pour le vole d'une voiture contre un bot ===> fichier : bot/bot_voiture/voiture.php)
	*/
	
	function MafBotVoleVoiture ( &$bot )
	{
		global $perso, $voiture, $arme;
		
		$discretionJoueur = 0;
		$rapiditeJoueur = 0;
		$attaqueJoueur = 0;

		$defenseBot = 0;
		$rapiditeBot = 0;
		$discretionBot = 0;
		
		if( $perso->reservoir > 0 )
			$discretionJoueur = $perso->discretion;
		
		if( $perso->munition > 0 )
		{
			$attaqueJoueur = $perso->attaque;
			$perso->munition--;
		}
					
		if($bot->idarme)
		{
			$botArme = $arme->Retrouver( $bot->idarme );
			$defenseBot = $botArme->defense;
		}
		
		if($bot->idvoiture)
		{
			$botVoiture = $voiture->Retrouver( $bot->idvoiture );
			$rapiditeBot = $botVoiture->rapidite;
			$discretionBot = $botVoiture->defense;
		}

		$attaque = $perso->intelligence + $discretionJoueur + $perso->xp + $rapiditeJoueur + $attaqueJoueur;
		$defense = $bot->puissance + $rapiditeBot + $bot->xp + $defenseBot + $discretionBot;		
		
		if( $attaque > $defense)
			return $attaque - $defense ;
		else
			return false;
	}



	/*
	// calcul pour le vole d'argent contre un autre joueur ===> fichier : joueurs/joueur_argent/argent.php)
	*/
	
	function MafJoueurVoleArgent ( )
	{
		global $perso, $voiture, $persoInfo;
		
		$discretionJoueur = 0;
		$rapiditeInfoJoueur = 0;
		
		if( $perso->reservoir > 0 )
		{
			$discretionJoueur = $perso->discretion;
			$perso->reservoir--;
		}
				
		if($persoInfo->idvoiture)
		{
			$InfoJoueurVoiture = $voiture->Retrouver( $persoInfo->idvoiture );
			$rapiditeInfoJoueur = $InfoJoueurVoiture->rapidite;
			$persoInfo->reservoir--;
		}

		$attaque = $perso->intelligence + $discretionJoueur + $perso->xp;
		$defense = $persoInfo->puissance + $rapiditeInfoJoueur + $persoInfo->xp;		
		
		if( $attaque > $defense)
			return $attaque - $defense;
		else
			return false;
	}



	/*
	// calcul pour le vole d'arme contre un autre joueur ===> fichier : joueurs/joueur_arme/arme.php)
	*/
	
	function MafJoueurVoleArme ( )
	{
		global $perso, $voiture, $arme, $persoInfo;
		
		$discretionJoueur = 0;
		$attaqueJoueur = 0;
		
		$defenseInfoJoueur = 0;
		$rapiditeInfoJoueur = 0;
		
		if( $perso->reservoir > 0 )
		{
			$discretionJoueur = $perso->discretion;
			$perso->reservoir--;
		}
		
		if( $perso->munition > 0 )
		{
			$attaqueJoueur = $perso->attaque;
			$perso->munition--;
		}
					
		if( $persoInfo->idarme && $persoInfo->munition > 0 )
		{
			$InfoJoueurArme = $arme->Retrouver( $persoInfo->idarme );
			$defenseInfoJoueur = $InfoJoueurArme->defense;
			$persoInfo->munition--;
		}
		
		if( $persoInfo->idvoiture && $persoInfo->reservoir > 0 )
		{
			$InfoJoueurVoiture = $voiture->Retrouver( $persoInfo->idvoiture );
			$rapiditeInfoJoueur = $InfoJoueurVoiture->rapidite;
			$persoInfo->reservoir--;
		}

		$attaque = $perso->intelligence + $discretionJoueur + $perso->xp + $attaqueJoueur;
		$defense = $persoInfo->puissance + $rapiditeInfoJoueur + $persoInfo->xp + $defenseInfoJoueur;		
		
		if( $attaque > $defense)
			return $attaque - $defense ;
		else
			return false;
	}

	/*
	// calcul pour le vole d'une voiture contre un autre joueur ===> fichier : joueurs/joueur_voiture/voiture.php)
	*/
	
	function MafJoueurVoleVoiture ( )
	{
		global $perso, $voiture, $arme, $persoInfo;
		
		$discretionJoueur = 0;
		$rapiditeJoueur = 0;
		$attaqueJoueur = 0;

		$defenseInfoJoueur = 0;
		$rapiditeInfoJoueur = 0;
		$discretionInfoJoueur = 0;
		
		if( $perso->reservoir > 0 )
		{
			$discretionJoueur = $perso->discretion;
			$perso->reservoir--;
		}
		
		if( $perso->munition > 0 )
		{
			$attaqueJoueur = $perso->attaque;
			$perso->munition--;
		}
					
		if( $persoInfo->idarme && $persoInfo->munition > 0 )
		{
			$InfoJoueurArme = $arme->Retrouver( $persoInfo->idarme );
			$defenseInfoJoueur = $InfoJoueurArme->defense;
			$persoInfo->munition--;
		}
		
		if( $persoInfo->idvoiture && $persoInfo->reservoir > 0 )
		{
			$InfoJoueurVoiture = $voiture->Retrouver( $persoInfo->idvoiture );
			$rapiditeInfoJoueur = $InfoJoueurVoiture->rapidite;
			$discretionInfoJoueur = $InfoJoueurVoiture->defense;
			$persoInfo->reservoir--;
		}

		$attaque = $perso->intelligence + $discretionJoueur + $perso->xp + $rapiditeJoueur + $attaqueJoueur;
		$defense = $persoInfo->puissance + $rapiditeInfoJoueur + $persoInfo->xp + $defenseInfoJoueur + $discretionInfoJoueur;		
		
		if( $attaque > $defense)
			return $attaque - $defense ;
		else
			return false;
	}

	/*
	// calcul pour le vole d'une voiture d'une voiture garée
	*/
	
	function MafJoueurVoleVoitureGarer ( $voiture )
	{
		global $perso;

		$attaque = $perso->intelligence + $perso->visibilite;
		$defense = $voiture->defense + $voiture->puissance + $voiture->rapidite;		
		
		if( $attaque+1000 > $defense)
			return false;
		else
			return $defense - $attaque;
	}
	
	
	
	/*
	// Mise a jour des stats ATTAQUE
	*/
	
	function MafMAJAttaqueJoueur ( &$listeParticipants, $argent = 0, $xp = 0, $puissance = 0, $intelligence = 0, $visibilite = 0, $xpParticipant = 0, $puissanceParticipant = 0, $intelligenceParticipant = 0, $visibiliteParticipant = 0 )
	{
		global $perso;
		
		$argent = round( $argent / ( count($listeParticipants) + 1 ));
		
		foreach ($listeParticipants as $list)
		{
			if( $list->iduser != $perso->iduser )
			{
				if( $list->lat < ceil( $perso->lat + $this->rayonAttaqueJoueur )
				&& $list->lat > ceil( $perso->lat - $this->rayonAttaqueJoueur )
				&& $list->lng < ceil( $perso->lng + $this->rayonAttaqueJoueur )
				&& $list->lng > ceil( $perso->lng - $this->rayonAttaqueJoueur ) )
				{
					$participant = new MafPersonnage( $database );
					$participant->MafSelection ( $list->iduser );
					
					$participant->xp += $xpParticipant;
					$participant->puissance += $puissanceParticipant;
					$participant->intelligence += $intelligenceParticipant;
					$participant->visibilite += $visibiliteParticipant;
					$participant->argent += $argent;
					$participant->nbrattaque++;

					$participant->MafUpdate();
				}
			}
			else
			{	
				$perso->xp += $xp;
				$perso->puissance += $puissance;
				$perso->intelligence += $intelligence;
				$perso->visibilite += $visibilite;
				$perso->argent += round( $argent * 2 );
				$perso->nbrattaque++;

				$perso->MafUpdate();
			}
		}
	}
	
	
	
	/*
	// Mise a jour des stats DEFENSE
	*/
	
	function MafMAJDefenseJoueur ( &$joueur, $xp = 0, $puissance = 0, $intelligence = 0, $visibilite = 0 )
	{
		$joueur->xp += $xp;
		$joueur->puissance += $puissance;
		$joueur->intelligence += $intelligence;
		$joueur->visibilite += $visibilite;
				
		if($joueur->MafUpdate())
			return true;
		else
			return false;
		
	}
}
	
?>