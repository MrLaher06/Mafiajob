<?php
/**
* @version $Id: victoireCarte.class.php,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
	
class MafVictoireCarte extends Mafiajob {

	/** @var int Primary key */
	public $id = false;
	/** @var int */
	public $equipe;
	/** @var int */
	public $iduser;
	/** @var int */
	public $lat;
	/** @var int */
	public $lng;
	/** @var char */
	public $username;
	/** @var datetime */
	public $date;
	
	// Initialisation de la class
	function MafVictoireCarte ( &$db )
	{
		$this->mosDBTable( '#__wub_carte_victoire', 'id', $db );
		$this->MafConfig();
	}
	
	// Inserer un joueur
	function Mafinsert( &$perso )
	{
		$this->date = date($this->formatDateSQL);
		$this->equipe = $perso->equipe;
		$this->username = $perso->username;
		$this->lat = $perso->lat;
		$this->lng = $perso->lng;
		$this->iduser = $perso->iduser;
		
		$this->MafDelete();
		
		$maj->id = 			$this->id;
		$maj->equipe = 		$this->equipe;
		$maj->iduser = 		$this->iduser;
		$maj->lat = 		$this->lat;
		$maj->lng = 		$this->lng;
		$maj->username = 	$this->username;
		$maj->date = 		$this->date;
		
		if($this->_db->insertObject($this->_tbl , $maj, $this->_tbl_key))
			return true;
		else
			return false;
	}
	
	// Supprimer une action
	function MafDelete ( )
	{
		$this->_db->setQuery( "DELETE FROM ".$this->_tbl." WHERE lat ='".$this->lat."' AND lng ='".$this->lng."'" );
	
		if($this->_db->query())
			return true;
		else
			return false;	
	}
	
	// Fonction pour afficher les erreur s
	function MafError ()
	{
		return $this->_db->_errorMsg;
	}
}
?>