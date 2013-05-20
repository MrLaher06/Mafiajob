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

// Le vole du bot a réussi VICTOIRE
if( $calcul->MafBotVoleArgent( $lebot ) )
{
	$perso->voleargent++;
				
	// On gere les chance d'etre recherché par la police
	if(!rand(0,$config->chanceRecherche))
		$perso->casier = 1;

	if($perso->AjoutArgent( $lebot->argent ))
	{
		echo '<span class="info">Tu as r&eacute;ussi &agrave; voler '.number_format($lebot->argent).' $ &agrave; '.$lebot->nom.'.</span>';
			
		// permet l'insertion de cette action dans l'historique
		$texteHistorique = 'Vole d\'argent contre '.$lebot->nom.', un habitant du coin. Gain du vole : '.number_format($lebot->argent).' $';	// on modifie la phrase d'origine
		$historique->MafAjout( $perso, 21, $texteHistorique );
		
		$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleArgentBotVictoire, $config->statPointPuissanceVoleArgentBotVictoire, $config->statPointIntelligenceVoleArgentBotVictoire, $config->statPointVisibiliteVoleArgentBotVictoire );
		
		// On genere le journal
		$journalImage = $config->url . '/images/ennemis/'.$lebot->image;
		
		// On enregistre dans le journal				
		$journal->MafEcrire(9 , $lebot->nom, false, false, false, $journalImage);
		
		// Mise a jour du bot
		$bot->Replacer(true, false,true, true, true, false, false);
	}	
}
// Le vole du bot a loupé DEFAITE
else
{
	$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleArgentBotDefaite, $config->statPointPuissanceVoleArgentBotDefaite, $config->statPointIntelligenceVoleArgentBotDefaite, $config->statPointVisibiliteVoleArgentBotDefaite );
	
	// permet l'insertion de cette action dans l'historique
	$historique->MafAjout( $perso, 56 );
		
	// On genere le journal
	$journalImage = $config->url . '/images/ennemis/'.$lebot->image;
	
	// On enregistre dans le journal				
	$journal->MafEcrire(10 , $lebot->nom, false, false, false, $journalImage);
	
	// Mise a jour du bot
	$bot->Replacer(false, false, false, true, false, false, false);
	
	echo '<span class="alert">Tu n\'as pas r&eacute;ussi &agrave; lui voler son argent.</span>';
}
?>