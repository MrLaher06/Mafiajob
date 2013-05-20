<?php
/**
* @version $Id: journal.control.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $config->chemin . '/class/journal.class.php');
require_once( $config->chemin . '/views/journal.html.php');

$journal = new MafJournal( $database, $perso );
$html = new MafJournalHTML();

$lecture = $journal->MafLire();

if($lecture)
{
	$html->MafEntete();
	$html->MafFooter( $journal->MafFooter() );

	foreach( $lecture as $info )
	{		
		switch($info->type)
		{
			case 1 : $titre = '<b>'.$info->username.'</b> vient de d&eacute;monter '.$info->objectif; break;
			case 2 : $titre = '<b>'.$info->username.'</b> vient de se casser les dents sur '.$info->objectif; break;
			case 3 : $titre = 'L\'équipe <b>'.$equipe->NomEquipe($info->equipe).'</b> vient de braquer le batiment : '.$info->objectif; break;
			case 4 : $titre = 'L\'équipe <b>'.$equipe->NomEquipe($info->equipe).'</b> vient de louper le braquage du batiment : '.$info->objectif; break;
			case 5 : $titre = '<b>'.$info->username.'</b> vient de d&eacute;foncer '.$info->objectif; break;
			case 6 : $titre = '<b>'.$info->username.'</b> vient de se faire mettre la tronche en travaux'; break;
			case 7 : $titre = '<b>'.$info->username.'</b> vient de d&eacute;pouiller '.$info->objectif; break;
			case 8 : $titre = 'Le flic <b>'.$info->username.'</b> vient de mettre en prison '.$info->objectif; break;
			case 9 : $titre = '<b>'.$info->username.'</b> vient de voler '.$info->objectif; break;
			case 10 : $titre = '<b>'.$info->username.'</b> a voulu voler '.$info->objectif.' mais il est nul'; break;
			case 11 : $titre = '<b>'.$info->username.'</b> vient de d&eacute;noncer '.$info->objectif; break;
			case 12 : $titre = '<b>'.$info->username.'</b> vient d\'acheter une voiture &agrave; '.$info->objectif; break;
		}
		
		$texte = $info->texte;
		
		$texte = str_replace('{joueur}', '<b class="noir">'.$info->username.'</b>', $texte); 
		$texte = str_replace('{objectif}', '<b class="noir">'.$info->objectif.'</b>', $texte); 
		$texte = str_replace('{date}', '<b class="noir">'.$fonction->MafDate($info->date).'</b>', $texte); 
		$texte = str_replace('{argent}', '<b class="noir">'.number_format($info->argent).' $</b>', $texte); 
		$texte = str_replace('{position}', '<b class="noir">'.$info->position.'</b>', $texte); 
		
		$html->MafLecture( $titre, $texte, $info->equipe, $info->image, $info->date );
	}
}
?>