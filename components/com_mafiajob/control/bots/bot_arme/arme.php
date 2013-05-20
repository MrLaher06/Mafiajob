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

if( $calcul->MafBotVoleArme( $lebot ) )	// Le vole d'arme du bot a réussi
{
	$persoArme = $arme->Retrouver( $lebot->idarme );
	
	$perso->idarme = $lebot->idarme;
	$perso->attaque = $persoArme->attaque;
	$perso->defense = $persoArme->defense;
	$perso->munition = round( $persoArme->munition / rand(1, $config->ratioMunitionVole) ) ;
	$perso->volearme++;
		
	if($perso->MafUpdate())
	{
		echo '<span class="info">Tu as r&eacute;ussi &agrave; voler l\'arme de ' . $lebot->nom . '</span>';
			
		// permet l'insertion de cette action dans l'historique
		$texteHistorique = 'Vole de l\'arme qui appartenait à '.$lebot->nom.', un habitant du coin';	// on modifie la phrase d'origine
		$historique->MafAjout( $perso, 22, $texteHistorique );
		$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleArmeBotVictoire, $config->statPointPuissanceVoleArmeBotVictoire, $config->statPointIntelligenceVoleArmeBotVictoire, $config->statPointVisibiliteVoleArmeBotVictoire );
		
		// On genere le journal
		if(rand(0,1))
			$journalImage = $config->url . '/images/ennemis/'.$lebot->image;
		else
			$journalImage = $config->url . '/images/armes/'.$persoArme->image;
		
		// On enregistre dans le journal				
		$journal->MafEcrire(9 , $lebot->nom, false, false, false, $journalImage);
		
		// Mise a jour du bot
		$bot->Replacer(true, false, true, true, true, false, true);
	}
}
else
{
	$calcul->MafMAJDefenseJoueur ( $perso, $config->statPointXpVoleArmeBotDefaite, $config->statPointPuissanceVoleArmeBotDefaite, $config->statPointIntelligenceVoleArmeBotDefaite, $config->statPointVisibiliteVoleArmeBotDefaite );
	
	// permet l'insertion de cette action dans l'historique
	$historique->MafAjout( $perso, 57 );
		
	// On genere le journal
	$journalImage = $config->url . '/images/ennemis/'.$lebot->image;
	
	// On enregistre dans le journal				
	$journal->MafEcrire(10 , $lebot->nom, false, false, false, $journalImage);
	
	// Mise a jour du bot
	$bot->Replacer(false, false, false, true, false, false, false);
	
	echo '<span class="alert">Tu n\'as pas r&eacute;ussi &agrave; voler l\'arme de ' . $lebot->nom . '</span>';
}	
?>