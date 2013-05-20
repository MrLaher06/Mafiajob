<?php
/**
* @version $Id: parking.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once($config->chemin .'/control/batiments/bat_parking/parking.class.php');
require_once($config->chemin .'/control/batiments/bat_parking/parking.html.php');
require_once( $config->chemin . '/views/voiture.html.php' );

$parking = new MafParking( $database );

$html = new MafparkingHTML();

$htmlVoiture = new MafVoitureHTML();

if($persoVoiture)
{
	$depot = $fonction->Get('depot');
	
	// Le personnage dépose son véhicule
	if($depot)
	{
		$prix = $fonction->Get('prixvente');
		
		//on met a jour les var vu qu'on depose le vehicule
		$parking->id = false;
		$parking->iduser = $perso->iduser;
		$parking->idvoiture = $persoVoiture->id;
		$parking->prix = $prix;
		$parking->date_crea = date("Y-m-d H:i:s");
		$parking->timer = time();
		$parking->nomvoiture = $persoVoiture->nom;
		$parking->username = $my->username;
		$parking->reservoir = $perso->reservoir;

		if( $parking->Mafinsert() )
		{
			$html->deposeValide( $prix );
			$html->enteteDeposer();
			$htmlVoiture->detail( $persoVoiture , false );
			
			$persoVoiture = false;
			$perso->RetirerVoiture();
			if( $perso->MafUpdate() )
			{
				// permet l'insertion de cette action dans l'historique
				$texteHistorique = 'D&egrave;pot du v&eacute;hicule '. $parking->nomvoiture .' au parking';	// on modifie la phrase d'origine
				$historique->MafAjout( $perso, 17, $texteHistorique );
			}
		}
	}
	else
		$html->depose( $persoVoiture );
}
else
{
	$idChoix = $fonction->Get('idvoiture' );
	
	if( $idChoix )
	{
		$parking->MafSelection ( $idChoix );
		
		if( $parking->idvoiture )
		{
			$infoVoitureSelection = $voiture->Retrouver( $parking->idvoiture );
			
			// Le personnage décide d'acheter un autre véhicule qui ne lui appartient pas
			if($parking->iduser != $perso->iduser )
			{
				$proprietaire = new MafPersonnage( $database );
				$proprietaire->MafSelection( $parking->iduser );
				
				if($perso->argent >= $parking->prix && $parking->prix > 0)
				{
					$proprietaire->argent += $parking->prix;

					$persoVoiture = $infoVoitureSelection;
					$perso->argent -= $parking->prix;
					$perso->idvoiture = $parking->idvoiture;
					$perso->discretion = $persoVoiture->defense;
					$perso->rapidite = $persoVoiture->rapidite;
					$perso->reservoir = $parking->reservoir;
					$perso->tempsmove = $persoVoiture->temps;
			
					if( $perso->MafUpdate() )
					{
						$html->recupererValide();
						$parking->Mafsupprimer( );
						$html->depose( $persoVoiture );
						
						// permet l'insertion de cette action dans l'historique
						$texteHistorique = 'Achat du véhicule d\'occassion '. $persoVoiture->nom .' au parking';	// on modifie la phrase d'origine
						$historique->MafAjout( $perso, 19, $texteHistorique );
					}
					else
						$html->erreur();
				}
				else
					$html->erreurArgent($parking->prix);
			}
			else
			{
				//on met a jour les var vu qu'on recupere le vehicule
				$persoVoiture = $infoVoitureSelection;
				$perso->idvoiture = $parking->idvoiture;
				$perso->discretion = $persoVoiture->defense;
				$perso->rapidite = $persoVoiture->rapidite;
				$perso->reservoir = $parking->reservoir;
				$perso->tempsmove = $persoVoiture->temps;
			
				if( $perso->MafUpdate() )
				{
					$html->recupererValide();
					$parking->Mafsupprimer( );
					$html->depose( $persoVoiture );
						
					// permet l'insertion de cette action dans l'historique
					$texteHistorique = 'Récupération du véhicule '. $persoVoiture->nom .' au parking';	// on modifie la phrase d'origine
					$historique->MafAjout( $perso, 18, $texteHistorique );
				}
				else
					$html->erreur();
			}	
		}
	}
}

if($persoVoiture)
	$htmlVoiture->detail($persoVoiture);

// partie qui permet d'afficher la liste des véhicules disponible dans le parking
$listeVoituresParking = $parking->MafSelectionTous ( );

if($listeVoituresParking && $perso->idvoiture == 0)
{
	$html->enteteListe();

	foreach($listeVoituresParking as $list)
	{
		$laVoiture = $voiture->Retrouver( $list->idvoiture );
		$htmlVoiture->detail($laVoiture, false);
		$var = false;
			
		if($list->iduser == $perso->iduser)
			$var = true;
		
		if( $list->prix > 0 || $list->iduser == $perso->iduser)
			$html->formulaire($list->id, $var, $list->prix);
	}
}	
?>