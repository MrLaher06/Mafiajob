<?php
/**
* @version $Id: parking.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafParking extends mosDBTable {

	var $id;
	
	var $iduser;
	
	var $idvoiture;
	
	var $prix;
	
	var $date_crea;
	
	var $timer;
	
	var $nomvoiture;
	
	var $username;
	
	var $reservoir;
	
	// initialisation de la class parking
	function MafParking ( &$db )
	{
		$this->mosDBTable( '#__wub_parking', 'id', $db );	
	}
	
	// selection du personnage
	function MafSelection ( &$id )
	{			
		$query = "SELECT * FROM ".$this->_tbl." WHERE id = '".$id."' LIMIT 1";
		
		$this->_db->setQuery( $query );

		foreach( $this->_db->loadObjectList() as  $var )
		{
			foreach( $var as  $key => $value)
				$this->$key = $value;
		}
	}
	
	function Mafinsert()
	{
		if($this->_db->insertObject($this->_tbl , $this, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	function Mafsupprimer( )
	{
		if($this->delete( $this->id ))
			return true;
		else
			return false;
	}
	
	// selection de tous les objets parking
	function MafSelectionTous ( )
	{			
		$query = "SELECT * FROM ".$this->_tbl;
		$this->_db->setQuery( $query );
		return $this->_db->loadObjectList();
	}

}
?>