<?php
/**
* @version $Id: action_lancer.php,v 5 01/04/2008 16:00:00 akede Exp $
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

require_once( $config->chemin . '/class/victoireCarte.class.php' );
$victoireCarte = new MafVictoireCarte( $database );

// Si on prepare une action contre un joueur
if( $detailAction->type == 1) 
{
	$joueurDefense = new MafPersonnage ( $database );
	
	// On selection le personnage qu'on attaque
	if( $joueurDefense->MafSelection ( $detailAction->iddefense, $perso->lat, $perso->lng ) )
	{
		// On vérifie que le joueur attaqué est actif
		if( $joueurDefense->actif == 1 )
		{
			// On calcul des scrore des 2 parties
			$resultatAttaque = $calcul->MafAttaqueJoueur( $listeParticipants );
			$resultatDefense = $calcul->MafDefenseJoueur( $joueurDefense );
			
			//On défini qui a gagné
			if( $resultatAttaque > $resultatDefense )	//VICTOIRE POUR L'ATTAQUANT
			{
				$score = $resultatAttaque - $resultatDefense;	// On calcul la différence pour le retrait de vie
				
				$html->VictoireAction( $score );
				
				// On gere ce que gagne et perd les 2 parties	
				if(!rand(0,$config->chanceperdreAttaque))
					$joueurDefense->RetirerArme();
				
				// On gere les chance d'etre recherché par la police
				if(!rand(0,$config->chanceRecherche) || $joueurDefense->MafFlic())
					$perso->casier = 1;
				
				// On determine si le joueur attaquer est de même niveau et on distribut les points	
				if( $resultatAttaque < ( $resultatDefense * $config->statPointRationDifference ) )
					$calcul->MafMAJAttaqueJoueur ( $listeParticipants, ceil( $joueurDefense->argent / $config->statPointRationDiviseurArgentJoueur ) , $config->statPointXpAttaqueVitoireLanceur, $config->statPointPuissanceAttaqueVitoireLanceur, $config->statPointIntelligenceAttaqueVitoireLanceur, $config->statPointVisibiliteAttaqueVitoireLanceur, rand(1,2) );
				else
					$calcul->MafMAJAttaqueJoueur ( $listeParticipants, ceil( $joueurDefense->argent / $config->statPointRationDiviseurArgentJoueur ) );
				
				// On retire la vie du joueur attaqué
				$joueurDefense->vie -= $resultatAttaque - $resultatDefense;
				// On retire l'argent /x du joueur attaqué car redistribué au(x) attaquant(s)
				$joueurDefense->argent /= $config->statPointRationDiviseurArgentJoueur;
				//On planque le joueur pour eviter les habut
				$joueurDefense->entrerPlanquer();
				// On replace le joueur
				$joueurDefense->MafReplacer();

				// On distribut les points	
				$calcul->MafMAJDefenseJoueur ( $joueurDefense, $config->statPointXpDefenseDefaite, $config->statPointPuissanceDefenseDefaite, $config->statPointIntelligenceDefenseDefaite, $config->statPointVisibiliteDefenseDefaite );
				
				// Permet l'insertion de cette action dans l'historique
				$historique->MafAjout( $perso, 47 );
				
				// Permet l'insertion de cette action dans l'historique
				$historique->MafAjout( $joueurDefense, 48 );
				
				// On genere le journal
				$journalImage = 'http://ima.minigao.com/l80/p87/'.$joueurDefense->iduser.'.jpg';
				
				$lequipe = false;
				
				if(rand(0,1))
					$lequipe = $joueurDefense->equipe;
				
				// On enregistre dans le journal				
				$journal->MafEcrire(1 , $joueurDefense->username, false, $lequipe, $joueurDefense->argent, $journalImage);
				
				$victoireCarte->Mafinsert( $perso );
					
			}
			else // DEFAITE POUR L'ATTAQUANT ET VICTOIRE POUR LA DEFENSE
			{
				$html->DefaiteAction( $resultatDefense - $resultatAttaque );

				// On gere ce que gagne et perd les 2 parties	
				$perso->vie -= $resultatDefense - $resultatAttaque;
				
				// On distribut les points	
				$calcul->MafMAJAttaqueJoueur ( $listeParticipants, 0, $config->statPointXpAttaqueDefaiteLanceur, $config->statPointPuissanceAttaqueDefaiteLanceur, $config->statPointIntelligenceAttaqueDefaiteLanceur, $config->statPointVisibiliteAttaqueDefaiteLanceur, $config->statPointXpAttaqueDefaiteParticipant, $config->statPointPuissanceAttaqueDefaiteParticipant, $config->statPointIntelligenceAttaqueDefaiteParticipant, $config->statPointVisibiliteAttaqueDefaiteParticipant );

				// Une chance sur x de perdre l'arme
				if(!rand(0,$config->chanceperdreAttaque))
					$perso->RetirerArme();
					
				// On distribut les points		
				$calcul->MafMAJDefenseJoueur ( $joueurDefense, rand( $config->statPointXpDefenseVictoireMin, $config->statPointXpDefenseVictoireMax), rand( $config->statPointPuissanceDefenseVictoireMin, $config->statPointPuissanceDefenseVictoireMax ) );
				
				// Permet l'insertion de cette action dans l'historique
				$historique->MafAjout( $perso, 49 );
				
				// Permet l'insertion de cette action dans l'historique
				$historique->MafAjout( $joueurDefense, 50 );
				
				// On genere le journal
				$journalImage = 'http://ima.minigao.com/l80/p87/'.$joueurDefense->iduser.'.jpg';
				$lequipe = false;
				
				if(rand(0,1))
					$lequipe = $joueurDefense->equipe;
				
				// On enregistre dans le journal				
				$journal->MafEcrire(2 , $joueurDefense->username, false, $lequipe, false, $journalImage );
				
				$victoireCarte->Mafinsert( $joueurDefense );
			}
		
			// cette partie sert a retirer les action du defenseur
			if( $actions->MafDeleteAction( $joueurDefense->iduser , 1) )
				$historique->MafAjout( $joueurDefense, 69  );
		}
		else
			$html->PlanqueAction();
	}
	else
		$html->AutrePositionAction();
}


// Si on prepare une action contre un établissement
elseif( $detailAction->type == 2)	
{
	require_once( $config->chemin . '/class/batiment.class.php' );
	
	$batiments = new MafBatiment ( $database );
	$batiment = $batiments->SelectionSimple( false, false, $detailAction->iddefense);
	
	if($batiment)
	{
		// On calcul les score de l'attaque au total
		$resultat = $calcul->MafAttaqueBatiment( $listeParticipants );
				
		// On gere les chance d'etre recherché par la police
		if(!rand(0,$config->chanceRecherche))
			$perso->casier = 1;

		// On compare avec la défense du batiment
		if( $resultat > $batiment->protection )
		{
			$html->VictoireAction( $resultat - $batiment->protection );
			$gainReussi = $batiment->coffre;
			$batiment->coffre += round( $batiment->coffre / 10 );
			$batiment->protection += round( $resultat + ( $batiment->protection / 10 ) );
			$batiments->MafUpdate ( );
			
			// On distribut les points	
			$calcul->MafMAJAttaqueJoueur ( $listeParticipants, $gainReussi, $config->statPointXpEtablissementVitoireLanceur, $config->statPointPuissanceEtablissementVitoireLanceur, $config->statPointIntelligenceEtablissementVitoireLanceur, $config->statPointVisibiliteEtablissementVitoireLanceur,$config->statPointXpEtablissementVitoireParticipant, $config->statPointPuissanceEtablissementVitoireParticipant, $config->statPointIntelligenceEtablissementVitoireParticipant, $config->statPointVisibiliteEtablissementVitoireParticipant );
			
			// Permet l'insertion de cette action dans l'historique
			$historique->MafAjout( $perso, 51 );
				
			// On genere le journal	
			$journalImage = $config->url.'/images/batiments/'.$batiment->image;		
			// On enregistre dans le journal				
			$journal->MafEcrire(3 , $batiment->nom, false, false, $gainReussi, $journalImage);
		}
		else
		{
			// On distribut les points	
			$calcul->MafMAJAttaqueJoueur ( $listeParticipants, 0, $config->statPointXpEtablissementDefaiteLanceur, $config->statPointPuissanceEtablissementDefaiteLanceur, $config->statPointIntelligenceEtablissementDefaiteLanceur, $config->statPointVisibiliteEtablissementDefaiteLanceur,$config->statPointXpEtablissementDefaiteParticipant, $config->statPointPuissanceEtablissementDefaiteParticipant, $config->statPointIntelligenceEtablissementDefaiteParticipant, $config->statPointVisibiliteEtablissementDefaiteParticipant );
			$html->DefaiteAction( $batiment->protection - $resultat);
			
			// Permet l'insertion de cette action dans l'historique
			$historique->MafAjout( $perso, 52 );
				
			// On genere le journal	
			$journalImage = $config->url.'/images/batiments/'.$batiment->image;		
			// On enregistre dans le journal				
			$journal->MafEcrire(4 , $batiment->nom, false, false, false, $journalImage);
			
			$victoireCarte->Mafinsert( $perso );
		}
		
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
		$resultatAttaque = $calcul->MafAttaqueBot( $listeParticipants );
		$resultatDefense = $calcul->MafDefenseBot( $lebot );
			
		if( $resultatAttaque > $resultatDefense )
		{
			$score = $resultatAttaque - $resultatDefense;
				
			// On gere les chance d'etre recherché par la police
			if(!rand(0,$config->chanceRecherche))
				$perso->casier = 1;
		
			$html->VictoireAction( $score );
			
			// On distribut les points
			if( ceil($resultatDefense * 10) > $resultatAttaque && $lebot->xp > ceil( $perso->xp - 20 ) )	
			$calcul->MafMAJAttaqueJoueur ( $listeParticipants, $lebot->argent , $config->statPointXpBotVitoireLanceur, $config->statPointPuissanceBotVitoireLanceur, $config->statPointIntelligenceBotVitoireLanceur, $config->statPointVisibiliteBotVitoireLanceur,$config->statPointXpBotVitoireParticipant, $config->statPointPuissanceBotVitoireParticipant, $config->statPointIntelligenceBotVitoireParticipant, $config->statPointVisibiliteBotVitoireParticipant );
			elseif( $lebot->xp < ceil( $perso->xp - 20 ) )
				$html->EcartAction();
			else
				$html->EcartActionFacile();
			
			// Permet l'insertion de cette action dans l'historique
			$historique->MafAjout( $perso, 53 );

			// On genere le journal
			$journalImage = $config->url . '/images/ennemis/'.$lebot->image;
			
			// On enregistre dans le journal				
			$journal->MafEcrire(5 , $lebot->nom, false, false, $lebot->argent, $journalImage);
			
			// On fait une mise a jour du bot plus sont replacement
			$bot->Replacer(true, $score, true, true, true, true, true);
			
			$victoireCarte->Mafinsert( $perso );
		}
		else
		{

			// On gere ce que gagne et perd les 2 parties	
			$perso->vie -= $resultatDefense - $resultatAttaque;
				
			// On distribut les points	
			$html->DefaiteAction( $resultatDefense - $resultatAttaque);
			$calcul->MafMAJAttaqueJoueur ( $listeParticipants, 0, $config->statPointXpBotDefaiteLanceur, $config->statPointPuissanceBotDefaiteLanceur, $config->statPointIntelligenceBotDefaiteLanceur, $config->statPointVisibiliteBotDefaiteLanceur,$config->statPointXpBotDefaiteParticipant, $config->statPointPuissanceBotDefaiteParticipant, $config->statPointIntelligenceBotDefaiteParticipant, $config->statPointVisibiliteBotDefaiteParticipant );
			
			// Permet l'insertion de cette action dans l'historique
			$historique->MafAjout( $perso, 54 );

			// On genere le journal
			$journalImage = $config->url . '/images/ennemis/'.$lebot->image;
			
			// On enregistre dans le journal				
			$journal->MafEcrire(6 , $lebot->nom, false, false, false, $journalImage);
			
			// On fait une mise a jour du bot plus sont replacement
			$bot->Replacer(false, false, false, true, false, false, false);
		}
	}
}

// On supprime la totalité de l'action et de ses participants
$actions->MafDeleteAction( $perso->iduser , 1);
?>