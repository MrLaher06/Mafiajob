<?php
/**
* @version $Id: voiture.class.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class MafVoiture extends Mafiajob {

	/** @var int Primary key */
	public $id						= false;
	/** @var string */
	public $image					= false;
	/** @var int */
	public $reservoir				= 0;
	/** @var int */
	public $temps					= 0;
	/** @var string */
	public $nom						= false;
	/** @var string */
	public $commentaire				= false;
	/** @var int */
	public $defense					= 0;
	/** @var int */
	public $consommation			= 0;
	/** @var int */
	public $tenue_route				= 0;
	/** @var int */
	public $puissance				= 0;
	/** @var int */
	public $prix_plein				= 0;
	/** @var int */
	public $prix_achat				= 0;
	/** @var int */
	public $rapidite				= 0;
	/** @var int */
	public $idmagasin				= false;
	/** @var int */
	public $nombre					= 0;
	/** @var int */
	public $xp						= 10;
	/** @var int */
	public $special					= 0;				// permet de savoir si c'est pour les flic ou pas 1 = oui
	/** @var array */	
	public $voitureId 				= array(false);		// Tableau qui contient les id des voitures
	/** @var array */	
	public $voitureDonnee			= array(false);		// Tableau qui contient les données des voitures
	/** @var array */	
	public $listeVoiture;								// Tableau qui contient les voitures

	// Initialisation de la class
	function MafVoiture ( &$db )
	{
		$this->mosDBTable( '#__wub_voitures', 'id', $db );
		$this->MafConfig();	
	}
	
	// Fonction liste des voitures
	function Liste ( )
	{
		$this->_db->setQuery( "SELECT * FROM " . $this->_tbl );
		$this->listeVoiture = $this->_db->loadObjectList();
		
		foreach ( $this->listeVoiture as $var )
		{
			array_push( $this->voitureId,$var->id );
			array_push( $this->voitureDonnee,$var );
		}
	}

	// Fonction qui permet de retrouver les donnée dans un tableau
	function Retrouver ( $id = false )
	{
		if($id)
		{
			$key = array_search($id, $this->voitureId);
			if($key) 
			{
				$var = $this->voitureDonnee;
				return $var[$key];
			}
			else
				return false;
		}
		else
			return false;
	}
	
	// Fonction pour garer le véhicule
	function Garer ($perso = false)
	{
		$query = "INSERT INTO #__wub_carte_voiture (  `iduser` , `idvoiture` , `reservoir` , `defense` , `rapidite` , `timer` , `lat` , `lng` )
VALUES ( '".$perso->iduser."', '".$perso->idvoiture."', '".$perso->reservoir."', '".$perso->discretion."', '".$perso->rapidite."', '".time()."', '".$perso->lat."', '".$perso->lng."')";
	
		$this->_db->setQuery( $query );
		if($this->_db->query())
			return true;
		else
			return false;
	}
	
	// Fonction pour recuperer le véhicule
	function Recuperer ( $id, $lat, $lng, $iduser )
	{		
		$this->_db->setQuery( "SELECT * FROM #__wub_carte_voiture WHERE id = '".$id."' AND iduser = '".$iduser."' AND lat = '".$lat."' AND lng = '".$lng."' LIMIT 1" );
		$listeVoiture = $this->_db->loadObjectList();
		
		if($listeVoiture)
		{
			$this->_db->setQuery( "DELETE FROM #__wub_carte_voiture WHERE id = '".$id."' AND iduser = '".$iduser."' AND lat = '".$lat."' AND lng = '".$lng."' LIMIT 1" );
			$this->_db->query();
			
			return $listeVoiture[0];
		}
		else
			return false;
	}
	
	// Fonction pour voler le véhicule
	function Voler ( $id, $lat, $lng )
	{		
		$this->_db->setQuery( "SELECT * FROM #__wub_carte_voiture WHERE idvoiture = '".$id."' AND lat = '".$lat."' AND lng = '".$lng."' LIMIT 1" );
		$listeVoiture = $this->_db->loadObjectList();
		
		if($listeVoiture)
		{
			$this->_db->setQuery( "DELETE FROM #__wub_carte_voiture WHERE idvoiture = '".$id."' AND lat = '".$lat."' AND lng = '".$lng."' LIMIT 1" );
			$this->_db->query();
			
			return true;
		}
		else
			return false;
	}
	
	// Fonction liste des voitures
	function ListeGarer ($perso = false)
	{
		$this->_db->setQuery( "SELECT * FROM #__wub_carte_voiture WHERE lat = '".$perso->lat."' AND lng = '".$perso->lng."'" );
		$listeVoiture = $this->_db->loadObjectList();
		
		if($listeVoiture)
			return $listeVoiture;
		else
			return false;
	}
	
	// Fonction liste des voitures d'un joueur
	function ListeVehiculeJoueur ($id)
	{
		$this->_db->setQuery( "SELECT * FROM #__wub_carte_voiture WHERE iduser = '".$id."'" );
		$listeVoiture = $this->_db->loadObjectList();
		
		if($listeVoiture)
			return $listeVoiture;
		else
			return false;
	}
	
	// Fonction pour afficher les erreurs
	function error ()
	{
		return $this->_db->_errorMsg;
	}
	
	
}
?>