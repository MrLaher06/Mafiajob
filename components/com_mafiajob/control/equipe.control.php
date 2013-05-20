<?php
/**
* @version $Id: equipe.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/plusieurs.class.php' );
require_once( $config->chemin . '/views/equipe.html.php' );

// Creation de l'objet
$actions = new MafPlusieurs( $database );
$html = new MafEquipeHTML();

$detail = $fonction->Get('detail');
$annuler = $fonction->Get('annuler');
$lancer = $fonction->Get('lancer');
$participer = $fonction->Get('participer');
$retirer = $fonction->Get('retirer');
$idinvite = $fonction->Get('idinvite');
$invite = $fonction->Get('invite');
$key = $fonction->Get('key');

$detailAction = false;

// On verifie si demande d'invitation
if($idinvite && $invite)
{
	if($equipe->envoisinvite($idinvite))
		$html->MafInvitationValide ();
	else
		$html->MafInvitationErreur ();
}

// On valide son invitation
if($key)
{
	$retour = $equipe->SelectionInvite($key);
	
	if($retour)
	{
		$perso->equipe = $retour;
		if($perso->MafUpdate())
			$html->MafInvitationValideJoueur ();
		else
			$html->MafInvitationErreurJoueur ();
	}
	else
		$html->MafInvitationMAJJoueur ();
}

// On verfie le detail et on liste
if($detail)
{
	$listeParticipants = $actions->MafListeActionDetail( $detail );
	$nbrParticipant = count($listeParticipants);
	$detailAction = $listeParticipants[0];
}	


/*
// Si le personnage lanceur décide de retirer un participant
*/

if( $retirer && $detailAction )
{
	if( $detailAction->idattaque == $perso->iduser &&  $detailAction->idattaque != $retirer)	//annul lanceur
	{
		$actions->MafDeleteAction( $retirer , 2 );
		$listeParticipants = $actions->MafListeActionDetail( $detail );
		$nbrParticipant = count($listeParticipants);
		$detailAction = $listeParticipants[0];
		$html->AnnulerLanceurParticipation ( );
			
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 33 );
	}
}


/*
// Si le personnage désire participer à l'action
*/

if( $participer && $detailAction)
{
	if( $detailAction->idattaque != $perso->iduser )
	{
		if($actions->MafSelectAction( $detailAction->id ) && $actions->MafParticiperAction( $perso ))
		{
			$listeParticipants = $actions->MafListeActionDetail( $detail );
			$nbrParticipant = count($listeParticipants);
			$detailAction = $listeParticipants[0];
			$html-> Participation ( );
			
			// permet l'insertion de cette action dans l'historique
			$historique->MafAjout( $perso, 32 );
		}
		else
			$html-> ParticipationLouper ( );
	}
}


/*
// Si le personnage decide d'annuler l'action
*/

if( $annuler && $detailAction )
{
	if( $detailAction->idattaque == $perso->iduser )	//annul lanceur
	{
		$actions->MafDeleteAction( $perso->iduser , 1 );
		$html->AnnulerLanceur ( );
			
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 31 );
	}
	elseif( $detailAction && $detailAction->idattaque != $perso->iduser )	//annul participation
	{
		$actions->MafDeleteAction( $perso->iduser , 2 );
		$html->AnnulerParticipant ( );
			
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 34 );
	}
	else
		$html->AnnulerVide ( );
}


/*
// Si le personnage est lanceur et qu'il lance l'action
*/

elseif( $lancer && $detailAction)
{
	if( $detailAction->idattaque == $perso->iduser )
	{
		// permet l'insertion de cette action dans l'historique
		$historique->MafAjout( $perso, 35 );
		
		// on appel le fichier qui gere le lancement d'une action
		require_once( $config->chemin . '/control/action/action_lancer.php' );
	}
}


/*
// Si on veut voir le détail d'une action
*/

elseif( $detail && $detailAction )
{
	$root = false;
	
	if( $detailAction->idattaque == $perso->iduser )
		$root = $perso->iduser;	

	$html->MafTitreDetail( $root, $detail, $detailAction->iddefense, $perso->iduser );
	$html->MafCibleDetail();
	
	// on appel le fichier qui gere le detail d'une action
	require_once( $config->chemin . '/control/action/action_detail.php' );
	
	// on affiche le détail des participants
	$html->MafParticipantDetail( $nbrParticipant );
	
	foreach( $listeParticipants as $list )
	{
		$temps = $fonction->ConvertirTemps( $list->time_crea );

		$html->MafActionParticipant( $list->iduser, $list->nomattaque, $list->role, $list->lat, $list->lng, $temps, $root );
	}
	
	$html->MafSeparateur();
}

$html->MafEntete();

//on verifie qu'il y a une ou des actions
if($actions->MafListeActionEquipe( $perso->equipe ))
{
	foreach ( $actions->actionEquipe as $list )
	{
		$html->MafActionEquipe( $perso, $list );
		
		//on cumule le nombre d'action total pour savoir combien d'action il y a en cours (voir fichier action.control.php)
		$config->action++;
	}
}

// on compte le nombre d'action actif dans l'equipe
if($config->action > 0)
	$html->NombreAction();
// Si aucune action équipe on en profite pour afficher des options
else
{
	// On indique au joueur qu'il y a pas action équipe pour le moment
	$html->AucuneAction();
	
	// On en profite aussi pour mettre a jour les habitant du jeu (bot)
	if($fonction->selectmaj())
	{
		require_once( $config->chemin . '/class/bot.class.php' );		
		$bot = new MafBot( $database );
		
		foreach ( $bot->SelectionTous ( ) as $list)
		{
			$bot->LeBot = $list;
			$bot->Replacer(false, false, true, rand(0,1), true, false, false);
		}
	}
	
	//on gere la gestion de l'équipe
		
	// en cas de création de l'équipe
	if($fonction->Get('creermafia') && $fonction->Get('nommafia') && $fonction->Get('couleur') && $perso->argent >= $config->ArgentCreationEquipe )
	{
		$equipe->Creation->nom = $fonction->Get('nommafia');
		$equipe->Creation->couleur = $fonction->Get('couleur');
		$equipe->Creation->iduser = $perso->iduser;
		$equipe->Creation->image = $fonction->Get('imagemafia');
		$equipe->Creation->commentaire = $fonction->Get('commentaire');
		if( $equipe->MafInsert() )
		{
			$perso->equipe = $equipe->SelectionDernier();
			$perso->argent -= $config->ArgentCreationEquipe;
			$perso->MafUpdate();
			$equipe->ChangementMAJ( $perso->equipe );
			$equipe->Selection();
			
			$html->MafCreationValide();
		}
		else
			$html->MafCreationNonValide();
	}

	// partie pour la création de son équipe
	if($perso->argent >= $config->ArgentCreationEquipe && $perso->xp >= $config->XpCreationEquipe && $perso->iduser != $equipe->ChefEquipe($perso->equipe) && !$perso->MafFlic()) 
		$html->creation ();
		
	// partie pour la gestion de son équipe
	elseif( $perso->iduser == $equipe->ChefEquipe($perso->equipe) ) 
	{
		// on recupere tous les joueurs qui ne sont pas des flics
		require_once( $config->chemin . '/class/joueur.class.php' );
		$joueurs = new MafJoueurs( $database );
		$joueurs->SelectionTousJoueursGestionEquipe ();

		// on prepare les différent champs select
		$ListeJoueur = '<option value="">'._SELECT_JOUEUR.'</option>';
		$ListeJoueurEquipe = '';
		
		//on fait une boucle pour afficher les joueur de son equipe et celle qui n en font pas partie (2 selects différents)		
		foreach($joueurs->TousJoueurs as $list)
		{
			$couleur = $equipe->CouleurEquipe($list->equipe);
			
			if($list->equipe == $perso->equipe)
			{
				if($list->iduser != $perso->iduser)
					$ListeJoueurEquipe .=  '<div class="miniavatarEquipe" onclick="conteneur(\''. $config->lienAjax.'&task=information&iduser='.$list->iduser.'&no_html=1\', \'ajax=1\');"><img title="Portrait" src="http://ima.minigao.com/l120/p87/'.$list->iduser.'.jpg?'.time().'" alt="Portrait" width="50" /><br /><center>'.substr($list->username, 0, 7).'</center></div>';
			}
			else
			{
				if( $list->iduser == $equipe->ChefEquipe($list->equipe) )
				$ListeJoueur .= '<option disabled="disabled" value="'.$list->iduser.'" style="background-color:'.$couleur .';">'.$list->username.' ( Chef des : '.$equipe->NomEquipe($list->equipe).')</option>';
				else
				$ListeJoueur .= '<option value="'.$list->iduser.'" style="background-color:'.$couleur .';">'.$list->username.' ('.$equipe->NomEquipe($list->equipe).')</option>';

			}
		}
		
		$html->gestion($ListeJoueur, $ListeJoueurEquipe, $perso);
	}
	else
		$html->MafImpossibleCreation( );
	
	// On affiche le forum pour parler entre equipe
	require_once( $config->chemin . '/class/forum.class.php' );		
	$forum = new MafForum( $database );
	
	// On vérifie et on insert le texte de discution que envois le joueur
	$texte = $fonction->Get('texteforum');
	if($texte && $fonction->Get('valideforum'))
	{
		$forum->iduser = $perso->iduser;
		$forum->equipe = $perso->equipe;
		$forum->username = $perso->username;
		$forum->texte = $texte;
		$forum->date_crea = date("Y-m-d H:i:s");
		
		//On met a jour
		$forum->MafInsert();		
	}
	
	// On selection la liste des message a afficher
	$donnees = $forum->selection($perso->equipe);
	
	//on affiche le formulaire pour ecrire dans le forum
	$html->MafForumFormulaire();

	//on affiche les donnée texte des discution dans le forum
	if($donnees)
		$html->MafForumConteneur( $forum->afficher( $donnees ) , $forum->MafFooter() );
	else
		$html->MafForumAucun( );
		
}
?>