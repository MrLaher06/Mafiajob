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
	
if($persoVoiture)
	echo '<span class="note">Il n\'est pas conseillé d\'avoir une voiture pour en voler une autre.</span>';

elseif( $calcul->MafBotVoleVoiture( $lebot ) )	// Le vole du bot a réussi
{
	$persoVoiture = $voiture->Retrouver( $lebot->idvoiture );
	
	$perso->idvoiture = $lebot->idvoiture;
	$perso->discretion = $persoVoiture->defense;
	$perso->rapidite = $persoVoiture->rapidite;
	$perso->reservoir = round( $persoVoiture->reservoir / rand(1, $config->ratioReservoirVole) );
	$perso->tempsmove = $persoVoiture->temps;
	$perso->volevoiture++;
				
	// On gere les chance d'etre recherché par la police
	if(!rand(0,$config->chanceRecherche))
		$perso->casier = 1;

	if($perso->MafUpdate())
	{
		echo '<span class="info">Tu as r&eacute;ussi &agrave; voler le véhicule de ' . $lebot->nom . '</span>';
			
		// permet l'insertion de cette action dans l'historique
		$texteHistorique = 'Vole d\'un véhicule qui appartenait à '.$lebot->nom.', un habitant du coin';	// on modifie la phrase d'origine
		$historique->MafAjout( $perso, 27, $texteHistorique );
		
		$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleVoitureBotVictoire, $config->statPointPuissanceVoleVoitureBotVictoire, $config->statPointIntelligenceVoleVoitureBotVictoire, $config->statPointVisibiliteVoleVoitureBotVictoire );
		
		// On genere le journal
		if(rand(0,1))
			$journalImage = $config->url . '/images/ennemis/'.$lebot->image;
		else
			$journalImage = $config->url . '/images/voitures/'.$persoVoiture->image;
		
		// On enregistre dans le journal				
		$journal->MafEcrire(9 , $lebot->nom, false, false, false, $journalImage);
		
		// Mise a jour du bot
		$bot->Replacer(true, false, true, true, true, true, false);
	}
}
else
{
	$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleVoitureBotDefaite, $config->statPointPuissanceVoleVoitureBotDefaite, $config->statPointIntelligenceVoleVoitureBotDefaite, $config->statPointVisibiliteVoleVoitureBotDefaite );
	
	// permet l'insertion de cette action dans l'historique
	$historique->MafAjout( $perso, 55 );
		
	// On genere le journal
	$journalImage = $config->url . '/images/ennemis/'.$lebot->image;
	
	// On enregistre dans le journal				
	$journal->MafEcrire(10 , $lebot->nom, false, false, false, $journalImage);
	
	// Mise a jour du bot
	$bot->Replacer(false, false, false, true, false, false, false);
	
	echo '<span class="alert">Tu n\'as pas r&eacute;ussi &agrave; voler le véhicule de ' . $lebot->nom . '</span>';
}
	
?>