<?php
/**
* @version $Id: config.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafConfig extends mosDBTable
{
	
	/*
	** SYSTEME
	*/
	
	public $chemin;															// Chemin absolut du script Mafiajob

	public $url;															// URL absolut du script Mafiajob

	public $lien;															// URL pour generer de lien vers le composant

	public $lienTask;														// URL pour generer de lien vers le composant avec le TASK

	public $lienAjax;														// URL pour generer de lien vers le composant POUR AJAX

	public $lienAjaxTask;														// URL pour generer de lien vers le composant POUR AJAX avec Task

	public $action = 0;														// Permet de connaitre le nombre total d'action(s) en cours

	public $fichierdefault = 'action.control.php';							// Nom du fichier par defaut de la page d'accueil

	public $formatDateSQL = 'Y-m-d H:i:s';									// Format de la date pour enregistrement SQL

	public $dureeJeu = 15;													// Durée d'une partie en jour
	
	
	
	/*
	** PERSONNAGE
	*/
	
	public $NiveauXP = array(50, 100, 250, 500, 1000, 2000);				// Les différents points de niveau pour le personnage

	public $NiveauJoueur = array(	'Tapette', 
								'Bandit', 
								'Tueur &agrave; gage', 
								'Affranchi', 
								'Parrain', 
								'Parrain supr&ecirc;me', 
								'Légende');									// Les différents points de niveau au format texte (JOUER PAR DEFAUT)

	public $NiveauFlic = array(	'Bleu bite', 
								'Roi de la circulation', 
								'Inspecteur', 
								'Capitaine', 
								'Chef', 
								'Grand chef', 
								'Robot Cop');								// Les différents points de niveau au format texte (FLIC)

	public $tempsRechercher = 12;											// Temps en heure pour ne plus etre rechercher par les flics

	public $rayonAttaqueJoueur = 2;											// Le rayon pour participer a une attaque joueur (centre = action)

	public $deviseurVoleArgent = 2;											// Déviseur pour l'argent qu on vole a un joueur

	public $chanceperdreAttaque = 3;										// Chance de perdre arme en cas de defait attaque joueur

	public $chanceRecherche = 3;											// Chance d'etre recherché par la police après une action

	public $creationPersonnageVie = 100;									// Lors de la création valeur par defaut VIE
	
	public $creationPersonnageArgent = 250;									// Lors de la création valeur par defaut ARGENT

	public $creationPersonnageMaxPoint = 180;								// Lors de la création valeur par defaut POUR LES PTS PUISSANCE INTELLIGENCE ET VISIBILITE
	
	public $ArgentPourRechercheFauxPapiers = 1000000;						// Si le joueur a plus de x $ il est forcement recherché

	public $tempsDenonciation = 5;											// Le temps en seconde qui indique la durée de la denonciation

	public $perteArgentDenonciation = 2;									// Le diviseur de l'argent perdu en cas de denonciation

	public $delaiPlanqueAction = 30;										// Le delai apres planque pour faire une action

	public $ArgentCreationEquipe = 1000000;									// L'argent necéssaire pour création équipe

	public $XpCreationEquipe = 400;											// L'xp necéssaire pour création équipe


	
	/*
	** PERSONNAGE OPTION
	*/

	public $poidFichierUpdate = 100000;										// Le poid du fichier a envoyer en ko

	public $typeFichierUpdate = array(	'jpg', 
										'JPG', 
										'gif', 
										'GIF', 
										'bmp', 
										'BMP',
										'png', 
										'PNG', 
										'jpeg', 
										'JPEG');							// Le type du fichier a envoyer en ko


	
	/*
	** PERSONNAGE FLICS
	*/

	public $nbrFlicJeu = 10;												// Le nombre de flics sur le jeu

	public $nombreTopRechercheFlic = 5;										// Le nombre de resultat qu'on affiche pour les flics par defaut 5 resultats
	
	public $xpJoueurPrison = 20;											// L'exprience que dois avoir le joueur recherché

	public $niveauFlicMettrePrison = 3;										// Le niveau du flic pour mettre en prison defaut 3 = Inspecteur donc 1 = bleu bite pas de 0

	public $tempsArrestationPrison = 5;										// Le temps en seconde qui indique la durée de l'arrestation prison

	public $tempsAmende = 3;												// Le temps en seconde qui indique la durée pour une amende

	public $tempsControlRoutine = 4;										// Le temps en seconde qui indique la durée d'un control de routine

	public $limitationVitesse = 50;										// Le temps en seconde de deplacement maximun

	public $diviseurPrixAmende = 10;										// Le prix de l amende argent joueur / par valeur

	public $delaiPlanqueJoueur = 2;										// Le delai en minutes d'inactivité du joueur pour le planquer

	public $tempsPrison = array(5, 10, 15, 20, 30, 60);						// Le temps de prison selon le niveau du personnage


	
	/*
	** HABITANTS
	*/

	public $delaiMAJBot = 2;											// le temps en minutes pour la mise a jour des habitants

	public $minimumEssence = 2;												// le minimum sur le personnage pour qu'un habitant propose de un gericane
	
	public $minimumMunition = 1;											// le minimum sur le personnage pour qu'un habitant propose des munitions
	
	public $maxArgentReplaceBot = 1000;										// Max d'argent que l'habitant peut vous donner

	public $miniArgentReplaceBot = 100;										// Min d'argent que l'habitant peut vous donner

	public $maxXpReplaceBot = 5;											// Max d'expérience que l'habitant peut vous donner

	public $minMunitionReplaceBot = 1;										// Min de munition que l'habitant peut vous donner

	public $maxMunitionReplaceBot = 3;										// Max de munition que l'habitant peut vous donner

	public $minEssenceReplaceBot = 4;										// Min d'essence dans un géricane que l'habitant peut vous donner

	public $maxEssenceReplaceBot = 10;										// Max d'essence dans un géricane que l'habitant peut vous donner

	public $ratioReservoirVole = 3;											// Le ratio pour l'essence dans le véhicule voler

	public $ratioMunitionVole = 4;											// Le ratio pour les munitions dans l'arme voler

	public $rayonAttaqueBot = 1;											// Le rayon pour participer a une attaque bot

	public $tempsJoueurRecharge = 2;										// Le temps en seconde de la moyenne des joueur pour le mise a jour du bot
	
	
	
	/*
	** CARTE
	*/
	
	public $delaiRefreshCarte = 50;											// Temps en seconde pour la réactualisation de la carte via ajax

	public $DelaiDeplacementCarte = 60;									// Le temps par defaut pour le deplacement carte

	public $XpDeplacementCarte = 50;										// Le minimum de point d'expérience pour les boutons deplacement en diagonale

	public $voirTchatCarte = true;											// Afficher le tchat sur la carte ( false = non et true = oui ) Component Shoutbox obligatoire
	
	
	
	/*
	** ETABLISSEMENTS
	*/
	
	public $pourcentageValeurAchatBatiment = 10;							// Le temps par defaut pour le déplacement carte
	
	public $ratioVenteArme = 4;												// Ratio sur le prix de vente d'une arme dans les établissements

	public $ratioVenteVoiture = 4;											// Ratio sur le prix de vente d'une voiture dans les établissements

	public $prixPassageTunnel = 100;										// Le prix pour prendre un tunnel

	public $rayonBraquageBatiment = 3;										// Le rayon pour participer à une attaque contre un établissement

	public $diviseurPrixVente = 2;											// Le diviseur tu prix d'achat pour la vente

	public $latitudeCommissariat = 14;										// La latitude du commissariat

	public $longitudeCommissariat = 4;										// La longitude du commissariat

	public $latitudePenitencier = 14;										// La latitude du penitencier

	public $longitudePenitencier = 7;										// La longitude du penitencier
	
	public $nomOptionBatiment = array( 	1 => 'intelligence', 
										2 => 'puissance', 
										3 => 'argent', 
										4 => 'visibilite', 
										5 => 'vie' 
										);									// Les différents nom des option batiment

	public $optionRapporteBatimentAnpe = 2;									// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentAnpeType = 1;								// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentArme = 4;									// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentArmeType = 2;								// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentBanque = 2000;							// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentBanqueType = 3;							// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentCasino = 5000;							// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentCasinoType = 3;							// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentCircuit = 1;								// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentCircuitType = 4;							// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentHospital = 10;							// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentHospitalType = 5;							// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentJeux = 500;								// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentJeuxType = 3;								// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentPapier = 1;								// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentPapierType = 1;							// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentParking = 1000;							// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentParkingType = 3;							// Type de point gagné lors de vente batiment
		
	public $optionRapporteBatimentPenitencier = 20;							// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentPenitencierType = 5;						// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentSpa = 500;								// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentSpaType = 3;								// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentTunnel = 1;								// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentTunnelType = 1;							// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentValidation = 4;							// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentValidationType = 1;						// Type de point gagné lors de vente batiment
	
	public $optionRapporteBatimentVoiture = 1;								// Nombre de point gagné lors de vente batiment

	public $optionRapporteBatimentVoitureType = 4;							// Type de point gagné lors de vente batiment

	public $pointVieRecupEchangeHospital = 1;								// Point de vie que recupère le personnage pour un point d expérience echanger

	public $pointVieRecupAchatHospital = 10;								// Point de vie que recupère le personnage pour un achat par mafia pass
	

	// Special partie pour les missions
	
	public $statAvoirSupplType1 = 10;										// Type 1 pour une mission sur le nombre d'attaque

	public $statAvoirSupplType2 = 50;										// Type 2 pour une mission sur le nombre de vente de stupéfiant

	public $statAvoirSupplType3 = 20;										// Type 3 pour une mission sur le nombre d'xp

	public $statAvoirSupplType4 = 15;										// Type 3 pour une mission sur le nombre de vole d'arme

	public $statAvoirSupplType5 = 5;										// Type 3 pour une mission sur le nombre de vole de voiture
	
	public $statAvoirSupplType1Gagner = 5;									// Point que vous gagner pour une mission sur le nombre d'attaque	PUISSANCE

	public $statAvoirSupplType2Gagner = 4;									// Point que vous gagner pour une mission sur le nombre de vente de stupéfiant	VISIBILITE

	public $statAvoirSupplType3Gagner = 10;									// Point que vous gagner pour une mission sur le nombre d'xp	XP

	public $statAvoirSupplType4Gagner = 3;									// Point que vous gagner pour une mission sur le nombre de vole d'arme	INTELLIGENCE

	public $statAvoirSupplType5Gagner = 5;									// Point que vous gagner pour une mission sur le nombre de vole de voiture	INTELLIGENCE

	public $statAvoirSupplTypeArgentGagner = 10000;							// Argent que tu gagne en cas de victoire mission
	

	// Special partie pour finir le jeu
	
	public $statAvoirVictoireArgent = 1000000;								// équipe doit avoir un capital supérieur a x defaut : 1 000 000 $

	public $statAvoirVictoireXp = 700;										// chaque joueur doit avoir 700 pts d'expérience pour finir le jeu

	public $statAvoirVictoireSante = 50;									// chaque joueur doit avoir plus de la moitier de santé pour finir le jeu

	public $statAvoirVictoireAttaque = 15;									// le total de tous les joueurs niveau attaque joueurs et habitants

	public $statAvoirVictoireVoleArme = 100;								// le total de voles d'armes pour finir le jeu

	public $statAvoirVictoireVoleVoiture = 100;								// le total de voles de voitures pour finir le jeu

	public $statAvoirVictoireVoleArgent = 100;								// le total de voles d'argents pour finir le jeu

	public $statAvoirVictoireStupefiant = 1000;								// le total de vente de stupefiants pour finir le jeu



	/*
	** HISTORIQUE
	*/
	
	public $nombreAfficherHistorique = 50;									// Le nombre d'historique à afficher sur la page
	
	
	
	/*
	** POINT GAGNE APRES UNE ACTION POUR LES STATISTIQUE DU PERSONNAGE
	*/
	
	public $statPointRationDifference = 10;									// Ration qui permet de prider la différence attaque selon les joueurs

	public $statPointRationDiviseurArgentJoueur = 2;						// Ration qui permet de diviser la somme du joueur qui est attaque et partager
	
	// Partie Plusieurs
	// Lanceur Victoire AUTRE JOUEUR
	public $statPointXpAttaqueVitoireLanceur = 1;							// Point(s) pour victoire contre un joueur ( < * Ration ) et LANCEUR XP
	
	public $statPointPuissanceAttaqueVitoireLanceur = 1;					// Point(s) pour victoire contre un joueur ( < * Ration ) et LANCEUR PUISSANCE
	
	public $statPointIntelligenceAttaqueVitoireLanceur = 0;					// Point(s) pour victoire contre un joueur ( < * Ration ) et LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteAttaqueVitoireLanceur = 0;					// Point(s) pour victoire contre un joueur ( < * Ration ) et LANCEUR VISIBILITE

	//Defense Defaite AUTRE JOUEUR
	public $statPointXpDefenseDefaite = -1;									// Point(s) pour défaite contre un joueur DEFENSE XP
	
	public $statPointPuissanceDefenseDefaite = -1;							// Point(s) pour défaite contre un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceDefenseDefaite = 0;						// Point(s) pour défaite contre un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteDefenseDefaite = 0;							// Point(s) pour défaite contre un joueur DEFENSE VISIBILITE
	
	//Lanceur Defaite AUTRE JOUEUR
	public $statPointXpAttaqueDefaiteLanceur = -2;							// Point(s) pour défaite contre un joueur LANCEUR XP
	
	public $statPointPuissanceAttaqueDefaiteLanceur = -1;					// Point(s) pour défaite contre un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceAttaqueDefaiteLanceur = 0;					// Point(s) pour défaite contre un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteAttaqueDefaiteLanceur = 0;					// Point(s) pour défaite contre un joueur LANCEUR VISIBILITE

	//Participant Defaite AUTRE JOUEUR
	public $statPointXpAttaqueDefaiteParticipant = -1;						// Point(s) pour défaite contre un joueur PARTICIPANT(S) XP

	public $statPointPuissanceAttaqueDefaiteParticipant = 0;				// Point(s) pour défaite contre un joueur PARTICIPANT(S) PUISSANCE

	public $statPointIntelligenceAttaqueDefaiteParticipant = 0;				// Point(s) pour défaite contre un joueur PARTICIPANT(S) INTELLIGENCE

	public $statPointVisibiliteAttaqueDefaiteParticipant = 0;				// Point(s) pour défaite contre un joueur PARTICIPANT(S) VISIBILITE

	//Defense Victoire AUTRE JOUEUR
	public $statPointXpDefenseVictoireMin = 2;								// Point(s) pour victoire contre un joueur DEFENSE XP MINIMUM

	public $statPointXpDefenseVictoireMax = 3;								// Point(s) pour victoire contre un joueur DEFENSE XP MINIMUM
	
	public $statPointPuissanceDefenseVictoireMin = 1;						// Point(s) pour victoire contre un joueur DEFENSE PUISSANCE MAXIMUM
	
	public $statPointPuissanceDefenseVictoireMax = 2;						// Point(s) pour victoire contre un joueur DEFENSE PUISSANCE MAXIMUM
	
	//Lanceur Victoire ETABLISSEMENT
	public $statPointXpEtablissementVitoireLanceur = 5;						// Point(s) pour victoire contre un établissement LANCEUR XP
	
	public $statPointPuissanceEtablissementVitoireLanceur = 3;				// Point(s) pour victoire contre un établissement LANCEUR PUISSANCE
	
	public $statPointIntelligenceEtablissementVitoireLanceur = 4;			// Point(s) pour victoire contre un établissement LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteEtablissementVitoireLanceur = 4;				// Point(s) pour victoire contre un établissement LANCEUR VISIBILITE
	
	//Participant Victoire ETABLISSEMENT
	public $statPointXpEtablissementVitoireParticipant = 2;					// Point(s) pour victoire contre un établissement PARTICIPANT(S) XP

	public $statPointPuissanceEtablissementVitoireParticipant = 2;			// Point(s) pour victoire contre un établissement PARTICIPANT(S) PUISSANCE
	
	public $statPointIntelligenceEtablissementVitoireParticipant = 2;		// Point(s) pour victoire contre un établissement PARTICIPANT(S) INTELLIGENCE
	
	public $statPointVisibiliteEtablissementVitoireParticipant = 3;			// Point(s) pour victoire contre un établissement PARTICIPANT(S) VISIBILITE
	
	//Lanceur Défaite ETABLISSEMENT
	public $statPointXpEtablissementDefaiteLanceur = -5;					// Point(s) pour défaite contre un établissement LANCEUR XP
	
	public $statPointPuissanceEtablissementDefaiteLanceur = -3;				// Point(s) pour défaite contre un établissement LANCEUR PUISSANCE
	
	public $statPointIntelligenceEtablissementDefaiteLanceur = -3;			// Point(s) pour défaite contre un établissement LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteEtablissementDefaiteLanceur = -2;			// Point(s) pour défaite contre un établissement LANCEUR VISIBILITE
	
	//Participant Défaite ETABLISSEMENT
	public $statPointXpEtablissementDefaiteParticipant = -2;				// Point(s) pour défaite contre un établissement PARTICIPANT(S) XP

	public $statPointPuissanceEtablissementDefaiteParticipant = -1;			// Point(s) pour défaite contre un établissement PARTICIPANT(S) PUISSANCE
	
	public $statPointIntelligenceEtablissementDefaiteParticipant = -3;		// Point(s) pour défaite contre un établissement PARTICIPANT(S) INTELLIGENCE
	
	public $statPointVisibiliteEtablissementDefaiteParticipant = -1;		// Point(s) pour défaite contre un établissement PARTICIPANT(S) VISIBILITE
	
	//Lanceur Victoire HABITANT
	public $statPointXpBotVitoireLanceur = 2;								// Point(s) pour victoire contre un habitant LANCEUR XP
	
	public $statPointPuissanceBotVitoireLanceur = 1;						// Point(s) pour victoire contre un habitant LANCEUR PUISSANCE
	
	public $statPointIntelligenceBotVitoireLanceur = 0;						// Point(s) pour victoire contre un habitant LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteBotVitoireLanceur = 0;						// Point(s) pour victoire contre un habitant LANCEUR VISIBILITE
	
	//Participant Victoire HABITANT
	public $statPointXpBotVitoireParticipant = 1;							// Point(s) pour victoire contre un habitant PARTICIPANT(S) XP

	public $statPointPuissanceBotVitoireParticipant = 0;					// Point(s) pour victoire contre un habitant PARTICIPANT(S) PUISSANCE
	
	public $statPointIntelligenceBotVitoireParticipant = 0;					// Point(s) pour victoire contre un habitant PARTICIPANT(S) INTELLIGENCE
	
	public $statPointVisibiliteBotVitoireParticipant = 0;					// Point(s) pour victoire contre un habitant PARTICIPANT(S) VISIBILITE
	
	//Lanceur Défaite HABITANT
	public $statPointXpBotDefaiteLanceur = -1;								// Point(s) pour défaite contre un habitant LANCEUR XP
	
	public $statPointPuissanceBotDefaiteLanceur = -1;						// Point(s) pour défaite contre un habitant LANCEUR PUISSANCE
	
	public $statPointIntelligenceBotDefaiteLanceur = 0;						// Point(s) pour défaite contre un habitant LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteBotDefaiteLanceur = 0;						// Point(s) pour défaite contre un habitant LANCEUR VISIBILITE
	
	//Participant Défaite HABITANT
	public $statPointXpBotDefaiteParticipant = -1;							// Point(s) pour défaite contre un habitant PARTICIPANT(S) XP

	public $statPointPuissanceBotDefaiteParticipant = 0;					// Point(s) pour défaite contre un habitant PARTICIPANT(S) PUISSANCE
	
	public $statPointIntelligenceBotDefaiteParticipant = 0;					// Point(s) pour défaite contre un habitant PARTICIPANT(S) INTELLIGENCE
	
	public $statPointVisibiliteBotDefaiteParticipant = 0;					// Point(s) pour défaite contre un habitant PARTICIPANT(S) VISIBILITE
	
	// Partie Solo Habitant
	//Lanceur Victoire VOLE ARGENT HABITANT
	public $statPointXpVoleArgentBotVictoire = 1;							// Point(s) pour victoire contre le vole d'argent d'un habitant LANCEUR XP

	public $statPointPuissanceVoleArgentBotVictoire = 0;					// Point(s) pour victoire contre le vole d'argent d'un habitant LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleArgentBotVictoire = 1;					// Point(s) pour victoire contre le vole d'argent d'un habitant LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleArgentBotVictoire = 1;					// Point(s) pour victoire contre le vole d'argent d'un habitant LANCEUR VISIBILITE
	
	//Lanceur Défaite VOLE ARGENT HABITANT
	public $statPointXpVoleArgentBotDefaite = -1;							// Point(s) pour défaite contre le vole d'argent d'un habitant LANCEUR XP

	public $statPointPuissanceVoleArgentBotDefaite = 0;						// Point(s) pour défaite contre le vole d'argent d'un habitant LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleArgentBotDefaite = -1;					// Point(s) pour défaite contre le vole d'argent d'un habitant LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleArgentBotDefaite = -1;					// Point(s) pour défaite contre le vole d'argent d'un habitant LANCEUR VISIBILITE
	
	//Lanceur Victoire VOLE ARME HABITANT	
	public $statPointXpVoleArmeBotVictoire = 1;								// Point(s) pour victoire contre le vole d'une arme d'un habitant LANCEUR XP

	public $statPointPuissanceVoleArmeBotVictoire = 1;						// Point(s) pour victoire contre le vole d'une arme d'un habitant LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleArmeBotVictoire = 1;					// Point(s) pour victoire contre le vole d'une arme d'un habitant LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleArmeBotVictoire = 1;						// Point(s) pour victoire contre le vole d'une arme d'un habitant LANCEUR VISIBILITE
	
	//Lanceur Défaite VOLE ARME HABITANT
	public $statPointXpVoleArmeBotDefaite = -1;								// Point(s) pour défaite contre le vole d'une arme d'un habitant LANCEUR XP

	public $statPointPuissanceVoleArmeBotDefaite = 0;						// Point(s) pour défaite contre le vole d'une arme d'un habitant LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleArmeBotDefaite = -2;					// Point(s) pour défaite contre le vole d'une arme d'un habitant LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleArmeBotDefaite = -2;						// Point(s) pour défaite contre le vole d'une arme d'un habitant LANCEUR VISIBILITE
	
	//Lanceur Victoire VOLE VOITURE HABITANT
	public $statPointXpVoleVoitureBotVictoire = 2;							// Point(s) pour victoire contre le vole d'une voiture d'un habitant LANCEUR XP

	public $statPointPuissanceVoleVoitureBotVictoire = 1;					// Point(s) pour victoire contre le vole d'une voiture d'un habitant LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleVoitureBotVictoire = 2;				// Point(s) pour victoire contre le vole d'une voiture d'un habitant LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleVoitureBotVictoire = 2;					// Point(s) pour victoire contre le vole d'une voiture d'un habitant LANCEUR VISIBILITE
	
	//Lanceur Défaite VOLE VOITURE HABITANT
	public $statPointXpVoleVoitureBotDefaite = -1;							// Point(s) pour défaite contre le vole d'une voiture d'un habitant LANCEUR XP

	public $statPointPuissanceVoleVoitureBotDefaite = 0;					// Point(s) pour défaite contre le vole d'une voiture d'un habitant LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleVoitureBotDefaite = -3;				// Point(s) pour défaite contre le vole d'une voiture d'un habitant LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleVoitureBotDefaite = -3;					// Point(s) pour défaite contre le vole d'une voiture d'un habitant LANCEUR VISIBILITE
	
	// Partie Solo Joueur
	//Lanceur Victoire VOLE ARGENT JOUEUR
	public $statPointXpVoleArgentJoueurVictoireLanceur = 2;					// Point(s) pour victoire contre le vole d'argent d'un joueur LANCEUR XP

	public $statPointPuissanceVoleArgentJoueurVictoireLanceur = 0;			// Point(s) pour victoire contre le vole d'argent d'un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleArgentJoueurVictoireLanceur = 3;		// Point(s) pour victoire contre le vole d'argent d'un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleArgentJoueurVictoireLanceur = 2;			// Point(s) pour victoire contre le vole d'argent d'un joueur LANCEUR VISIBILITE
	
	//Lanceur Défaite VOLE ARGENT JOUEUR
	public $statPointXpVoleArgentJoueurDefaiteLanceur = -1;					// Point(s) pour défaite contre le vole d'argent d'un joueur LANCEUR XP

	public $statPointPuissanceVoleArgentJoueurDefaiteLanceur = 0;			// Point(s) pour défaite contre le vole d'argent d'un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleArgentJoueurDefaiteLanceur = -1;		// Point(s) pour défaite contre le vole d'argent d'un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleArgentJoueurDefaiteLanceur = -2;			// Point(s) pour défaite contre le vole d'argent d'un joueur LANCEUR VISIBILITE
	
	//Defense Victoire VOLE ARGENT JOUEUR
	public $statPointXpVoleArgentJoueurVictoireDefense = 3;					// Point(s) pour victoire contre le vole d'argent d'un joueur DEFENSE XP

	public $statPointPuissanceVoleArgentJoueurVictoireDefense = 0;			// Point(s) pour victoire contre le vole d'argent d'un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceVoleArgentJoueurVictoireDefense = 1;		// Point(s) pour victoire contre le vole d'argent d'un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteVoleArgentJoueurVictoireDefense = 1;			// Point(s) pour victoire contre le vole d'argent d'un joueur DEFENSE VISIBILITE
	
	//Defense Défaite VOLE ARGENT JOUEUR
	public $statPointXpVoleArgentJoueurDefaiteDefense = -1;					// Point(s) pour défaite contre le vole d'argent d'un joueur DEFENSE XP

	public $statPointPuissanceVoleArgentJoueurDefaiteDefense = 0;			// Point(s) pour défaite contre le vole d'argent d'un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceVoleArgentJoueurDefaiteDefense = -1;		// Point(s) pour défaite contre le vole d'argent d'un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteVoleArgentJoueurDefaiteDefense = -1;			// Point(s) pour défaite contre le vole d'argent d'un joueur DEFENSE VISIBILITE
	
	//Lanceur Victoire VOLE ARME JOUEUR
	public $statPointXpVoleArmeJoueurVictoireLanceur = 2;					// Point(s) pour victoire contre le vole d'une arme d'un joueur LANCEUR XP

	public $statPointPuissanceVoleArmeJoueurVictoireLanceur = 2;			// Point(s) pour victoire contre le vole d'une arme d'un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleArmeJoueurVictoireLanceur = 2;			// Point(s) pour victoire contre le vole d'une arme d'un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleArmeJoueurVictoireLanceur = 2;			// Point(s) pour victoire contre le vole d'une arme d'un joueur LANCEUR VISIBILITE
	
	//Lanceur Défaite VOLE ARME JOUEUR
	public $statPointXpVoleArmeJoueurDefaiteLanceur = -1;					// Point(s) pour défaite contre le vole d'une arme d'un joueur LANCEUR XP

	public $statPointPuissanceVoleArmeJoueurDefaiteLanceur = -1;			// Point(s) pour défaite contre le vole d'une arme d'un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleArmeJoueurDefaiteLanceur = -2;			// Point(s) pour défaite contre le vole d'une arme d'un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleArmeJoueurDefaiteLanceur = -2;			// Point(s) pour défaite contre le vole d'une arme d'un joueur LANCEUR VISIBILITE
	
	//Defense Victoire VOLE ARME JOUEUR
	public $statPointXpVoleArmeJoueurVictoireDefense = 2;					// Point(s) pour victoire contre le vole d'une arme d'un joueur DEFENSE XP

	public $statPointPuissanceVoleArmeJoueurVictoireDefense = 3;			// Point(s) pour victoire contre le vole d'une arme d'un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceVoleArmeJoueurVictoireDefense = 2;			// Point(s) pour victoire contre le vole d'une arme d'un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteVoleArmeJoueurVictoireDefense = 2;			// Point(s) pour victoire contre le vole d'une arme d'un joueur DEFENSE VISIBILITE
	
	//Defense Défaite VOLE ARME JOUEUR
	public $statPointXpVoleArmeJoueurDefaiteDefense = -1;					// Point(s) pour défaite contre le vole d'une arme d'un joueur DEFENSE XP

	public $statPointPuissanceVoleArmeJoueurDefaiteDefense = -1;			// Point(s) pour défaite contre le vole d'une arme d'un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceVoleArmeJoueurDefaiteDefense = -1;			// Point(s) pour défaite contre le vole d'une arme d'un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteVoleArmeJoueurDefaiteDefense = -1;			// Point(s) pour défaite contre le vole d'une arme d'un joueur DEFENSE VISIBILITE
	
	//Lanceur Victoire VOLE VOITURE JOUEUR
	public $statPointXpVoleVoitureJoueurVictoireLanceur = 2;				// Point(s) pour victoire contre le vole d'une voiture d'un joueur LANCEUR XP

	public $statPointPuissanceVoleVoitureJoueurVictoireLanceur = 2;			// Point(s) pour victoire contre le vole d'une voiture d'un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleVoitureJoueurVictoireLanceur = 4;		// Point(s) pour victoire contre le vole d'une voiture d'un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleVoitureJoueurVictoireLanceur = 3;		// Point(s) pour victoire contre le vole d'une voiture d'un joueur LANCEUR VISIBILITE
	
	//Lanceur Défaite VOLE VOITURE JOUEUR
	public $statPointXpVoleVoitureJoueurDefaiteLanceur = -1;				// Point(s) pour défaite contre le vole d'une voiture d'un joueur LANCEUR XP

	public $statPointPuissanceVoleVoitureJoueurDefaiteLanceur = -1;			// Point(s) pour défaite contre le vole d'une voiture d'un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceVoleVoitureJoueurDefaiteLanceur = -4;		// Point(s) pour défaite contre le vole d'une voiture d'un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteVoleVoitureJoueurDefaiteLanceur = -3;		// Point(s) pour défaite contre le vole d'une voiture d'un joueur LANCEUR VISIBILITE
	
	//Defense Victoire VOLE VOITURE JOUEUR
	public $statPointXpVoleVoitureJoueurVictoireDefense = 2;				// Point(s) pour victoire contre le vole d'une voiture d'un joueur DEFENSE XP

	public $statPointPuissanceVoleVoitureJoueurVictoireDefense = 3;			// Point(s) pour victoire contre le vole d'une voiture d'un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceVoleVoitureJoueurVictoireDefense = 2;		// Point(s) pour victoire contre le vole d'une voiture d'un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteVoleVoitureJoueurVictoireDefense = 3;		// Point(s) pour victoire contre le vole d'une voiture d'un joueur DEFENSE VISIBILITE
	
	//Defense Défaite VOLE VOITURE JOUEUR
	public $statPointXpVoleVoitureJoueurDefaiteDefense = -1;				// Point(s) pour défaite contre le vole d'une voiture d'un joueur DEFENSE XP

	public $statPointPuissanceVoleVoitureJoueurDefaiteDefense = -2;			// Point(s) pour défaite contre le vole d'une voiture d'un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceVoleVoitureJoueurDefaiteDefense = -2;		// Point(s) pour défaite contre le vole d'une voiture d'un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteVoleVoitureJoueurDefaiteDefense = -2;		// Point(s) pour défaite contre le vole d'une voiture d'un joueur DEFENSE VISIBILITE
	
	//Lanceur Victoire DENONCE JOUEUR
	public $statPointXpDenonceJoueurVictoireLanceur = 2;					// Point(s) pour victoire contre la denonciation d'un joueur LANCEUR XP

	public $statPointPuissanceDenonceJoueurVictoireLanceur = 0;				// Point(s) pour victoire contre la denonciation d'un joueur LANCEUR PUISSANCE
		
	public $statPointIntelligenceDenonceJoueurVictoireLanceur = 3;			// Point(s) pour victoire contre la denonciation d'un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteDenonceJoueurVictoireLanceur = 4;			// Point(s) pour victoire contre la denonciation d'un joueur LANCEUR VISIBILITE
	
	//Lanceur Défaite DENONCE JOUEUR
	public $statPointXpDenonceJoueurDefaiteLanceur = -1;					// Point(s) pour défaite contre la denonciation d'un joueur LANCEUR XP

	public $statPointPuissanceDenonceJoueurDefaiteLanceur = -1;				// Point(s) pour défaite contre la denonciation d'un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceDenonceJoueurDefaiteLanceur = -2;			// Point(s) pour défaite contre la denonciation d'un joueur LANCEUR INTELLIGENCE
		
	public $statPointVisibiliteDenonceJoueurDefaiteLanceur = -2;			// Point(s) pour défaite contre la denonciation d'un joueur LANCEUR VISIBILITE
	
	//Lanceur Flic Victoire DENONCE JOUEUR
	public $statPointXpDenonceJoueurVictoireLanceurFlic = 3;				// Point(s) pour victoire contre la denonciation d'un joueur LANCEUR FLIC XP

	public $statPointPuissanceDenonceJoueurVictoireLanceurFlic = 1;			// Point(s) pour victoire contre la denonciation d'un joueur LANCEUR FLIC PUISSANCE
		
	public $statPointIntelligenceDenonceJoueurVictoireLanceurFlic = 4;		// Point(s) pour victoire contre la denonciation d'un joueur LANCEUR FLIC INTELLIGENCE
	
	public $statPointVisibiliteDenonceJoueurVictoireLanceurFlic = 5;		// Point(s) pour victoire contre la denonciation d'un joueur LANCEUR FLIC VISIBILITE
	
	//Lanceur Flic Défaite DENONCE JOUEUR
	public $statPointXpDenonceJoueurDefaiteLanceurFlic = -2;				// Point(s) pour défaite contre la denonciation d'un joueur LANCEUR FLIC XP

	public $statPointPuissanceDenonceJoueurDefaiteLanceurFlic = -2;			// Point(s) pour défaite contre la denonciation d'un joueur LANCEUR FLIC PUISSANCE
	
	public $statPointIntelligenceDenonceJoueurDefaiteLanceurFlic = -3;		// Point(s) pour défaite contre la denonciation d'un joueur LANCEUR FLIC INTELLIGENCE
		
	public $statPointVisibiliteDenonceJoueurDefaiteLanceurFlic = -3;		// Point(s) pour défaite contre la denonciation d'un joueur LANCEUR FLIC VISIBILITE
	
	//Defense Victoire DENONCE JOUEUR
	public $statPointXpDenonceJoueurVictoireDefense = 3;					// Point(s) pour victoire contre la denonciation d'un joueur DEFENSE XP

	public $statPointPuissanceDenonceJoueurVictoireDefense = 0;				// Point(s) pour victoire contre la denonciation d'un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceDenonceJoueurVictoireDefense = 5;			// Point(s) pour victoire contre la denonciation d'un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteDenonceJoueurVictoireDefense = 4;			// Point(s) pour victoire contre la denonciation d'un joueur DEFENSE VISIBILITE
	
	//Defense Défaite DENONCE JOUEUR
	public $statPointXpDenonceJoueurDefaiteDefense = -1;					// Point(s) pour défaite contre la denonciation d'un joueur DEFENSE XP

	public $statPointPuissanceDenonceJoueurDefaiteDefense = -2;				// Point(s) pour défaite contre la denonciation d'un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceDenonceJoueurDefaiteDefense = -2;			// Point(s) pour défaite contre la denonciation d'un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteDenonceJoueurDefaiteDefense = -2;			// Point(s) pour défaite contre la denonciation d'un joueur DEFENSE VISIBILITE
	
	//Defense Victoire DENONCE JOUEUR FLIC
	public $statPointXpDenonceJoueurVictoireDefenseFlic = 4;				// Point(s) pour victoire contre la denonciation d'un joueur DEFENSE FLIC XP

	public $statPointPuissanceDenonceJoueurVictoireDefenseFlic = 1;			// Point(s) pour victoire contre la denonciation d'un joueur DEFENSE FLIC PUISSANCE
	
	public $statPointIntelligenceDenonceJoueurVictoireDefenseFlic = 6;		// Point(s) pour victoire contre la denonciation d'un joueur DEFENSE FLIC INTELLIGENCE
	
	public $statPointVisibiliteDenonceJoueurVictoireDefenseFlic = 5;		// Point(s) pour victoire contre la denonciation d'un joueur DEFENSE FLIC VISIBILITE
	
	//Defense Défaite DENONCE JOUEUR FLIC
	public $statPointXpDenonceJoueurDefaiteDefenseFlic = -2;				// Point(s) pour défaite contre la denonciation d'un joueur DEFENSE FLIC XP

	public $statPointPuissanceDenonceJoueurDefaiteDefenseFlic = -3;			// Point(s) pour défaite contre la denonciation d'un joueur DEFENSE FLIC PUISSANCE
	
	public $statPointIntelligenceDenonceJoueurDefaiteDefenseFlic = -3;		// Point(s) pour défaite contre la denonciation d'un joueur DEFENSE FLIC INTELLIGENCE
	
	public $statPointVisibiliteDenonceJoueurDefaiteDefenseFlic = -3;		// Point(s) pour défaite contre la denonciation d'un joueur DEFENSE FLIC VISIBILITE
	
	//Lanceur Victoire AMENDE JOUEUR
	public $statPointXpAmendeJoueurVictoireLanceur = 2;						// Point(s) pour victoire contre une amende sur un joueur LANCEUR XP

	public $statPointPuissanceAmendeJoueurVictoireLanceur = 2;				// Point(s) pour victoire contre une amende sur un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceAmendeJoueurVictoireLanceur = 4;			// Point(s) pour victoire contre une amende sur un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteAmendeJoueurVictoireLanceur = 3;				// Point(s) pour victoire contre lune amende sur un joueur LANCEUR VISIBILITE
	
	//Lanceur Défaite AMENDE JOUEUR
	public $statPointXpAmendeJoueurDefaiteLanceur = -1;						// Point(s) pour défaite contre une amende sur un joueur LANCEUR XP

	public $statPointPuissanceAmendeJoueurDefaiteLanceur = -1;				// Point(s) pour défaite contre une amende sur un joueur LANCEUR PUISSANCE
	
	public $statPointIntelligenceAmendeJoueurDefaiteLanceur = -4;			// Point(s) pour défaite contre une amende sur un joueur LANCEUR INTELLIGENCE
	
	public $statPointVisibiliteAmendeJoueurDefaiteLanceur = -3;				// Point(s) pour défaite contre une amende sur un joueur LANCEUR VISIBILITE
	
	//Defense Victoire AMENDE JOUEUR
	public $statPointXpAmendeJoueurVictoireDefense = 2;						// Point(s) pour victoire contre une amende sur un joueur DEFENSE XP

	public $statPointPuissanceAmendeJoueurVictoireDefense = 3;				// Point(s) pour victoire contre une amende sur un joueur DEFENSE PUISSANCE
	
	public $statPointIntelligenceAmendeJoueurVictoireDefense = 2;			// Point(s) pour victoire contre une amende sur un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteAmendeJoueurVictoireDefense = 3;				// Point(s) pour victoire contre une amende sur un joueur DEFENSE VISIBILITE
	
	//Defense Défaite AMENDE JOUEUR
	public $statPointXpAmendeJoueurDefaiteDefense = -1;						// Point(s) pour défaite contre une amende sur un joueur DEFENSE XP

	public $statPointPuissanceAmendeJoueurDefaiteDefense = -2;				// Point(s) pour défaite contre une amende sur un joueur DEFENSE PUISSANCE
		
	public $statPointIntelligenceAmendeJoueurDefaiteDefense = -2;			// Point(s) pour défaite contre une amende sur un joueur DEFENSE INTELLIGENCE
	
	public $statPointVisibiliteAmendeJoueurDefaiteDefense = -2;				// Point(s) pour défaite contre une amende sur un joueur DEFENSE VISIBILITE
	
	//LORS D'UNE MISE EN PLANQUE D'FLIC	
	public $statPointXpPlanqueur = 1;			// Point(s) pour défaite contre une amende sur un joueur DEFENSE INTELLIGENCE
	
	public $statPointXpPlanquer = -1;				// Point(s) pour défaite contre une amende sur un joueur DEFENSE VISIBILITE
	
	public $statPointXpArrestation = 3;				// Point(s) pour avoir réussi une arrestation XP FLIC
	
	
	
	/*
	** EQUIPE
	*/
	
	public $TempsValideInvitation = 24;											// Dela en Heure de la validité d'une invitation
	
	
	
	/*
	** DROGUE
	*/
	
	public $tauxVenteDrogue = 10;											// Pourcentage de la vente de drogue par defaut

	public $delaiMAJDrogue = 10;											// Temps en minutes entre chaque vente de drogue

	public $prixDrogue = array( 50, 100, 200, 500, 1300, 3000, 6500);		// Les différents prix de drogue

	public $nomDrogue = array( 	'Pop Up', 
								'Haschich', 
								'Marijuana', 
								'Ecstasy', 
								'LSD', 
								'Cocaine', 
								'Mescaline');								// Les différents noms de drogue

	public $imageDrogue = array( 	'Popup.jpg', 
								'Haschich.jpg', 
								'marijuana.jpg', 
								'ecstasy.jpg', 
								'lsd.jpg', 
								'cocaine.jpg', 
								'mescaline.jpg');							// Les différentes images de drogue

	public $drogueDescription1 = 'Le poppers est un vasodilatateur qui se pr&eacute;sente g&eacute;n&eacute;ralement sous forme de liquide tr&egrave;s volatil, contenu dans une fiole. Auparavant commercialis&eacute; &agrave; usage m&eacute;dical pour certaines affections cardiaques dans des ampoules, l\'ouverture de celles-ci g&eacute;n&eacute;raient un effet sonore pop qui a donn&eacute; le nom au produit. Il est vendu en sex shops ou ses qualit&eacute;s vasodilatatrices sont surtout vant&eacute;es pour l\'anus. C\'est d\'ailleur pour cet effet l&agrave; qu\'il est consid&eacute;r&eacute; comme un jouet sexuel. Le poppers est une substance tr&egrave;s inflammable.<br /> Hummm...C\'est un aphrodisiaque, sans commentaire, mais bon c\'est pas bien quand m&ecirc;me.';
		
	public $drogueDescription2 = 'Contrairement &aacute; l\'herbe naturelle, le haschisch est un produit manufactur&eacute; artificiel. Les effets sont plus assommants en g&eacute;n&eacute;ral et en raison de la nature de certains des excipients utilis&eacute;s, la prise de haschisch peut provoquer des maux de t&ecirc;te lancinants ainsi qu\'une fatigue accablante.<br />La drogue provoque une d&eacute;pendance au long terme.';
		
	public $drogueDescription3 = 'Actuellement, 6 jeunes sur 10 fument le Cannabis et de nombreux adultes font de m&ecirc;me. On estime &aacute; 200 millions le nombre de consommateurs de CANNABIS dans le monde (dont 5 millions en France) parmi lesquels 60 millions sont des consommateurs intensifs. La production de Cannabis s\'&eacute;l&egrave;verait &aacute; environ 4.000 tonnes/an, mais il semble que ces chiffres soient sous-estim&eacute;s.<br />Alors ne commencez pas &aacute; fumer pour faire comme tout le monde, la d&eacute;pendance est vite arriv&eacute;e...';
		
	public $drogueDescription4 = 'Pilules-performances, pilules-f&ecirc;tes, potions magiques ? De plus en plus r&eacute;pandue dans le monde, l\'ecstasy pour certains ne serait m&ecirc;me pas une drogue. Ah bon ?<br />Cette drogue peut provoquer des troubles psychiques s&eacute;v&egrave;re. Sa consommation est particuli&egrave;rement dangereuse pour les personnes qui souffrent de troubles du rythme cardiaque, d\'asthme, d\'&eacute;pilepsie, de probl&egrave;mes r&eacute;naux, de diab&egrave;te, d\'asth&eacute;nie (fatigue) et de probl&egrave;mes psychologiques...Les drogues dure peuvent tuer.';

	public $drogueDescription5 = 'Le L.S.D. est une substance hallucinog&egrave;ne dont l\'utilisation m&egrave;ne &aacute; des d&eacute;convenues, d\'ordre psychiatrique, ou pires lors de la survenue des ph&eacute;nom&egrave;nes de flashback. Bien que sa toxicit&eacute; propre soit mal connue, comme pour d\'autres hallucinog&egrave;nes, des d&eacute;c&egrave;s accidentels surviennent en cons&eacute;quence des circonstances de consommation. C\'est une substance tr&egrave;s puissante qui sournoisement voisine les d&eacute;riv&eacute;s amph&eacute;taminiques (dont l\'ecstasy) dans les soir&eacute;es et rave parties, et dont il convient de se m&eacute;fier au plus haut point.<br />Cette drogue peut conduire &aacute; des actes monstrueux, meurtre, sucide...N\'en promener pas ou vous ne serez plus ma&icirc;tre de vos actes.';
		
	public $drogueDescription6 = 'La coca&iuml;ne se pr&eacute;sente sous la forme d\'une fine poudre blanche. Elle est extraite des feuilles de coca&iuml;er. Elle est pris&eacute;e (la ligne de coke est sniff&eacute;e); &eacute;galement inject&eacute;e par voie intraveineuse ou fum&eacute;e. La coca&iuml;ne est parfois frelat&eacute;e, coup&eacute;e ou m&eacute;lang&eacute;e &aacute; d\'autres substances par les trafiquants, ce qui accroit sa dangerosit&eacute; et potentialise les effets et les interactions entre des produits dont on ne conna&icirc;t pas la composition.<br />La coca&iuml;ne permet de se sentir plus fort...Certe mais la d&eacute;ssente ram&egrave;ne &aacute; une r&eacute;alit&eacute; encore plus dure que celle d&eacute;j&agrave; existante, alors si &ccedil;a ne va pas...Evitez la.';
		
	public $drogueDescription7 = 'La Mescaline est un alcalo&iuml;de utilis&eacute; comme drogue hallucinog&egrave;ne, proche de l\'adr&eacute;naline (ils partagent la m&ecirc;me base ph&eacute;nyl&eacute;thylamine, qui est un d&eacute;riv&eacute; de la ph&eacute;nylalanine, un acide amin&eacute;). Sa structure est &eacute;galement proche de celle de l\'amph&eacute;tamine. L\'effet hallucinog&egrave;ne particulier de cette substance l\'inclut dans le vaste domaine des enth&eacute;og&egrave;nes.<br />Elle est c\'est certains plus forte que ces autres copines du clan drogues dure mais c\'est pas une ass&eacute; bonne raison.';
		
	
	function MafConfig ()
	{
		global $mosConfig_absolute_path, $mosConfig_live_site, $option, $Itemid, $task;
		
		$this->chemin = $mosConfig_absolute_path . '/components/' . $option;
		$this->url = $mosConfig_live_site . '/components/' . $option;
		$this->lien = $mosConfig_live_site . '/index.php?option=' . $option . '&Itemid=' . $Itemid;
		$this->lienAjax = $mosConfig_live_site . '/index2.php?option=' . $option . '&Itemid=' . $Itemid;
		$this->lienAjaxTask = $this->lienAjax.'&task=action';
		$this->lienTask = $this->lien.'&task=action';
		$this->delaiMAJDrogue *= 60;
		$this->delaiMAJBot *= 60;
		$this->delaiPlanqueJoueur *= 60;
		$this->niveauFlicMettrePrison--;
		$this->tempsJoueurRecharge *= ( 60 * 24 );
		$this->dureeJeu *= ( 60 * 60 * 24 );

		if($task)
		{
			setcookie('MafTaskSauv' ,mosGetParam( $_REQUEST, 'MafTask' ) ,time()+(365*24*3600), '/');
			setcookie('MafTask' ,$task ,time()+(365*24*3600), '/');
			$this->lienTask = $mosConfig_live_site . '/index.php?option=' . $option . '&Itemid=' . $Itemid . '&task=' . $task;
			$this->lienAjaxTask = $mosConfig_live_site . '/index2.php?option=' . $option . '&Itemid=' . $Itemid . '&task=' . $task;
		}

		$this->delaiRefreshCarte *= 1000;	// on convertit le temps en seconde par des millisecondes
	}


}
	
?>