<?php
/**
* @version $Id: arrestation.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

//On vérifie que le personnage est équipé
if( $perso->idarme && $perso->munition && $perso->MafDelaiPlanque() && $perso->MafFlic()) 
{
	sleep($config->tempsArrestationPrison);
	
	if($persoInfo->MafSelection ( $persoInfo->iduser, $perso->lat, $perso->lng ) && $persoInfo->actif)
	{
		if($persoInfo->casier && $persoInfo->xp >= $config->xpJoueurPrison && $perso->xp <= $config->NiveauXP[$config->niveauFlicMettrePrison] && $perso->idarme && $perso->munition) 
		{
			$prix = $persoInfo->argent/$config->perteArgentDenonciation;
			
			//on met a jour le flic car il a le droit a son argent
			$perso->xp += $config->$statPointXpArrestation;
			$perso->lat = $config->latitudeCommissariat;
			$perso->lng = $config->longitudeCommissariat;
			$perso->AjoutArgent($prix);
			
			$persoInfo->argent -= $prix;
			
			if($persoInfo->MafFlic())
				$persoInfo->equipe = rand(2,3);
			
			$persoInfo->MafPrison();
	
			$texteHistorique = 'Tu as envoyé '.$persoInfo->username.' au pénitencier tu as gagné '.number_format($prix).' $';
			$historique->MafAjout( $perso, 62, $texteHistorique );
			
			if($persoInfo->MafFlic())
				$texteHistorique = $perso->username. ' t\'a envoyé au pénitencier car tu étais un hors la loi. Tu as perdu '.number_format($prix).' $ et tu as perdu ton titre de flic par contre ton expérience du terrain reste la même.';
			else
				$texteHistorique = $perso->username. ' t\'a envoyé au pénitencier car tu étais un hors la loi. Tu as perdu '.number_format($prix).' $';
	
			$historique->MafAjout( $persoInfo, 63, $texteHistorique );
			
			echo '<span class="info">';
			echo 'Tu viens d\'envoyer '.$persoInfo->username.' au pénitencier et tu t\'es fait '.number_format($prix) .' $.<br />';
			echo '<b>Ton personnage se retrouve au commissariat pour les détails administratif.</b>';
			echo '</span>';
		}
		else
			echo '<span class="alert">Il n\'est pas incasérable!</span>';
	}
	else
		$html->PlusLa();
}
else
	$html->MafErrorEquipement();
	

?>
