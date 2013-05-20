<?php
/**
* @version $Id: carte.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafBatiment extends Mafiajob {

	/** @var array */
	 var $Batiments = false;				// Tableau qui contient un tableau des batiments
	/** @var array */
	 var $SolPosition = array(false);		// Tableau qui contient les position du sol
	/** @var array */
	 var $SolDonnee = array(false);			// Tableau qui contient les donnée du sol
	/** @var array */
	 var $leBatiment = false;				// info sur un batiment precis
	 
	// Initialisation de la class bot
	function MafBatiment ( &$db )
	{
		$this->mosDBTable( '#__wub_batiments', 'id', $db );	
		$this->MafConfig();	
	}
	
	// Fonction qui montre les bots
	function SelectionBatiment (&$MinLat, &$MaxLat, &$MinLng, &$MaxLng)
	{
		$query = "SELECT * FROM " . $this->_tbl . " WHERE lat >= '" . $MinLat . "' AND lat <= '" . $MaxLat . "' AND lng >= '" . $MinLng . "' AND lng <= '" . $MaxLng . "'";

		$this->_db->setQuery( $query );
		$this->Batiments = $this->_db->loadObjectList();
		
		foreach ( $this->Batiments as $var )
		{
			array_push($this->SolPosition,$var->lat.'-'.$var->lng);
			array_push($this->SolDonnee,$var);
		}
	}
	
	// Fonction qui montre les batiment via la latitude et longitude
	function SelectionSimple ( $Lat , $Lng , $id = false)
	{
		if($id && !$Lat && !$Lng)
			$query = "SELECT * FROM " . $this->_tbl . " WHERE id = '" . $id . "' LIMIT 1";
		else
			$query = "SELECT * FROM " . $this->_tbl . " WHERE lat = '" . $Lat . "' AND lng = '" . $Lng . "' LIMIT 1";

		$this->_db->setQuery( $query );
		$leBatiment = $this->_db->loadObjectList();

		if( $leBatiment )
		{
			$this->leBatiment = $leBatiment[0];
			return $this->leBatiment;
		}
		else
			return false;
	}
	
	// Fonction qui montre les bots
	function SelectionProprio (&$id)
	{
		$this->_db->setQuery( "SELECT * FROM " . $this->_tbl . " WHERE proprio = '" . $id . "'" );
		$lesBatiments = $this->_db->loadObjectList();
		
		if( $lesBatiments )
			return $lesBatiments;
		else
			return false;
	}
	
	// Fonction qui retourne la protection du meilleur batiment
	function SelectionMeilleurProtection ( )
	{
		$this->_db->setQuery( "SELECT protection FROM " . $this->_tbl . " ORDER BY protection DESC LIMIT 1" );
		$LeBatiment = $this->_db->loadObjectList();
		if($LeBatiment)
			return $LeBatiment[0]->protection;
		else
			return false;
	}
	
	// Fonction qui renvois le nombre total de batiment
	function NbrTotal( )
	{
		return count($this->Batiments);
	}

	// Fonction qui permet de retrouver les donnée dans un tableau
	function RetrouverSimple ( $pos )
	{
		$key = array_search($pos, $this->SolPosition);

		if($key) 
		{
			$var = $this->SolDonnee;
			return $var[$key];
		}
		else
			return false;
	}

	// Fonction qui permet de connaitre l acces
	function Acces ( $pos )
	{
		$key = array_search($pos, $this->SolPosition);

		if($key) 
		{
			$var = $this->SolDonnee;
			return $var[$key]->acces;
		}
		else
			return true;
	}
	
	// Fonction qui renvois ce que rapport un batiment a la vente
	function MafOptionVente ( &$option )
	{		
		switch ($option)
		{
			case 'anpe' :  			return $this->optionRapporteBatimentAnpe; break;
			case 'arme' :  			return $this->optionRapporteBatimentArme; break;
			case 'banque' :  		return $this->optionRapporteBatimentBanque; break;
			case 'casino' :  		return $this->optionRapporteBatimentCasino; break;
			case 'circuit' :  		return $this->optionRapporteBatimentCircuit; break;
			case 'hospital' :  		return $this->optionRapporteBatimentHospital; break;
			case 'jeux' :  			return $this->optionRapporteBatimentJeux; break;
			case 'papier' :  		return $this->optionRapporteBatimentPapier; break;
			case 'parking' :  		return $this->optionRapporteBatimentParking; break;
			case 'penitencier' :  	return $this->optionRapporteBatimentPenitencier; break;
			case 'spa' :  			return $this->optionRapporteBatimentSpa; break;
			case 'tunnel' : 		return $this->optionRapporteBatimentTunnel; break;
			case 'validation' :  	return $this->optionRapporteBatimentValidation; break;
			case 'voiture' :  		return $this->optionRapporteBatimentVoiture; break;
			default : 				return false; break;
		}
				
	}
	
	// Fonction qui renvois ce que rapport un batiment a la vente
	function MafTypeVente ( &$option )
	{
		switch ($option)
		{
			case 'anpe' :  			return $this->optionRapporteBatimentAnpeType; break;
			case 'arme' :  			return $this->optionRapporteBatimentArmeType; break;
			case 'banque' : 		return $this->optionRapporteBatimentBanqueType; break;
			case 'casino' :  		return $this->optionRapporteBatimentCasinoType; break;
			case 'circuit' :  		return $this->optionRapporteBatimentCircuitType; break;
			case 'hospital' :  		return $this->optionRapporteBatimentHospitalType; break;
			case 'jeux' :  			return $this->optionRapporteBatimentJeuxType; break;
			case 'papier' :  		return $this->optionRapporteBatimentPapierType; break;
			case 'parking' :  		return $this->optionRapporteBatimentParkingType; break;
			case 'penitencier' :  	return $this->optionRapporteBatimentPenitencierType; break;
			case 'spa' :  			return $this->optionRapporteBatimentSpaType; break;
			case 'tunnel' :  		return $this->optionRapporteBatimentTunnelType; break;
			case 'validation' :  	return $this->optionRapporteBatimentValidationType; break;
			case 'voiture' : 		return $this->optionRapporteBatimentVoitureType; break;
			default : 				return false; break;
		}
				
	}
	
	// Fonction mise a jour du batiment
	function MafUpdate ( )
	{
		if($this->_db->updateObject($this->_tbl , $this->leBatiment, $this->_tbl_key))
			return true;
		else
			return false;	
	}
	
	// Fonction pour afficher les erreur s
	function error ()
	{
		return $this->_db->_errorMsg;
	}
}
?>