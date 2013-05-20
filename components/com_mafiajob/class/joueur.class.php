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

class MafJoueurs extends Mafiajob {

	/** @var array */
	 public $Joueurs = false;						// Tableau qui contient un tableau des batiments
	/** @var array */
	 private $JoueurPosition = array(false);		// Tableau qui contient les position des bots
	/** @var array */
	 private $JoueurDonnee = array(false);			// Tableau qui contient les donnée des bots
	/** @var array */
	 public $leJoueur = false;						// Tableau qui contient un tableau des batiments
	 
	// Initialisation de la class
	function MafJoueurs ( &$db )
	{
		$this->mosDBTable( '#__wub_personnage', 'id', $db );
		$this->MafConfig();	
	}
	
	// Fonction qui montre les joueurs selon un rayon (celui de la carte)
	function SelectionJoueurs (&$MinLat, &$MaxLat, &$MinLng, &$MaxLng)
	{
		$query = "SELECT * FROM " . $this->_tbl . "
						   WHERE lat >= '" . $MinLat . "' 
						   AND lat < '" . $MaxLat . "' 
						   AND lng >= '" . $MinLng . "' 
						   AND lng < '" . $MaxLng . "' AND actif = '1' AND casier != '2'";

		$this->_db->setQuery( $query );
		$this->Joueurs = $this->_db->loadObjectList();
		
		foreach ( $this->Joueurs as $var )
		{
			array_push($this->JoueurPosition,$var->lat.'-'.$var->lng);
			array_push($this->JoueurDonnee,$var);
		}
	}
	
	// Fonction qui montre les joueurs
	function SelectionTousJoueurs ( $Lat = false, $Lng = false )
	{
		if( $Lat && $Lng )
			$query = "SELECT iduser FROM " . $this->_tbl . " WHERE lat = '" . $Lat . "' AND lng = '" . $Lng . "' AND actif = '1'";
		else
			$query = "SELECT * FROM " . $this->_tbl . " ";

		$this->_db->setQuery( $query );
		$this->TousJoueurs = $this->_db->loadObjectList();

		if( $this->TousJoueurs )
			return $this->TousJoueurs;
		else
			return false;
	}
	
	// Fonction qui montre les joueurs qui ne sont pas flic plus jointure pour le mail
	function SelectionTousJoueursGestionEquipe ( )
	{
		$this->_db->setQuery( "SELECT * FROM " . $this->_tbl . " p , #__users u WHERE p.iduser = u.id AND p.equipe != 1 ORDER BY p.equipe " );
		$this->TousJoueurs = $this->_db->loadObjectList();

		if( $this->TousJoueurs )
			return $this->TousJoueurs;
		else
			return false;
	}

	// Fonction qui permet de retrouver les donnée dans un tableau
	function RetrouverSimple ( $pos )
	{
		$key = array_search($pos, $this->JoueurPosition);

		if($key) 
		{
			$var = $this->JoueurDonnee;
			return $var[$key];
		}
		else
			return false;
	}

	// Fonction qui permet de retrouver les donnée dans un tableau
	function RetrouverSimpleId ( $id )
	{
		$key = array_search($id, $this->JoueurId);

		if($key) 
		{
			$var = $this->JoueurDonnee;
			return $var[$key];
		}
		else
			return false;
	}
	
	// Fonction qui renvois le nombre total de joueur
	function NbrTotal( )
	{
		return count($this->Joueurs);
	}
	
	// Fonction qui renvois le nombre de tel ou tel element sur la carte
	function Nbr( $pos )
	{
		$key = array_keys($this->JoueurPosition, $pos);

		if($key)
			return count($key);
		else
			return false;
	}
	
	// Fonction qui renvois le nombre de tel ou tel element sur la carte
	function RetrouverMulti ( $pos )
	{
		$tabl = array();
		$liste = $this->JoueurDonnee;
		
		$key = array_keys($this->JoueurPosition, $pos);
		
		for($i = 0; $i< count($key); $i++)
			array_push($tabl,$liste[$key[$i]]);

		if($tabl)
			return $tabl;
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